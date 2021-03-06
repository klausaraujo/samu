function emergencias(URI) {
    var table = null;

    function showModal(event,title) {
        $("#editarModal").modal("show");
        $("#editarModalLabel").text(title);
        event.stopPropagation();
        event.stopImmediatePropagation();
    }

    function post(path, params, method) {
      method = method || "post";
    
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);
    
      for (var key in params) {
        if (params.hasOwnProperty(key)) {
          var hiddenField = document.createElement("input");
          hiddenField.setAttribute("type", "hidden");
          hiddenField.setAttribute("name", key);
          hiddenField.setAttribute("value", params[key]);
    
          form.appendChild(hiddenField);
        }
      }
    
      document.body.appendChild(form);
      form.submit();
    }

  function buscar(valor) {
    var idEm = valor;
    $("#idem").val(idEm);
    var opt = '<option value="" class="lista">---Seleccione---</option>';
    $("#formRegistrar")[0].reset();
    $("#act").val(1);
    $("#enviar").text("Actualizar");
    $("#formRegistrar select").prop('selectedIndex',0);
    
    $.ajax({
      type: 'POST',
      url: URI + 'emergencias/main/extraeEmergencia',
      data: {id:idEm},
      dataType: 'json',
      success: function (response) {
        if (response.status === 200) {
          const { data } = response;
          const { priori } = response;
          const { incid } = response;
          const { tipo } = response;
          const { prov } = response;
          const { dist } = response; 
          var k = 0; j = 0;
          var reg, idreg, tipod;
          var html = "";
          var dep = (data.ubigeo).substr(0,2);
          var pro = (data.ubigeo).substr(2,2);
          var dis = (data.ubigeo).substr(4,2);
          var fecha = (data.fecha_incidente).substr(0,10);
          $("#fechaIncid").val(fecha);
          
          $("#departamento option").each(function(){
            if ($(this).val() == dep ){        
              $(this).prop("selected",true);
            }
          });

          $("#tipoDoc option").each(function(){
            if ($(this).val() == data.tipo_documento ){        
              $(this).prop("selected",true);
            }
          });

          html = opt;
          for(k in incid) {
            reg = incid[k].tipo_incidente;
            idreg = incid[k].idtipoincidente;
            if(idreg == data.idtipoincidente){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#incidente").html(html);
          html = opt; k = 0;
          for(k in tipo) {
            reg = tipo[k].tipo_llamada;
            idreg = tipo[k].idtipollamada;
            if(idreg == data.idtipollamada){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#tipoLl").html(html);
          html = opt; k = 0;
          for(k in priori) {
            reg = priori[k].prioridad_emergencia;
            idreg = priori[k].idprioridademergencia;
            if(idreg == data.idprioridademergencia){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#prioridad").html(html);
          html = opt; k = 0;
          for(k in prov) {
            reg = prov[k].provincia;
            idreg = prov[k].cod_pro;
            if(idreg == pro){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#provincia").html(html);
          html = opt; k = 0;
          for(k in dist) {
            reg = dist[k].distrito;
            idreg = dist[k].cod_dis;
            if(idreg == dis){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#distrito").html(html);
          
          $("#tlf2").val(data.telefono02);
          if(data.es_paciente == 1)
            $('#sipaciente').prop('checked', true);
          if(data.masivo == 1)
            $('#simasivo').prop('checked', true);
          $("#direccion").val(data.direccion_emergencia);
          $("#apellidos").val(data.apellidos);
          $("#nombres").val(data.nombres);
          $("#doc").val(data.numero_documento);
          $("#doc").prop("disabled", true);
          $("#direccion").val(data.direccion_emergencia);
          $("#tlf").val(data.telefono01);
          $("#btn-buscar").hide();
          $("#datos").hide();          

          var latitud = data.latitud;
          var longitud = data.longitud;

          $("#latitud").val(latitud);
          $("#longitud").val(longitud);
          
          initialize(latitud,longitud,15, "");
          var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true,
            position: new google.maps.LatLng(latitud, longitud)
          });
          
          google.maps.event.addListener(marker, "dragend", function (event) {

            lat = marker.getPosition().lat();
            lng = marker.getPosition().lng();
        
            document.getElementById("latitud").value = lat;
            document.getElementById("longitud").value = lng;
            });
          
            var distrito = document.getElementById("distrito");

            google.maps.event
              .addDomListener(
                distrito,
                "change",
                function () {
          
                  var geocoder = new google.maps.Geocoder();
          
                  var distritoV = distrito.value;
                  if (distritoV.length > 1) {
                    var departamentoT = document
                      .getElementById('departamento').options[document
                        .getElementById('departamento').selectedIndex].text;
                    var distritoT = document.getElementById('distrito').options[document
                      .getElementById('distrito').selectedIndex].text;
                    var ubicacion = distritoT + ", " + departamentoT
                      + ", Peru";
                    geocoder
                      .geocode(
                        {
                          "address": ubicacion
                        },
                        function (data) {
                          var lat = data[0].geometry.location
                            .lat();
                          var lng = data[0].geometry.location
                            .lng();
                          var origin = new google.maps.LatLng(
                            lat, lng);
                          document
                            .getElementById('latitud').value = lat;
                          document
                            .getElementById('longitud').value = lng;
                          marker.setPosition(origin);
                          map.setCenter(origin);
                          map.setZoom(15);
          
                        });
                  }
          
                });

        } else {
          alert("No existe la Emergencia");
        }
      }
    });
  }

    $(document).ready(function () {
      var data;
      table = $('#dt-emergencias').DataTable({
      data: emerg,
      pageLength: 10,
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      autoWidth: true,
      lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
      columns: [
        {
          data: null,
            render: function (data, type, row, meta) {
            const btnEdit = data.activo == "1" ? `
            <input type="hidden" value="`+data.idemergencia+`" /><button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` : `
            <button class="btn btn-warning btn-circle disabled" title="Editar Registro" type="button" style="margin-right: 5px;">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` ;
            
            const btnDelete = data.activo == "1" ? `
            <button class="btn btn-danger btn-circle actionDeleteComi" title="Anular Registro" type="button style="margin-right: 5px;">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>` : `<button class="btn btn-danger btn-circle disabled" title="Anular Registro" type="button style="margin-right: 5px;">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>`;

            return `<div style="display: flex">
                    ${canEdit ? btnEdit : ''} 
                    ${canDelete ? btnDelete : ''}
                    </div>`;
        }
        },
        { data: "region" },
        { data: "telefono01" },
        { data: "telefono02" },
        { data: "nombres" },
        { data: "apellidos" },
        { data: "tipo_incidente"},      
      ],
      columnDefs: [],
      select: true,
      buttons: {
        dom: {
          container: {
            tag: 'div',
            className: 'flexcontent'
          },
          buttonLiner: {
            tag: null
          }
        },
        buttons: [{
          extend: 'copy',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5, 6] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5, 6] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5, 6] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Emergencias',
          orientation: 'landscape',
          exportOptions: { columns: [1, 2, 3, 4, 5, 6] },
        },
        {
          extend: 'print',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5, 6] },
          customize: function (win) {
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');

            $(win.document.body).find('table')
              .addClass('compact')
              .css('font-size', 'inherit');

            var css = '@page { size: landscape; }',
              head = win.document.head || win.document.getElementsByTagName('head')[0],
              style = win.document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet) {
              style.styleSheet.cssText = css;
            }
            else {
              style.appendChild(win.document.createTextNode(css));
            }

            head.appendChild(style);
          }
        },
        {
          extend: 'pageLength',
          titleAttr: 'Registros a Mostrar',
          className: 'selectTable'
        }]
      }

    });

    $(".actionEdit").on('click', function (event) {
      const inp = this.previousSibling;
      buscar(inp.value);
      showModal(event, 'Editar Emergencia');
    });

  });

    $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();
      $("#datos").hide();
      $(".etiq").show();
      $("#act").val(0);
      $("#enviar").text("Guardar");
      $("#formRegistrar select").prop('selectedIndex',0);
      if($("#nombres").is('[readonly]'))
        $("#nombres").prop("readonly", false);
      if($("#apellidos").is('[readonly]'))
        $("#apellidos").prop("readonly", false);
      if($("#doc").prop("disabled"))
        $("#doc").prop("disabled", false);
      $("#btn-buscar").show();
      showModal(event, 'Registrar Nueva Emergencia');
    });

    $("#btn-buscar").on("click", function () {
			var documento_numero = $("input[name=doc]").val();
      var type = $("select#tipoDoc").children("option:selected").val();
      if(documento_numero != "" && type != ""){
				$.ajax({
					url: URI + "emergencias/main/curl",
					data: { type: type, document: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
					},
					beforeSend: function () { $("#btn-buscar").html('<i class="fa fa-spinner fa-pulse"></i>'); },
					success: function (response) {            
            if(response.data){
              if(!$("#nombres").prop("readonly"))
                $("#nombres").prop("readonly", true);
              if(!$("#apellidos").prop("readonly"))
                $("#apellidos").prop("readonly", true);
              const { data } = response;
              const datos = data.attributes;
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
              $("#apellidos").val(datos.apellido_paterno+" "+datos.apellido_materno);
              $("#nombres").val(datos.nombres);
              $("#dir").html(datos.domicilio_direccion);
              $("#fechNac").val(datos.fecha_nacimiento);
              $("#datos").show();
            }else{
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
              alert(response.errors[0].detail);
              if($("#nombres").prop("readonly"))
                $("#nombres").prop("readonly", false);
              if($("#apellidos").prop("readonly"))
                $("#apellidos").prop("readonly", false);
              $("#apellidos").val("");
              $("#nombres").val("");
              if($("#datos").show())
                $("#datos").hide();
            }
					}
				});
			}else{
        alert("Debe ingresar el numero de documento y el tipo");
      }
		});

    $("#formRegistrar").validate({
      rules: {
        tlf: { required: true },
        tipoLl: { required: true },
        tlf2: { required: true },
        tipoDoc: { required: true },
        nroDoc: { required: true, maxlength: 9},
        doc: { required: true },
        apellidos: { required: true },
        nombres: { required: true },
        incidente: { required: true },
        fecha: { required: true },
        prioridad: { required: true },
        direccion: { required: true },
        departamento: { required: true },
        provincia: { required: true },
        distrito: { required: true },
      },
      messages: {
        tlf: { required: "Campo requerido" },
        tipoLl: { required: "Campo requerido" },
        tlf2: { required: "Campo requerido" },
        tipoDoc: { required: "Campo requerido" },
        nroDoc: { required: "Campo requerido" },
        doc: { required: "Campo requerido" },
        apellidos: { required: "Campo requerido" },
        nombres: { required: "Campo requerido" },
        incidente: { required: "Campo requerido" },
        fecha: { required: "Campo requerido" },
        prioridad: { required: "Campo requerido" },
        direccion: { required: "Campo requerido" },
        departamento: { required: "Campo requerido" },
        provincia: { required: "Campo requerido" },
        distrito: { required: "Campo requerido" },
      },
      submitHandler: function (form, event) {
        var formData = new FormData(document.getElementById("formRegistrar"));
       
        $.ajax({
          type: 'POST',
          url: URI + 'emergencias/main/guardarEmergencia',
          data: formData,
          dataType: 'json',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function () {
  
          },
          success: function (response) {
            $("#editarModal").modal('hide');
            if (response.status === 200) {
              $("#formRegistrar")[0].reset();
              $('.btn-editar').removeClass('active');
              loadData();
              $('.alert-success').fadeIn(1000);
            } else {
              $('.alert-danger').fadeIn(1000);
            }
          }
        });
      }
    });

    $("#departamento").change(function () {
        var id = $(this).val();
    
        if (id.length > 0) {
    
          $.ajax({
            data: { departamento: id },
            url: URI + "emergencias/main/cargarProvincias",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $("#provincia").html('<option value="">Cargando...</option>');
              $("#distrito").html('<option value="">--Elija Provincia--</option>');
            },
            success: function (data) {
    
              var $html = '<option value="">--Seleccione--</option>';
              $.each(data.lista, function (i, e) {
    
                $html += '<option value="' + e.cod_pro + '">' + e.provincia + '</option>';
    
              });
              $("#provincia").html($html);
    
            }
          });
    
        }
      });
    
      $("#provincia").change(function () {
    
        var id = $(this).val();
        var departamento = $("#departamento").val();
    
        if (id.length > 0 && departamento.length > 0) {
    
          $.ajax({
            data: { departamento: departamento, provincia: id },
            url: URI + "emergencias/main/cargarDistritos",
            method: "POST",
            dataType: "json",
            beforeSend: function () {
              $("#distrito").html('<option value="">Cargando...</option>');
            },
            success: function (data) {
    
              var $html = '<option value="">--Seleccione--</option>';
              $.each(data.lista, function (i, e) {
    
                $html += '<option value="' + e.cod_dis + '">' + e.distrito + '</option>';
    
              });
              $("#distrito").html($html);
    
            }
          });
    
        }
      });

      function loadData() {
        $.ajax({
          type: 'POST',
          url: URI + 'emergencias/main/listarEmergencias',
          data: {'actualiza' : 'si'},
          dataType: 'json',
          success: function (response) {
            console.log(response);
            table.clear();
            table.rows.add(response).draw();            
            $(".actionEdit").on('click', function (event) {
              const inp = this.previousSibling;
              buscar(inp.value);
              showModal(event, 'Editar Emergencia');
            });
          }
        });
      }

      $("#region").on("change", function () {

        var region = $("#region").val();
        console.log(region);
        if (region.length > 0) {      
          post(URI + "emergencias/listar", { region });      
        }      
      });
}