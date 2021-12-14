function fichaatencion(URI) {
    var table = null;
    
    var listaCIE10 = [];
    var listaMomentoEvaluacion = [];

    function showModal(event,title) {
        $("#editarModal").modal("show");
        $("#editarModalLabel").text(title);
        event.stopPropagation();
        event.stopImmediatePropagation();
    }
    
    function showModalMomento(event,title) {
      $("#momentoevaluacionModal").modal("show");
      $("#momentoevaluacionModalLabel").text(title);
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
    
    
    function loadData(table) {
      $.ajax({
        type: 'POST',
        url: URI + 'fichaatencion/main/listaFichaAtencion',
        data: {},
        dataType: 'json',
        success: function (response) {
          const { data: { listaFichaAtencion } } = response;
          table.clear();
          table.rows.add(listaFichaAtencion).draw();
          $(".actionEdit").on('click', function (event) {
            var valor ="", i = 0;
            $(this).parents("tr").find("td").each(function(){
              if(i == 1)
                valor = $(this).html();
              i++;
            });
            $("#formRegistrar")[0].reset();
            //buscar();
            showModal(event, 'Editar Ficha Atención');
          });
        }
      });
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

  var tableEnfermedades = $('.tableEnfermedades').DataTable({
		"pageLength": 7,
		"bLengthChange": false,
		"info": false,
		"ajax": {
			url: URI + "public/js/fichaatencion/enfermedades.txt",
			method: "POST"
		}
	});

  
  var tbListarmedicamentos = $('#tbListarmedicamentos').DataTable(
		{
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
      {
				"data": "descripcion"
			},
			{
				"data": "dosis"
			},
			{
				"data": "hora"
			},
			{
				"data": "idarticulo"
			}
      
			],
			columnDefs: [{
				"targets": [3],
				"visible": false,
				"searchable": false
			}],
			order: [],
			buttons: [
				{
					extend: 'copy',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'csv',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'excel',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'pdf',
					title: 'Lista de Momentos de Evaluación',
					orientation: 'landscape',
					exportOptions: {
						columns: [1]
					}
				},

				{
					extend: 'print',
					title: 'Lista de Momentos de Evaluación',
					customize: function (win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table').addClass(
							'compact').css('font-size', 'inherit');
					}
				}]

		});

    var table1 = $('#tbListar').DataTable(
		{
			dom: '<"html5buttons"B>lTfgitp',
			columns: [
      {
				"data": "tipo_text"
			},
			{
				"data": "temperaperatura"
			},
			{
				"data": "frecuencia_cardiaca"
			},
			{
				"data": "presion_arterial"
			},
			{
				"data": "frecuencia_respiratoria"
			},
			{
				"data": "saturacion_exigeno"
			},
			{
				"data": "glicemia"
			},
			{
				"data": "glasgow_ocular_text"
			},
			{
				"data": "glasgow_verbal_text"
			},
			{
				"data": "glasgow_motora_text"
			},
			{
				"data": "glasgow_total"
			},
			{
				"data": "pupilas_tipo_text"
			},
			{
				"data": "pupilas_reactiva_text"
			},
      {
				"data": "tipo"
			},
			{
				"data": "glasgow_ocular"
			},
			{
				"data": "glasgow_verbal"
			},
			{
				"data": "glasgow_motora"
			},
			{
				"data": "pupilas_tipo"
			},
			{
				"data": "pupilas_reactiva"
			},
      
			],
			columnDefs: [{
				"targets": [13,14,15,16,17,18],
				"visible": false,
				"searchable": false
			}],
			order: [[0, "desc"]],
			buttons: [
				{
					extend: 'copy',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'csv',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'excel',
					title: 'Lista de Momentos de Evaluación',
					exportOptions: {
						columns: [1]
					}
				},
				{
					extend: 'pdf',
					title: 'Lista de Momentos de Evaluación',
					orientation: 'landscape',
					exportOptions: {
						columns: [1]
					}
				},

				{
					extend: 'print',
					title: 'Lista de Momentos de Evaluación',
					customize: function (win) {
						$(win.document.body).addClass('white-bg');
						$(win.document.body).css('font-size', '10px');

						$(win.document.body).find('table').addClass(
							'compact').css('font-size', 'inherit');
					}
				}]

		});

    var table2 = $('#tbListar1').DataTable(
      {
        dom: '<"html5buttons"B>lTfgitp',
        columns: [{
          "data": "descripcion"
        },
        {
          "data": "cie10"
        }
        ,
        {
          "data": "editar"
        }
        ],
        columnDefs: [{
          "targets": [],
          "visible": false,
          "searchable": false
        }],
        order: [[0, "desc"]],
        buttons: [
          {
            extend: 'copy',
            title: 'Lista CIE10',
            exportOptions: {
              columns: [0,1]
            }
          },
          {
            extend: 'csv',
            title: 'Lista CIE10',
            exportOptions: {
              columns: [0,1]
            }
          },
          {
            extend: 'excel',
            title: 'Lista CIE10',
            exportOptions: {
              columns: [0,1]
            }
          },
          {
            extend: 'pdf',
            title: 'Lista CIE10',
            orientation: 'landscape',
            exportOptions: {
              columns: [0,1]
            }
          },
  
          {
            extend: 'print',
            title: 'Lista CIE10',
            customize: function (win) {
              $(win.document.body).addClass('white-bg');
              $(win.document.body).css('font-size', '10px');
  
              $(win.document.body).find('table').addClass(
                'compact').css('font-size', 'inherit');
            }
          }]
  
      });

    $(document).ready(function () {
      var data;

      $(".btnMedicamentoss").on('click', function (event) {
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/listaArticulos',
          data: {},
          dataType: 'json',
          success: function (response) {
            const { data: { listaArticulos } } = response;
            tableMedicamentos.clear();
            tableMedicamentos.rows.add(listaArticulos).draw();
            $("#tableMedicamentosModal").modal('show');
          }
        });
      });

      $("#btnMedicamentos").on("click", function () {
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/listaArticulos',
          data: {},
          dataType: 'json',
          success: function (response) {
            const { data: { listaArticulos } } = response;
            tableMedicamentos.clear();
            tableMedicamentos.rows.add(listaArticulos).draw();
            $("#tableMedicamentosModal").modal('show');
          }
        });
      });


      var tableMedicamentos = $('.tableMedicamentos').DataTable({
        data: [],
        pageLength: 10,
        dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
        //language: languageDatatable,
        autoWidth: true,
        lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
        columns: [
          { data: "descripcion" },
          { data: "idarticulo" }
        ],
        columnDefs: [{
          "targets": [1],
          "visible": false,
          "searchable": false
        }],
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
            extend: 'pageLength',
            titleAttr: 'Registros a mostrar',
            className: 'selectTable'
          }]
        }
    
      });

    $('#momentoevaluacionModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
    });

    $('#tableEnfermedadesModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
    });

    $('#tableMedicamentosModal').on('hidden.bs.modal', function () {
      $(document.body).addClass('modal-open');
    });

    $('#tableEnfermedades').on('click', 'tbody tr td', function () {
				var data = tableEnfermedades.row(this).data();
        var editar = '<div class="flex-buttons"><button class="btn btn-danger btn-circle actionDeleteL" title="ELIMINAR" type="button"><i class="fa fa-trash"></i></button></div>';
        
        var tr = $(this).parents('tr');
			  var row = tableEnfermedades.row(tr);
        
        var datos = {
          "cie10": data[0],
          "descripcion": data[1],
          "editar": editar
        };
          table2.row.add(datos).draw();
          datos2 = row.data();
          listaCIE10.push(datos2[0]);
          $('#tableEnfermedadesModal').modal('hide');

		});

    $('.tableMedicamentos tbody').on('click', 'tr', function () {
      var tr = $(this);
      var row = tableMedicamentos.row(tr);
      var dosis = document.getElementById("dosis").value;
      var hora = document.getElementById("hora").value;
      //const rowTable = tableArticuloIngresos.rows().data().toArray();
      index = row.index();
      data = row.data();
      //var data = tableMedicamentos.row(this).data();

      console.log(data);
      var datos = {
        "descripcion": data.descripcion,
        "dosis": dosis,
        "hora": hora,
        "idarticulo": data.idarticulo
      };
      tbListarmedicamentos.row.add(datos).draw();
      $("#tableMedicamentosModal").modal('hide');
      });

      $("html, body").on("click", ".actionDeleteL", function () {
        var tr = $(this).parents('tr');
        var row = table2.row(tr);
        data = row.data();
        console.log(data);
  
        $("#idEliminar").val(data.cie10);
        $("#condicionModal").modal("show");
        $("#condicionModal .modal-title").text("Eliminar CIE10");
        $("#condicionModal .modal-body p").html("Est\xe1 seguro de querer eliminar el CIE10 <b> " + data.cie10 + "</b>");
  
      });

    var data;
    var validate = 1;
    var table = $('#dt-fichaatencion').DataTable({
      data: lista,
      pageLength: 10,
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      //language: languageDatatable,
      autoWidth: true,
      lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
      columns: [
        {
          data: null,
            
          render: function (data, type, row, meta) {
            const btnEdit = data.activo == "1" ? `
            <input type="hidden" value="`+data.idfichaatencion+`" /><button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
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
        { data: "lugar_atencion" },
        { data: "idtiposeguro" },
        { data: "motivo_emergencia" },
        { data: "idtipodocumento" },
        { data: "numero_documento" },
        { data: "paciente_apellidos"},      
        { data: "fecha_ocurrencia"},      
        { data: "idprioridademergencia"}
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
          title: 'Lista General de Ficha de Atención',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Ficha de Atención',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Ficha de Atención',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Ficha de Atención',
          orientation: 'landscape',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'print',
          title: 'Lista General de Ficha de Atención',
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

    $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();

      $("#btn-buscar").show();
      showModal(event, 'Registrar Nueva Ficha de Atención');
    });


    $("#btnClearFields").on("click", function () {
      //habilitarCampos();
      $("#momentoevaluacionModal").modal("show");
      //$("#registrarTableroModalLabel").html("Registrar Momento Evaluación");
    });


    $("#btn-buscar").on("click", function () {
			var documento_numero = $("input[name=numero_documento]").val();
      var type = $("select#idtipodocumento").children("option:selected").val();
      if(documento_numero != "" && type != ""){
				$.ajax({
					url: URI + "fichaatencion/main/curl",
					data: { type: type, document: documento_numero },
					method: 'post',
					dataType: 'json',
					error: function (xhr) {
						$("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
					},
					beforeSend: function () { $("#btn-buscar").html('<i class="fa fa-spinner fa-pulse"></i>'); },
					success: function (response) {            
            if(response.data){
              if(!$("#paciente_apellidos").prop("readonly"))
                $("#paciente_apellidos").prop("readonly", true);
              const { data } = response;
              const datos = data.attributes;
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');
              $("#paciente_apellidos").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
              $("#direccion_atencion").val(datos.domicilio_direccion);
              $("#fecha_nacimiento").val(datos.fecha_nacimiento);
              $("#edad_actual").val(datos.edad_anios);
              $("#sexo").val(datos.sexo);
              $("#datos").show();
              if(datos.sexo==1)
                {
                  $("#gestante").prop("readonly", false);
                }
            }else{
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
              alert(response.errors[0].detail);
              if($("#paciente_apellidos").prop("readonly"))
                $("#paciente_apellidos").prop("readonly", false);
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
      /*
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
      */
      submitHandler: function (form, event) {
        
        if (listaCIE10.length == 0) {
					return false;
				}
        if (listaMomentoEvaluacion.length == 0) {
					return false;
				}
        var formData = new FormData(document.getElementById("formRegistrar"));
      
        var cie10lista = '';
				$.each(listaCIE10, function (i, e) {

					if (i == 0) {
						cie10lista += e;
					} else {
						cie10lista += "|" + e;
					}     
          
				});


        const data = table1.rows().data().toArray();
        if (data.length === 0) {
           showAlertForm(`No hay ningún Registro, <a class="alert-link">Ingrese al menos 1 registro.</a>`);
           return;
        }

        const data1 = tbListarmedicamentos.rows().data().toArray();

        formData.append("tipo", data.map((item) => item.tipo).join('|'));
        formData.append("temperaperatura", data.map((item) => item.temperaperatura).join('|'));
        formData.append("frecuencia_cardiaca", data.map((item) => item.frecuencia_cardiaca).join('|'));
        formData.append("presion_arterial", data.map((item) => item.presion_arterial).join('|'));
        formData.append("frecuencia_respiratoria", data.map((item) => item.frecuencia_respiratoria).join('|'));
        formData.append("saturacion_exigeno", data.map((item) => item.saturacion_exigeno).join('|'));
        formData.append("glicemia", data.map((item) => item.glicemia).join('|'));
        formData.append("glasgow_ocular", data.map((item) => item.glasgow_ocular).join('|'));
        formData.append("glasgow_verbal", data.map((item) => item.glasgow_verbal).join('|'));
        formData.append("glasgow_motora", data.map((item) => item.glasgow_motora).join('|'));
        formData.append("pupilas_tipo", data.map((item) => item.pupilas_tipo).join('|'));
        formData.append("pupilas_reactiva", data.map((item) => item.pupilas_reactiva).join('|'));

        formData.append("dosis", data1.map((item) => item.dosis).join('|'));
        formData.append("hora", data1.map((item) => item.hora).join('|'));
        formData.append("idarticulo", data1.map((item) => item.idarticulo).join('|'));

        formData.append("cie10lista", cie10lista);
       
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/guardarFichaAtencion',
          data: formData,
          dataType: 'json',
          cache: false,
          contentType: false,
          processData: false,
          beforeSend: function () {
  
          },
          success: function (response) {
            $("#editarModal").modal('hide');
            const { status } = response;
            if (status === 200) {
              $("#formRegistrar")[0].reset();
              $('.btn-editar').removeClass('active');
              loadData(table)
              $('.alert-success').fadeIn(1000);
            } else {
              $('.alert-danger').fadeIn(1000);
            }
            setTimeout(() => {
              $('.alert').fadeOut(1000);
            }, 1500);
          }
        });
      }
    });

    $("#formRegistrar1").validate(
      {
        
        /*
        rules: {
          Evento_Danios_Lesionados_Fecha_Atencion: {
            required: true
          },
          Tipo_Documento_Codigo: {
            required: false
          },
          Lesionado_Documento_Numero: {
            digits: true
          },
          Lesionado_Apellidos: {
            required: true,
            lettersonly: true
          },
          Lesionado_Nombres: {
            required: true,
            lettersonly: true
          },
          Lesionado_Edad: {
            required: false,
            digits: true
          },
          Lesionado_Observaciones: {
            required: true
          },
          Nivel_Gravedad_Codigo: {
            required: true
          },
          Situacion_Codigo: {
            required: true
          },
          Lesionado_CIE10_Codigo: {
            required: true
          },
          Lesionado_Genero: {
            required: true
          },
          Lesionado_Entidad_Salud_Codigo: {
            min: 1
          },
          Lesionado_Entidad_Salud_Nombre: {
            required: function () { if ($("select[name=Lesionado_Entidad_Salud_Codigo]").val() == "1") return false; else return true; }
          }

        },
        messages: {
          Evento_Danios_Lesionados_Fecha_Atencion: {
            required: "Campo requerido"
          },
          Tipo_Documento_Codigo: {
            required: "Campo requerido"
          },
          Lesionado_Documento_Numero: {
            required: "Campo requerido",
            digits: "Solo n\xfameros"
          },
          Lesionado_Apellidos: {
            required: "Campo requerido"
          },
          Lesionado_Nombres: {
            required: "Campo requerido"
          },
          Lesionado_Edad: {
            required: "Campo requerido",
            digits: "Solo n\xfameros"
          },
          Lesionado_Observaciones: {
            required: "Campo requerido"
          },
          Nivel_Gravedad_Codigo: {
            required: "Campo requerido"
          },
          Situacion_Codigo: {
            required: "Campo requerido"
          },
          Lesionado_CIE10_Codigo: {
            required: "Campo requerido"
          },
          Lesionado_Genero: {
            required: "Campo requerido"
          },
          Lesionado_Entidad_Salud_Codigo: {
            min: "Campo requerido"
          },
          Lesionado_Entidad_Salud_Nombre: {
            required: "Campo requerido"
          }
        },*/
        
        submitHandler: function (form, event) {
          event.preventDefault();
          
          var tipo = $("#formRegistrar1 select[name=tipo]").val();
          var temperaperatura = $("#formRegistrar1 input[name=temperaperatura]").val();
          var frecuencia_cardiaca = $("#formRegistrar1 input[name=frecuencia_cardiaca]").val();
          var presion_arterial = $("#formRegistrar1 input[name=presion_arterial]").val();
          var frecuencia_respiratoria = $("#formRegistrar1 input[name=frecuencia_respiratoria]").val();
          var saturacion_exigeno = $("#formRegistrar1 input[name=saturacion_exigeno]").val();
          var glicemia = $("#formRegistrar1 input[name=glicemia]").val();
          var glasgow_ocular = $("#formRegistrar1 select[name=glasgow_ocular]").val();
          var glasgow_verbal = $("#formRegistrar1 select[name=glasgow_verbal]").val();
          var glasgow_motora = $("#formRegistrar1 select[name=glasgow_motora]").val();
          
          var sumaglasgow = parseInt(glasgow_ocular) + parseInt(glasgow_verbal) + parseInt(glasgow_motora);

          var glasgow_total = sumaglasgow;
          var pupilas_tipo = $("#formRegistrar1 select[name=pupilas_tipo]").val();
          var pupilas_reactiva = $("#formRegistrar1 select[name=pupilas_reactiva]").val();
          
          var tipotext = $("#formRegistrar1 select[name=tipo] option:selected").text();
          var glasgow_oculartext = $("#formRegistrar1 select[name=glasgow_ocular] option:selected").text();
          var glasgow_verbaltext = $("#formRegistrar1 select[name=glasgow_verbal] option:selected").text();
          var glasgow_motoratext = $("#formRegistrar1 select[name=glasgow_motora] option:selected").text();
          var pupilas_tipotext = $("#formRegistrar1 select[name=pupilas_tipo] option:selected").text();
          var pupilas_reactivatext = $("#formRegistrar1 select[name=pupilas_reactiva] option:selected").text();
          /*
          var idmomento = $("#formRegistrar1 input[name=idmomento]").val();
          var idfichaatencion = $("#formRegistrar1 input[name=idfichaatencion]").val();
          */

          var editar = "";
          
          var datos = {            
            "tipo": tipo,
            "temperaperatura": temperaperatura,
            "frecuencia_cardiaca": frecuencia_cardiaca,
            "presion_arterial": presion_arterial,
            "frecuencia_respiratoria": frecuencia_respiratoria,
            "saturacion_exigeno": saturacion_exigeno,
            "glicemia": glicemia,
            "glasgow_ocular": glasgow_ocular,
            "glasgow_verbal": glasgow_verbal,
            "glasgow_motora": glasgow_motora,
            "glasgow_total": glasgow_total,
            "pupilas_tipo": pupilas_tipo,
            "pupilas_reactiva": pupilas_reactiva,
            "tipo_text": tipotext,
            "glasgow_ocular_text": glasgow_oculartext,
            "glasgow_verbal_text": glasgow_verbaltext,
            "glasgow_motora_text": glasgow_motoratext,
            "pupilas_tipo_text": pupilas_tipotext,
            "pupilas_reactiva_text": pupilas_reactivatext
            /*,
            "idmomento": idmomento,
            "idfichaatencion": idfichaatencion*/            
          };
          
            table1.row.add(datos).draw();
            listaMomentoEvaluacion.push(datos);

            console.log("Lista de Momento de Evaluación: " + listaMomentoEvaluacion.tipo);
            console.log("Lista de Momento de Evaluación: " + datos.tipo);
            console.log("Lista de Momento de Evaluación: " + listaMomentoEvaluacion.temperaperatura);
            console.log("Lista de Momento de Evaluación: " + listaMomentoEvaluacion.frecuencia_cardiaca);
          $("#formRegistrar1")[0].reset();
          
          $("#momentoevaluacionModal").modal("hide");
          
        }

      });

      $(".actionEdit").on('click', function (event) {
        const inp = this.previousSibling;
        buscar(inp.value);
        showModal(event, 'Editar Ficha Atención');
      });


      $("#btn-buscarmed").on("click", function () {
        var documento_numero = $("input[name=numero_documento_medico]").val();
        var type = $("select#idtipodocumento_medico").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarmed").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarmed").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapemed").prop("readonly"))
                  $("#nombapemed").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmed").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapemed").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmed").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapemed").prop("readonly"))
                  $("#nombapemed").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

      $("#btn-buscarenf").on("click", function () {
        var documento_numero = $("input[name=numero_documento_enfermero]").val();
        var type = $("select#idtipodocumento_enfermero").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarenf").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarenf").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapeenf").prop("readonly"))
                  $("#nombapeenf").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarenf").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapeenf").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarenf").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapeenf").prop("readonly"))
                  $("#nombapeenf").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

      $("#btn-buscarpil").on("click", function () {
        var documento_numero = $("input[name=numero_documento_piloto]").val();
        var type = $("select#idtipodocumento_piloto").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarpil").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarpil").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapepil").prop("readonly"))
                  $("#nombapepil").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarpil").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapepil").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarpil").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapepil").prop("readonly"))
                  $("#nombapepil").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

      $("#btn-buscarmedreg").on("click", function () {
        var documento_numero = $("input[name=numero_documento_medico_regulador]").val();
        var type = $("select#idtipodocumento_medico_regulador").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarmedreg").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarmedreg").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapemedreg").prop("readonly"))
                  $("#nombapemedreg").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmedreg").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapemedreg").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmedreg").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapemedreg").prop("readonly"))
                  $("#nombapemedreg").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

      $("#btn-buscarprofr").on("click", function () {
        var documento_numero = $("input[name=numero_documento_profesional_receptor]").val();
        var type = $("select#idtipodocumento_profesional_receptor").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarprofr").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarprofr").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapeprorec").prop("readonly"))
                  $("#nombapeprorec").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarprofr").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapeprorec").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarprofr").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapeprorec").prop("readonly"))
                  $("#nombapeprorec").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

      $("#btn-buscarmedrec").on("click", function () {
        var documento_numero = $("input[name=numero_documento_medico_receptor]").val();
        var type = $("select#idtipodocumento_medico_receptor").children("option:selected").val();
        if(documento_numero != "" && type != ""){
          $.ajax({
            url: URI + "fichaatencion/main/curl",
            data: { type: type, document: documento_numero },
            method: 'post',
            dataType: 'json',
            error: function (xhr) {
              $("#btn-buscarmedrec").html('<i class="fa fa-search" aria-hidden="true"></Buscar>');
            },
            beforeSend: function () { $("#btn-buscarmedrec").html('<i class="fa fa-spinner fa-pulse"></i>'); },
            success: function (response) {            
              if(response.data){
                if(!$("#nombapemedrec").prop("readonly"))
                  $("#nombapemedrec").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmedrec").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombapemedrec").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmedrec").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombapemedrec").prop("readonly"))
                  $("#nombapemedrec").prop("readonly", false);
                if($("#datos").show())
                  $("#datos").hide();
              }
            }
          });
        }else{
          alert("Debe ingresar el numero de documento y el tipo");
        }
      });

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

      $("#region").on("change", function () {

        var region = $("#region").val();
        console.log(region);
        if (region.length > 0) {      
          post(URI + "emergencias/listar", { region });      
        }      
      });
}