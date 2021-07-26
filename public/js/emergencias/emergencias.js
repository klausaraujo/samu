function emergencias(URI) {
    var table = null;

    function showModal(event,title) {
        $("#editarModal").modal("show");
        $("#editarModalLabel").text(title);
        event.stopPropagation();
        event.stopImmediatePropagation();
    }

  function buscar(valor) {
    //alert("Buscar");
    var idEm = valor;
    $("#idem").val(idEm);
    //alert($("#idem").val());
    var opt = '<option value="" class="lista">---Seleccione---</option>';
            
    $("#formRegistrar")[0].reset();
    $(".etiq").hide();
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
          //console.log(response);          
          var k = 0; j = 0;
          var reg, idreg;
          var html = "";
          html = opt;
          for(k in incid) {
            reg = incid[k].tipo_incidente;
            idreg = incid[k].idtipoincidente;
            if(idreg == data[0].idtipoincidente){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#incidente").html(html);
          html = opt;
          for(k in tipo) {
            reg = tipo[k].tipo_llamada;
            idreg = tipo[k].idtipollamada;
            if(idreg == data[0].idtipollamada){
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + idreg + '">' + reg + '</option>';
          }
          $("#tipoLl").html(html);
          $("#tlf2").val(data[0].telefono02);
          if(data[0].es_paciente == 1)
            $('#sipaciente').prop('checked', true);
          if(data[0].masivo == 1)
            $('#simasivo').prop('checked', true);

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
      //language: languageDatatable,
      autoWidth: true,
      lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
      columns: [
        {
          data: null,
          /*"render": function (data, type, row, meta) {
            return `<button class="btn btn-warning btn-circle actionEdit" title="EDITAR" type="button">
            <i class="fa fa-pencil-square-o"></i></button>`
          }*/

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
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Emergencias',
          orientation: 'landscape',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'print',
          title: 'Lista General de Emergencias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
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
      showModal(event, 'Registrar Nueva Emergencia');
    });

    $("#btn-buscar").on("click", function () {
			var documento_numero = $("input[name=doc]").val();
      var type;
      if (documento_numero.length >= 8) {
				type = "01";
				if (documento_numero.length > 8) {
					type = "03";
				}

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
              //console.log(datos);
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
              $("#apellidos").val(datos.apellido_paterno+" "+datos.apellido_materno);
              $("#nombres").val(datos.nombres);
              $("#dir").html(datos.domicilio_direccion);
              $("#fechNac").val(datos.fecha_nacimiento);
              var fecha = (datos.fecha_nacimiento).split("-");
              $("#nac").html(fecha[2] + "/" + fecha[1] + "/" + fecha[0]);
              $("#datos").show();
              /*var fecha = (data.data.attributes.fecha_nacimiento).split("-"); $("input[name=fecha_nacimiento]").val(fecha[2] + "/" + fecha[1] + "/" + fecha[0]); $("input[name=edad]").val(data.data.attributes.edad_anios);
              $("select[name=estado_civil]").val(data.data.attributes.estado_civil);
              $("select[name=estado_civil]").attr("rel", data.data.attributes.estado_civil);
              $("select[name=genero]").val(data.data.attributes.sexo);
              $("select[name=genero]").attr("rel", data.data.attributes.sexo);
              $("input[name=apellidos]").val(data.data.attributes.apellido_paterno + " " + data.data.attributes.apellido_materno);
              $("input[name=nombres]").val(data.data.attributes.nombres);
              $("input[name=domicilio]").val(data.data.attributes.domicilio_direccion); let codigo_region = data.data.attributes.get_departamento_domicilio_ubigeo_inei;
              let codigo_provincia = data.data.attributes.get_provincia_domicilio_ubigeo_inei.slice(2);
              let codigo_distrito = data.data.attributes.get_distrito_domicilio_ubigeo_inei.slice(4);
              $("#departamento").val(codigo_region);
              listarProvinciasxRegion(codigo_region, codigo_provincia, codigo_distrito); let foto = data.data.attributes.foto;
              $("#foto_dni_str").val(foto);
              $("#blah").attr("src", 'data:image/(png|jpg);base64, ' + foto);*/
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
            //console.log(response);
            /*$("#selectRegion").remove();
            $("#nuevoDiv").show();*/
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
        if($(".btn-nuevo").prop("disabled"))
          $(".btn-nuevo").prop("disabled", false);
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
          data: {},
          dataType: 'json',
          success: function (response) {
            const { listaEmergencias } = response;
            table.clear();
            table.rows.add(listaEmergencias).draw();
            //console.log(listaEmergencias);
            
            $(".actionEdit").on('click', function (event) {
              const inp = this.previousSibling;
              buscar(inp.value);
              showModal(event, 'Editar Emergencia');
            });
          }
        });
      }


}