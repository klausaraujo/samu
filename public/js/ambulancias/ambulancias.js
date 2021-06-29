function ambulancias(URI) {

  function showModal(event, title) {
    $("#editarModal").modal("show");
    $("#editarModalLabel").text(title);
    event.stopPropagation();
    event.stopImmediatePropagation();
  }

  function buscar () {
    var placa = $("#placa").val();
    var opt = '<option value="" class="lista">---Seleccione---</option>';
    var html = "";

    $.ajax({
      type: 'POST',
      url: URI + 'ambulancias/main/extraerAmbulancia',
      data: {placa:placa},
      dataType: 'json',
      success: function (response) {
        const { data } = response;
        const { tipo } = response;
        const { marca } = response;
        const { comb } = response;
        //console.log(response);
        if (response.status === 200) {
          var i=0;
          $("#idambulancia").val(data[0].idambulancia);
          $("#modelo").val(data[0].modelo);
          $("#serie_motor").val(data[0].serie_motor);
          $("#codigo_patrimonial").val(data[0].codigo_patrimonial);
          $("#fabricacion_anio").val(data[0].fabricacion_anio);
          $("#modelo_anio").val(data[0].modelo_anio);
          html = '<option value="" class="lista">---Seleccione---</option>';
          if(data[0].gps == "NO")
            html = opt + '<option value="1">SI</option><option value="0" selected>NO</option>';
          else if(data[0].gps == "SI")
            html = opt + '<option value="1" selected>SI</option><option value="0">NO</option>';
          $("#gps").html(html);
          html = opt;
          if(data[0].condicion == "Inoperativa")
            html += '<option value="1">Operativa</option><option value="0" selected>Inoperativa</option>';
          else if(data[0].condicion == "Operativa")
            html += '<option value="1" selected>Operativa</option><option value="0">Inoperativa</option>';
          $("#condicion").html(html);
          html = opt;
          for(i in marca) {
            if(marca[i].idmarca == data[0].idmarca){
              reg = marca[i].marca;
              idreg = marca[i].idmarca;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + marca[i].idmarca + '">' + marca[i].marca + '</option>';
          }
          $("#idmarca").html(html);
          html = opt;
          i=0;
          for(i in comb) {
            if(comb[i].idtipocombustible == data[0].idtipocombustible){
              reg = comb[i].combustible;
              idreg = comb[i].idtipocombustible;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + comb[i].idtipocombustible + '">' + comb[i].combustible + '</option>';
          }
          $("#idtipocombustible").html(html);
          html = opt;
          i=0;
          for(i in tipo) {
            if(tipo[i].idtipoambulancia == data[0].idtipoambulancia){
              reg = tipo[i].tipo;
              idreg = tipo[i].idtipoambulancia;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + tipo[i].idtipoambulancia + '">' + tipo[i].tipo + '</option>';
          }
          $("#idtipoambulancia").html(html);

        } else {
          alert("No existe el registro");
        }
      }
    });
  }
  
  $(document).ready(function () {
    var data;
    var validate = 1;
    var table = $('#dt-ambulancias').DataTable({
      data: lista,
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
            const btnEdit = data.estado == "Activo" ? `
            <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` : `
            <button class="btn btn-warning btn-circle disabled" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` ;
            const btnDelete = data.estado == "Activo" ? `<button class="btn btn-danger btn-circle actionDeleteComi" title="Anular Registro" type="button style="margin-right: 5px;">
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
        { data: "placa" },
        { data: "marca" },
        { data: "modelo" },
        { data: "gps" },
        { data: "tipo" },
        { data: "condicion" },
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
        buttons: [{
          extend: 'copy',
          title: 'Lista General de Ambulancias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'csv',
          title: 'Lista General de Ambulancias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'excel',
          title: 'Lista General de Ambulancias',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'pdf',
          title: 'Lista General de Ambulancias',
          orientation: 'landscape',
          exportOptions: { columns: [1, 2, 3, 4, 5] },
        },
        {
          extend: 'print',
          title: 'Lista General de Ambulancias',
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
      $('#imagen').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=');
      $('.custom-file').html(`Escoger Ficha &hellip;`);
      data = {};
      $("#formRegistrar")[0].reset();
      $("#act").val(0);
      $("#enviar").text("Guardar");
      $("select").prop('selectedIndex',0);
      showModal(event, 'Registrar Nueva Ambulancia');
    });

    $(".actionEdit").on('click', function (event) {
      var valor ="", i = 0;
      $(this).parents("tr").find("td").each(function(){
        if(i == 1)
          valor = $(this).html();
        i++;
      });
      $("#formRegistrar")[0].reset();
      $("#placa").val(valor);
      $("#act").val(1);
      $("#enviar").text("Actualizar");
      $("select").prop('selectedIndex',0);
      buscar();
      showModal(event, 'Editar Ambulancia');
    });

    $("#formRegistrar").validate({
      rules: {
        placa: { required: true },
        idmarca: { required: true },
        modelo: { required: true },
        idtipocombustible: { required: true },
        gps: { required: true },
        idtipoambulancia: { required: true },
        serie_motor: { required: true },
        codigo_patrimonial: { required: true },
        fabricacion_anio: { required: true },
        modelo_anio: { required: true },
        condicion: { required: true }
      },
      messages: {
        placa: { required: "Campo Requerido" },
        idmarca: { required: "Campo Requerido" },
        modelo: { required: "Campo Requerido" },
        idtipocombustible: { required: "Campo Requerido" },
        gps: { required: "Campo Requerido" },
        idtipoambulancia: { required: "Campo Requerido" },
        serie_motor: { required: "Campo Requerido" },
        codigo_patrimonial: { required: "Campo Requerido" },
        fabricacion_anio: { required: "Campo Requerido" },
        modelo_anio: { required: "Campo Requerido" },
        condicion: { required: "Campo Requerido" }
      },
      submitHandler: function (form, event) {
        var formData = new FormData(document.getElementById("formRegistrar"));
        $.ajax({
          type: 'POST',
          url: URI + 'ambulancias/main/guardarAmbulancia',
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
  
    $("#file").change(function (event) {
      readURL(this);
    });
  
    $("#ficha").change(function (event) {
      readURL(this, false);
    });
  
  
  });
  
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $("#file").val();
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
        $('#blah').hide();
        $('#blah').fadeIn(500);
        $('.custom-file-label').text(filename);
      }
      reader.readAsDataURL(input.files[0]);
    }
    $(".alert").removeClass("loading").hide();
  }
  
  function readURL(input, isImage = true) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      var filename = $(input).val();
      filename = filename.substring(filename.lastIndexOf('\\') + 1);
      reader.onload = function (e) {
        if (isImage) $('#imagen').attr('src', e.target.result);
        $(`${isImage ? '.custom-file-img' : '.custom-file'}`).text(filename);
      }
      reader.readAsDataURL(input.files[0]);
    }
    $(".alert").removeClass("loading").hide();
  }
  
  function loadData(table) {
    $.ajax({
      type: 'POST',
      url: URI + 'ambulancias/main/listaAmbulancias',
      data: {},
      dataType: 'json',
      success: function (response) {
        const { data: { listaAmbulancias } } = response;
        table.clear();
        table.rows.add(listaAmbulancias).draw();
        $(".actionEdit").on('click', function (event) {
          var valor ="", i = 0;
          $(this).parents("tr").find("td").each(function(){
            if(i == 1)
              valor = $(this).html();
            i++;
          });
          $("#formRegistrar")[0].reset();
          $("#placa").val(valor);
          $("#act").val(1);
          $("#enviar").text("Actualizar");
          $("select").prop('selectedIndex',0);
          buscar();
          showModal(event, 'Editar Ambulancia');
        });
      }
    });
  }
  
  }
  
  
  