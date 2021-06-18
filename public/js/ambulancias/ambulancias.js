function ambulancias(URI, EVENTO_CODIGO_REGION) {

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
            const btnEdit = data.activo == 1 ? `
            <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` : `
            <button class="btn btn-warning btn-circle disabled" title="Editar Registro" type="button" style="margin-right: 5px;">
               <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` ;
            const btnDelete = data.activo == 1 ? `<button class="btn btn-danger btn-circle actionDeleteComi" title="Anular Registro" type="button style="margin-right: 5px;">
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
        {
          data: "activo",
          "render": function (data, type, row, meta) {
            return (data == '1' ? 'Activo' : 'Inactivo');
          }
        }
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
      showModal(event, 'Registrar Nueva Ambulancia');
    });
  
    function showModal(event, title) {
      $("#editarModal").modal("show");
      $("#editarModalLabel").text(title);
      event.stopPropagation();
      event.stopImmediatePropagation();
    }
  
    $("#formRegistrar").validate({
      rules: {
        nombre: { required: true },
        direccion: { required: true },
        departamento: { required: true },
        provincia: { required: true },
        distrito: { required: true },
        fechainicio: { required: true },
      },
      messages: {
        nombre: { required: "Campo requerido" },
        direccion: { required: "Campo requerido" },
        departamento: { required: "Campo requerido" },
        provincia: { required: "Campo requerido" },
        distrito: { required: "Campo requerido" },
        fechainicio: { required: "Campo requerido" }
      },
      submitHandler: function (form, event) {
        var formData = new FormData(document.getElementById("formRegistrar"));
        $.ajax({
          type: 'POST',
          url: URI + 'bases/main/guardarBase',
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
  
    var ejecutarDepa = EVENTO_CODIGO_REGION;
  
    if (ejecutarDepa.length > 0) {
  
      $.ajax({
        data: { departamento: ejecutarDepa },
        url: URI + "bases/main/cargarProvincias",
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
  
    $("#departamento").change(function () {
  
      var id = $(this).val();
  
      if (id.length > 0) {
  
        $.ajax({
          data: { departamento: id },
          url: URI + "bases/main/cargarProvincias",
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
          url: URI + "bases/main/cargarDistritos",
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
      }
    });
  }
  
  }
  
  
  