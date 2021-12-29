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
    
    function showAlertForm(htmlText) {
      $('.alert__spantbenf').html(htmlText || `El CIE10 ya esta registrado, <a class="alert-link">Seleccione otro CIE10.</a>`);
      $('.ingresos__alerttbenf').attr("hidden", false);
     // $('#editarModal').animate({ scrollTop: 0 }, 'slow');
      setTimeout(() => {
        $('.ingresos__alerttbenf').attr("hidden", true);
      }, 3000);
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
    //$("#enviar").text("Actualizar");
    $("#formRegistrar select").prop('selectedIndex',0);

  }

    $(document).ready(function () {
      
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
            },
            {
              data: null,
              className: "center",
              defaultContent: `<button class="btn btn-danger btn-circle actionDelete" title="ELIMINAR" type="button">
                <i class="fa fa-trash" aria-hidden="true"></i>
              </button>`,
              orderable: false
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
              }]
      
          });

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
    
    var navListItems = $('div.setup-panel div a');
		var allWells = $(".setup-content");

		navListItems.on("click", function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
				$item = $(this);

			if (!$item.hasClass('disabled')) {
				navListItems.removeClass('active');
				$item.addClass('active');
				allWells.hide();
				$target.show();
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
        
        console.log(data);
        console.log(data[0]);
        const rowTable = table2.rows().data().toArray();

        console.log(rowTable);
        
        var tr = $(this).parents('tr');
			  var row = tableEnfermedades.row(tr);
        
        if (rowTable.find(item => item.cie10 === data[0])) {
          showAlertForm();
        } else {
         // tableArticuloIngresos.rows.add([data]).draw();
        
        var datos = {
          "cie10": data[0],
          "descripcion": data[1],
          "editar": editar
        };
          table2.row.add(datos).draw();
          datos2 = row.data();
          listaCIE10.push(datos2[0]);
          $('#tableEnfermedadesModal').modal('hide');
      }
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

      /*
      $('body').on('click', 'td button.actionDeleteL', function (e) {
        debugger;
        e.preventDefault();
        table2.row($(this).parents('tr')).remove().draw(false);
        //const data = table2.rows().data();
        /*if (data.length === 0) {
          $('#almacen').removeAttr("disabled");
          $('.btn-buscar').removeAttr("disabled");
        }
      });
      */
    
      $("html, body").on("click", ".actionDeleteL", function () {
       
        debugger;
        e.preventDefault();
        table2.row($(this).parents('tr')).remove().draw(false);
        
        /*
        var tr = $(this).parents('tr');
        var row = table2.row(tr);
        data = row.data();
        console.log(data);
        
        $("#idEliminar").val(data.cie10);
        $("#condicionModal").modal("show");
        $("#condicionModal .modal-title").text("Eliminar CIE10");
        $("#condicionModal .modal-body p").html("Est\xe1 seguro de querer eliminar el CIE10 <b> " + data.cie10 + "</b>");
        */
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
        { data: "direccion_atencion" },
        { data: "despacho_ambulancia" },
        { data: "motivo_emergencia" },
        { data: "tipo_documento" },
        { data: "numero_documento" },
        { data: "paciente_apellidos"},      
        { data: "fecha_ocurrencia"},      
        { data: "estado"}
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
        buttons: [
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
          extend: 'pageLength',
          titleAttr: 'Registros a Mostrar',
          className: 'selectTable'
        }],
        language:
        {
           search: "Buscar:",
           lengthMenu: "Mostrando _MENU_ registros por página",
           zeroRecords: "Sin registros",
           info: "Mostrando página  _PAGE_ de _PAGES_",
           infoEmpty: "No hay registros disponibles",
           infoFiltered: "(filrado de _MAX_ registros totales)",
           paginate: {
              first: "Primero",
              last: "Último",
              next: "Siguiente",
              previous: "Anterior"
           },
        }
      }
  
    });

    $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();
      $('#idfichaatencion').val('');
      $('#idantedecentes').val('');
      $('#idexamen').val('');
      $('#idmecanismo').val('');
      $('#idprocedimiento').val('');
      $('#idtripulacion').val('');

      table1.clear().draw();
      table2.clear().draw();
      tbListarmedicamentos.clear().draw();
      $("#btn-buscar").show();
      showModal(event, 'Registrar Nueva Ficha de Atención');
    });


    $("#btnClearFields").on("click", function () {

     var valores = [];
     var sele = document.getElementById("tipo");
      var length = sele.options.length;
      for (i = length-1; i >= 0; i--) {
        sele.options[i] = null;
      }
      select = document.getElementById('tipo');

      $('#tbListar > tbody > tr').each(function(index) {
        //console.log(index);
        var firstTd = $(this).find('td:first');
        console.log(firstTd.text());
        if ($(firstTd).text() === "Inicial") {
          console.log("entro aki al if");
          var opt2 = document.createElement('option');
          var opt3 = document.createElement('option');
          opt2.value = 2;
          opt2.innerHTML = 'Traslado';
          select.add(opt2,null);
          opt3.value = 3;
          opt3.innerHTML = 'Llegada';
          select.add(opt3,null);
        }      
        else
        {
          console.log("entro aki al else");
          //console.log(item.tipo);
          var opt1 = document.createElement('option');
          var opt2 = document.createElement('option');
          var opt3 = document.createElement('option');
          opt1.value = 1;
          opt1.innerHTML = 'Inicial';
          select.add(opt1,null);
          opt2.value = 2;
          opt2.innerHTML = 'Traslado';
          select.add(opt2,null);
          opt3.value = 3;
          opt3.innerHTML = 'Llegada';
          select.add(opt3,null);
        }
    })
      //habilitarCampos();
      $("#momentoevaluacionModal").modal("show");
    });

    $("#formRegistrar select[name=sexo]").on("change", function () {
      
      var sexo = $("#sexo").val();
      console.log(sexo);

      if (sexo == 1) {
        console.log("entre al if");
        disableTxt();
      }
      else if(sexo == 2){
      console.log("entre al else");
      undisableTxt();
      }
    });

    function disableTxt() {
      document.getElementById("p1").disabled = true;
      document.getElementById("p2").disabled = true;
      document.getElementById("p3").disabled = true;
      document.getElementById("p4").disabled = true;
      document.getElementById("fur").disabled = true;
      document.getElementById("fpp").disabled = true;
      document.getElementById("fug").disabled = true;
      document.getElementById("g").disabled = true;

      document.getElementById("p1").value = '';
      document.getElementById("p2").value = '';
      document.getElementById("p3").value = '';
      document.getElementById("p4").value = '';
      document.getElementById("fur").value = '';
      document.getElementById("fpp").value = '';
      document.getElementById("fug").value = '';
      document.getElementById("g").value = '';

    }
    
    function undisableTxt() {
      document.getElementById("p1").disabled = false;
      document.getElementById("p2").disabled = false;
      document.getElementById("p3").disabled = false;
      document.getElementById("p4").disabled = false;
      document.getElementById("fur").disabled = false;
      document.getElementById("fpp").disabled = false;
      document.getElementById("fug").disabled = false;
      document.getElementById("g").disabled = false;
    }

    $("#formRegistrar select[name=idtipodocumento]").on("change", function () {
      
      var tipodoc = $("#idtipodocumento").val();
      console.log(tipodoc);

      if (tipodoc == 0) {
        console.log("entre al if tipodoc");
        enabletxt();
      }

    });

    function enabletxt() {

      $("#paciente_apellidos").prop("readonly", false);
      $("#fecha_nacimiento").prop("readonly", false); 
      $("#edad_actual").prop("readonly", false);
      $("#sexo").attr("readonly", false);

      document.getElementById('numero_documento').value = '';
      document.getElementById('paciente_apellidos').value = '';
      document.getElementById('edad_actual').value = '';
      document.getElementById('fecha_nacimiento').value = '';
      document.getElementById('direccion_atencion').value = '';
      document.getElementById("sexo").selectedIndex = "0";

      undisableTxt();

    }

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
              if(!$("#fecha_nacimiento").prop("readonly"))
                $("#fecha_nacimiento").prop("readonly", true); 
              if(!$("#edad_actual").prop("readonly"))
                $("#edad_actual").prop("readonly", true);
              //if(!$("#sexo").prop("readonly"))
                $("#sexo").attr("readonly", true); 
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
                  disableTxt();
                }
                else{
                  undisableTxt();
                }
            }else{
              $("#btn-buscar").html('<i class="fa fa-search" aria-hidden="true"></i>');
              alert(response.errors[0].detail);
              
              if($("#paciente_apellidos").prop("readonly"))
                $("#paciente_apellidos").prop("readonly", false);
              if($("#fecha_nacimiento").prop("readonly"))
                $("#fecha_nacimiento").prop("readonly", false); 
              if($("#edad_actual").prop("readonly"))
                $("#edad_actual").prop("readonly", false);
              if($("#sexo").prop("readonly"))
                $("#sexo").prop("readonly", false);  
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
        //debugger;
        /*
        if (listaCIE10.length == 0) {
					return false;
				}
        if (listaMomentoEvaluacion.length == 0) {
					return false;
				}*/
        
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
          };          
            table1.row.add(datos).draw();
            listaMomentoEvaluacion.push(datos);
          $("#formRegistrar1")[0].reset();          
          $("#momentoevaluacionModal").modal("hide");          
        }

      });

      $("body").on("click", ".actionEdit", function () {
        
        var tr = $(this).parents('tr');
        var row = table.row(tr);
    
        index = row.index();
        data = row.data();
    
        //console.log(index);
        //console.log(data);
        
        //validate.resetForm();
        
        
        const 
        { 
          idfichaatencion,
          idtiposeguro,
          seguro,
          idbase,
          idambulancia,
          fecha_emision,
          fecha_ocurrencia,
          despacho_ambulancia,
          salida_base,
          llegada_foco,
          salida_foco,
          llegada_base,
          lugar_atencion,
          motivo_emergencia,
          idprioridademergencia,
          fallecido,
          idtipodocumento,
          numero_documento,
          paciente_apellidos,
          paciente_nombes,
          fecha_nacimiento,
          edad_actual,
          sexo,
          direccion_atencion,
          ubigeo,
          referencia,
          latitud,
          longitud,
          activo          
        } = data;
        
        $('#idfichaatencion').val(idfichaatencion);
        /*
        $('#idtiposeguro').val(idtiposeguro);
        $('#seguro').val(seguro);
        $('#idbase').val(idbase);
        $('#idambulancia').val(idambulancia);
        //$('#fecha_emision').val(fecha_emision); 
        $('#fecha_ocurrencia').val(fecha_ocurrencia); 
        $('#despacho_ambulancia').val(despacho_ambulancia); 
        $('#salida_base').val(salida_base); 
        $('#llegada_foco').val(llegada_foco); 
        $('#salida_foco').val(salida_foco); 
        $('#llegada_base').val(llegada_base); 
        $('#lugar_atencion').val(lugar_atencion); 
        $('#motivo_emergencia').val(motivo_emergencia);
        $('#idprioridademergencia').val(idprioridademergencia); 
        $('#fallecido').val(fallecido); 
        $('#idtipodocumento').val(idtipodocumento); 
        $('#numero_documento').val(numero_documento); 
        $('#paciente_apellidos').val(paciente_apellidos); 
        $('#paciente_nombes').val(paciente_nombes); 
        $('#fecha_nacimiento').val(fecha_nacimiento); 
        $('#edad_actual').val(edad_actual); 
        $('#sexo').val(sexo); 
        $('#direccion_atencion').val(direccion_atencion); 
        $('#referencia').val(referencia); 
        $('#activo').val(activo); 
        //$('#fecha_nacimiento').val(fecha_nacimiento); 
        */
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Principal_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            console.log("Retorno de Data");
            console.log(lista[0]);
            //debugger;
            $('#idfichaatencion').val(lista[0].idfichaatencion);
            $('#idtiposeguro').val(lista[0].idtiposeguro);
            $('#seguro').val(lista[0].seguro);
            $('#idbase').val(lista[0].idbase);
            $('#idambulancia').val(lista[0].idambulancia);
            //$('#fecha_emision').val(fecha_emision); 
            $('#fecha_ocurrencia').val(lista[0].fecha_ocurrencia); 
            $('#despacho_ambulancia').val(lista[0].despacho_ambulancia); 
            $('#salida_base').val(lista[0].salida_base); 
            $('#llegada_foco').val(lista[0].llegada_foco); 
            $('#salida_foco').val(lista[0].salida_foco); 
            $('#llegada_base').val(lista[0].llegada_base); 
            $('#lugar_atencion').val(lista[0].lugar_atencion); 
            $('#motivo_emergencia').val(lista[0].motivo_emergencia);
            $('#idprioridademergencia').val(lista[0].idprioridademergencia); 
            $('#fallecido').val(lista[0].fallecido); 
            $('#idtipodocumento').val(lista[0].idtipodocumento); 
            $('#numero_documento').val(lista[0].numero_documento); 
            $('#paciente_apellidos').val(lista[0].paciente_apellidos); 
            $('#paciente_nombes').val(lista[0].paciente_nombes); 
            $('#fecha_nacimiento').val(lista[0].fecha_nacimiento); 
            $('#edad_actual').val(lista[0].edad_actual); 
            $('#sexo').val(lista[0].sexo); 
            $('#direccion_atencion').val(lista[0].direccion_atencion); 
            $('#referencia').val(lista[0].referencia); 
            $('#activo').val(lista[0].activo); 
            $('#departamento').val((lista[0].ubigeo).substr(0,2));
            $('#provincia').val((lista[0].ubigeo).substr(2,2));
            $('#distrito').val((lista[0].ubigeo).substr(4,5)); 
                 
          }
        });

        if(sexo==1)
        {
          disableTxt();
        }
        else{
          undisableTxt();
        }        

        /*
        if (fecha_ocurrencia) {
          const [fecha, hora] = fecha_ocurrencia.split(' ')
          $('#fecha_ocurrencia').val(fecha);
          //$('#fechaEmision').attr("disabled", "disabled");
        }
        */
        
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Antecedentes_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            //console.log(lista[0]);
            
              //$('.btn-buscar').attr("disabled", "disabled");
              $('#idantedecentes').val(lista[0].idantedecentes); 
              $('#patologias_previas').val(lista[0].patologias_previas); 
              $('#fur').val(lista[0].fur); 
              $('#fpp').val(lista[0].fpp);
              $('#fug').val(lista[0].fug);
              $('#p1').val(lista[0].p1);
              $('#p2').val(lista[0].p2);
              $('#p3').val(lista[0].p3);
              $('#p4').val(lista[0].p4);
              $('#g').val(lista[0].g);
              $('#otros').val(lista[0].otros);
              $('#medicacion').val(lista[0].medicacion);
              $('#alergias').val(lista[0].alergias);
              $('#enfermedad_dias').val(lista[0].enfermedad_dias);
              $('#enfermedad_horas').val(lista[0].enfermedad_horas);
              $('#enfermedad_minutos').val(lista[0].enfermedad_minutos);
              $('#enfermedad_inicio').val(lista[0].enfermedad_inicio);
              $('#enfermedad_curso').val(lista[0].enfermedad_curso);
              $('#relato_evento').val(lista[0].relato_evento);
                 
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Examen_Fisico_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            //console.log(lista[0]);

              $('#idexamen').val(lista[0].idexamen); 
              $('#examen_cabeza').val(lista[0].examen_cabeza); 
              $('#examen_cuello').val(lista[0].examen_cuello); 
              $('#examen_piel_tcsc').val(lista[0].examen_piel_tcsc);
              $('#examen_aparato_respiratorio').val(lista[0].examen_aparato_respiratorio);
              $('#examen_aparato_cardiovascular').val(lista[0].examen_aparato_cardiovascular);
              $('#examen_aparato_digestivo').val(lista[0].examen_aparato_digestivo);
              $('#examen_genito_urinario').val(lista[0].examen_genito_urinario);
              $('#examen_sistema_osteomioaticular').val(lista[0].examen_sistema_osteomioaticular);
              $('#examen_neurologico').val(lista[0].examen_neurologico);
            
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Momento_Evaluacion_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            table1.clear();
            table1.rows.add(lista).draw();
           // console.log(lista[0]);
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Mecanismo_Lesion_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            //console.log(lista[0]);

              $('#idmecanismo').val(lista[0].idmecanismo); 
              $('#tipo_victima').val(lista[0].tipo_victima); 
              $('#tipo_vehiculo').val(lista[0].tipo_vehiculo); 
              $('#tipo_vehiculo_descripcion').val(lista[0].tipo_vehiculo_descripcion);
              $("#bolsa").prop("checked", lista[0].bolsa === '1' ? true : false);
              $("#cinturon").prop("checked", lista[0].cinturon === '1' ? true : false);
              $("#casco").prop("checked", lista[0].casco === '1' ? true : false);
              $("#ropa").prop("checked", lista[0].ropa === '1' ? true : false);
              $('#cinamatica').val(lista[0].cinamatica);
              $('#ubicacion').val(lista[0].ubicacion);            
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_CIE10_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            table2.clear();
            table2.rows.add(lista).draw();
            //console.log(lista[0]);
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Procedimientos_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            //console.log(lista[0]);

              $('#idprocedimiento').val(lista[0].idprocedimiento); 
              $('#oxigenoterapia').val(lista[0].oxigenoterapia); 
              $('#fluidoterapia').val(lista[0].fluidoterapia);
              $('#rcp').val(lista[0].rcp); 
              $('#uso_dea').val(lista[0].uso_dea); 
              $('#inmovilizacion_parcial').val(lista[0].inmovilizacion_parcial); 
              $('#sondaje').val(lista[0].sondaje); 
              $('#ocurrencias_atencion').val(lista[0].ocurrencias_atencion); 

              $("#cardioversion").prop("checked", lista[0].cardioversion === '1' ? true : false);
              $("#cardioversion_selectiva").prop("checked", lista[0].cardioversion_selectiva === '1' ? true : false);
              $("#monitoreo_cardiaco").prop("checked", lista[0].monitoreo_cardiaco === '1' ? true : false);
              $("#ventilacion_mecanica").prop("checked", lista[0].ventilacion_mecanica === '1' ? true : false);        
              $("#ippb").prop("checked", lista[0].ippb === '1' ? true : false);        
              $("#tratamiento_inhalacion").prop("checked", lista[0].tratamiento_inhalacion === '1' ? true : false);
              $("#inmovilizacion_completa").prop("checked", lista[0].inmovilizacion_completa === '1' ? true : false);
              $("#vendaje").prop("checked", lista[0].vendaje === '1' ? true : false);
              $("#sedacion").prop("checked", lista[0].sedacion === '1' ? true : false);        
              $("#intubacion").prop("checked", lista[0].intubacion === '1' ? true : false);        
              $("#traqueostomia").prop("checked", lista[0].traqueostomia === '1' ? true : false);
              $("#curacion").prop("checked", lista[0].curacion === '1' ? true : false);
              $("#satura").prop("checked", lista[0].satura === '1' ? true : false);
              $("#cuerpo_extrano").prop("checked", lista[0].cuerpo_extrano === '1' ? true : false);        
              $("#hemostacia").prop("checked", lista[0].hemostacia === '1' ? true : false);        
              $("#taponamiento_nasal").prop("checked", lista[0].taponamiento_nasal === '1' ? true : false);
              $("#infusion_intraosea").prop("checked", lista[0].infusion_intraosea === '1' ? true : false);
              $("#aspiracion_secreciones").prop("checked", lista[0].aspiracion_secreciones === '1' ? true : false);
              $("#hemoglucotest").prop("checked", lista[0].hemoglucotest === '1' ? true : false);        
              $("#nebulizacion").prop("checked", lista[0].nebulizacion === '1' ? true : false);        

          }
        });   
        
        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Medicacion_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            tbListarmedicamentos.clear();
            tbListarmedicamentos.rows.add(lista).draw();
            //console.log(lista[0]);
          }
        });

        $.ajax({
          type: 'POST',
          url: URI + 'fichaatencion/main/obtener_Tripulacion_Ficha',
          data: { idfichaatencion: idfichaatencion },
          dataType: 'json',
          success: function (response) {
            const { data: { lista } } = response;
            //console.log(lista[0]);

            $('#idtripulacion').val(lista[0].idtripulacion);
            $('#idtipodocumento_medico').val(lista[0].idtipodocumento_medico);
            $('#numero_documento_medico').val(lista[0].numero_documento_medico);
            $('#nombre_completo_medico').val(lista[0].nombre_completo_medico);
            $('#numero_colegiatura_medico').val(lista[0].numero_colegiatura_medico);
            $('#idtipodocumento_enfermero').val(lista[0].idtipodocumento_enfermero);
            $('#numero_documento_enfermero').val(lista[0].numero_documento_enfermero);
            $('#nombre_completo_enfermero').val(lista[0].nombre_completo_enfermero);
            $('#numero_colegiatura_enfermero').val(lista[0].numero_colegiatura_enfermero);
            $('#idtipodocumento_piloto').val(lista[0].idtipodocumento_piloto);
            $('#numero_documento_piloto').val(lista[0].numero_documento_piloto);
            $('#nombre_completo_piloto').val(lista[0].nombre_completo_piloto);
            $('#numero_licencia_piloto').val(lista[0].numero_licencia_piloto);
            $('#idtipodocumento_medico_regulador').val(lista[0].idtipodocumento_medico_regulador);
            $('#numero_documento_medico_regulador').val(lista[0].numero_documento_medico_regulador);
            $('#nombre_completo_medico_regulador').val(lista[0].nombre_completo_medico_regulador);
            $('#numero_colegiatura_medico_regulador').val(lista[0].numero_colegiatura_medico_regulador);
            $('#ficha_regulacion').val(lista[0].ficha_regulacion);
            $('#idtipodocumento_profesional_receptor').val(lista[0].idtipodocumento_profesional_receptor);
            $('#numero_documento_profesional_receptor').val(lista[0].numero_documento_profesional_receptor);
            $('#nombre_completo_profesional_receptor').val(lista[0].nombre_completo_profesional_receptor);
            $('#idtipodocumento_medico_receptor').val(lista[0].idtipodocumento_medico_receptor);
            $('#numero_documento_medico_receptor').val(lista[0].numero_documento_medico_receptor);
            $('#nombre_completo_medico_receptor').val(lista[0].nombre_completo_medico_receptor);
            $('#numero_colegiatura_medico_receptor').val(lista[0].numero_colegiatura_medico_receptor);
            $('#idrenipress').val(lista[0].idrenipress);
            $('#hora_llegada_es').val(lista[0].hora_llegada_es);
            $('#hora_recepcion_paciente').val(lista[0].hora_recepcion_paciente);
            $('#hora_salida_es').val(lista[0].hora_salida_es);
            $('#camilla_retenida').val(lista[0].camilla_retenida);
            $('#camilla_retenida_minutos').val(lista[0].camilla_retenida_minutos);
            
            
          }
        });   

        const inp = this.previousSibling;
        console.log(inp.value);
        //buscar(inp.value);
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
                if(!$("#nombre_completo_medico").prop("readonly"))
                  $("#nombre_completo_medico").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmed").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_medico").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmed").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_medico").prop("readonly"))
                  $("#nombre_completo_medico").prop("readonly", false);
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
                if(!$("#nombre_completo_enfermero").prop("readonly"))
                  $("#nombre_completo_enfermero").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarenf").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_enfermero").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarenf").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_enfermero").prop("readonly"))
                  $("#nombre_completo_enfermero").prop("readonly", false);
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
                if(!$("#nombre_completo_piloto").prop("readonly"))
                  $("#nombre_completo_piloto").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarpil").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_piloto").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarpil").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_piloto").prop("readonly"))
                  $("#nombre_completo_piloto").prop("readonly", false);
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
                if(!$("#nombre_completo_medico_regulador").prop("readonly"))
                  $("#nombre_completo_medico_regulador").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmedreg").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_medico_regulador").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmedreg").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_medico_regulador").prop("readonly"))
                  $("#nombre_completo_medico_regulador").prop("readonly", false);
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
                if(!$("#nombre_completo_profesional_receptor").prop("readonly"))
                  $("#nombre_completo_profesional_receptor").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarprofr").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_profesional_receptor").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarprofr").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_profesional_receptor").prop("readonly"))
                  $("#nombre_completo_profesional_receptor").prop("readonly", false);
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
                if(!$("#nombre_completo_medico_receptor").prop("readonly"))
                  $("#nombre_completo_medico_receptor").prop("readonly", true);
                const { data } = response;
                const datos = data.attributes;
                $("#btn-buscarmedrec").html('<i class="fa fa-search" aria-hidden="true"></i>');
                $("#nombre_completo_medico_receptor").val(datos.nombres+ " " +datos.apellido_paterno+ " " +datos.apellido_materno) ;
                $("#datos").show();
              }else{
                $("#btn-buscarmedrec").html('<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Buscar');
                alert(response.errors[0].detail);
                if($("#nombre_completo_medico_receptor").prop("readonly"))
                  $("#nombre_completo_medico_receptor").prop("readonly", false);
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