var data;
var validate = 1;
$(document).ready(function () {
  var table = $('#dt-bases').DataTable({
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
      { data: "nombre" },
      { data: "domicilio" },
      { data: "ubigeo" },
      { data: "fecha" },
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
        title: 'Lista General de Bases',
        exportOptions: { columns: [1, 2, 3, 4, 5] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Bases',
        exportOptions: { columns: [1, 2, 3, 4, 5] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Bases',
        exportOptions: { columns: [1, 2, 3, 4, 5] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Bases',
        orientation: 'landscape',
        exportOptions: { columns: [1, 2, 3, 4, 5] },
      },
      {
        extend: 'print',
        title: 'Lista General de Bases',
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
    //$('#imagen').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=');
    //$('.custom-file').html(`Escoger Ficha &hellip;`);
    data = {};
    $("#formRegistrar")[0].reset();
    showModal(event, 'Registrar Nueva Base');
  });

  function showModal(event, title) {
    $("#editarModal").modal("show");
    $("#editarModalLabel").text(title);
    event.stopPropagation();
    event.stopImmediatePropagation();
  }
/*
  $("#formRegistrar").validate({
    rules: {
      anio: { required: true },
      fechaEmision: { required: true },
      tipoIngreso: { required: true },
      almacen: { required: true },
    },
    messages: {
      anio: { required: "Campo requerido" },
      fechaEmision: { required: "Campo requerido" },
      tipoIngreso: { required: "Campo requerido" },
      almacen: { required: "Campo requerido" }
    },
    submitHandler: function (form, event) {
      var formData = new FormData(document.getElementById("formRegistrar"));
      formData.append("ficha", document.getElementById("ficha"));
      const data = tableArticuloIngresos.rows().data().toArray();
      if (data.length === 0) {
        showAlertForm(`No hay Artículos, <a class="alert-link">seleccione al menos un artículo.</a>`);
        return;
      }
      formData.append("articulos", data.map((item) => item.idarticuloregistro).join('|'));
      $.ajax({
        type: 'POST',
        url: URI + 'inventario/ingresos/guardar',
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
  });*/
  
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

            $html += '<option value="' + e.Codigo_Provincia + '">' + e.Nombre + '</option>';

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

            $html += '<option value="' + e.Codigo_Distrito + '">' + e.Nombre + '</option>';

          });
          $("#distrito").html($html);

        }
      });

    }
  });

});
