var data;
$(document).ready(function () {
  var table = $('#dt-usuarios').DataTable({
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
      { data: "dni" },
      { data: "apellidos" },
      { data: "nombres" },
      { data: "usuario" },
      { data: "perfil" },
      { data: "region" },
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
        title: 'Lista General de Usuarios',
        exportOptions: { columns: [0, 1, 2, 3, 6] },
      },
      {
        extend: 'csv',
        title: 'Lista General de Usuarios',
        exportOptions: { columns: [0, 1, 2, 3, 6] },
      },
      {
        extend: 'excel',
        title: 'Lista General de Usuarios',
        exportOptions: { columns: [0, 1, 2, 3, 6] },
      },
      {
        extend: 'pdf',
        title: 'Lista General de Usuarios',
        orientation: 'landscape',
        exportOptions: { columns: [0, 1, 2, 3, 6] },
      },
      {
        extend: 'print',
        title: 'Lista General de Usuarios',
        exportOptions: { columns: [0, 1, 2, 3, 6] },
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
/*
  $("#file").change(function (event) {
    readURL(this);
  });

  $("#file").on('click', function (event) {
    RecurFadeIn();
  });

  $("#datetimepicker").datetimepicker({
    format: "DD/MM/YYYY",
    maxDate: moment()
  }); $('#siga').keyup(function (e) {
    if ((e.keyCode > 47 && e.keyCode < 58) || (e.keyCode < 106 && e.keyCode > 95) || e.keyCode === 8) {
      if (e.keyCode === 8) return true
      if (this.value.length > 14) return false;
      if (this.value.length > 5) {
        this.value = this.value.replace(/(\d{4})\.?/g, '$1.');
      } else {
        this.value = this.value.replace(/(\d{2})\.?/g, '$1.');
      }
      return true;
    } this.value = this.value.replace(/[^\-0-9]/g, '');
  });

  $("#btnBuscarTitular").on('click', function (event) {
    var documentNumber = $('#numeroDniTitular').val();
    searchPerson(documentNumber, '#nombreTitular');
  });

  $("#btnBuscarSuplente").on('click', function (event) {
    var documentNumber = $('#numeroDniSuplente').val();
    searchPerson(documentNumber, '#nombreSuplente');
  });

  $(".btn-nuevo").on('click', function (event) {
    $('#imagen').attr('src', 'data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=');
    $('.custom-file').html(`Escoger Ficha &hellip;`);
    data = {};
    $("#formRegistrar")[0].reset();
    showModal(event, 'Registrar Nuevo Artículo');
  });

  $("body").on("click", ".actionEdit", function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { idarticulo, descripcion, idmarca, modelo, dimensiones, peso,
      idcolor, idclasificacion, idunidadmedida, imagen, estado, codigo_siga } = data;
    $('#idarticulo').val(idarticulo);
    $('#nombre').val(descripcion);
    $('#siga').val(codigo_siga);
    $('#marca').val(idmarca);
    $('#modelo').val(modelo);
    $('#dimensiones').val(dimensiones);
    $('#peso').val(peso);
    $('#color').val(idcolor);
    $('#clasificacion').val(idclasificacion);
    $('#medida').val(idunidadmedida);
    $('#imagen').attr('src', URI + 'public/inventarios/fotos/' + imagen);
    $("#estado").prop("checked", estado === '1' ? true : false);
    $('.btn-buscar').attr("disabled", "disabled");
    showModal(event, 'Editar Artículo');
  });

  $("#formRegistrar").validate({
    rules: {
      siga: { required: true },
      nombre: { required: true },
      marca: { required: true },
      medida: { required: true },
      clasificacion: { required: true }
    },
    messages: {
      siga: { required: "Campo requerido" },
      nombre: { required: "Campo requerido" },
      marca: { required: "Campo requerido" },
      medida: { required: "Campo requerido" },
      clasificacion: { required: "Campo requerido" }
    },
    submitHandler: function (form, event) {
      var formData = new FormData(document.getElementById("formRegistrar"));
      formData.append("file", document.getElementById("file"));
      formData.append("ficha", document.getElementById("ficha"));

      $.ajax({
        type: 'POST',
        url: URI + 'inventario/articulos/guardarArticulo',
        data: formData,
        method: "POST",
        dataType: "json",
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

  $('body').on('click', 'td button.actionImage', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { imagen } = data;
    const imageUrl = `${URI}public/inventarios/fotos/${imagen}`
    $('#imagepreview').attr('src', imageUrl);
    $('#imagemodal').modal('show');
  });

  $('body').on('click', 'td button.actionPdf', function () {
    var tr = $(this).parents('tr');
    var row = table.row(tr);

    index = row.index();
    data = row.data();
    const { ficha } = data;
    const ruta = `${URI}public/inventarios/fichas/${ficha}`;
    if (ruta)
      window.open(ruta);
  });

  $('body').on('click', '#dt-select tr', function () {
    var tr = $(this);
    var row = table.row(tr);
    index = row.index();
    data = row.data();
    if (data) {
      $('.btn-editar').removeClass('active');
      $('.btn-editar').addClass('active');

      if ($(this).hasClass('selected')) {
        $('.btn-editar').removeClass('active');
        $(this).removeClass('selected');
      } else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
      }
    }
  });
*/
});
/*
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

function FadeInAlert(text) {
  $(".alert").show();
  $(".alert").text(text).addClass("loading");
}

function RecurFadeIn() {

}

function loadData(table) {
  $.ajax({
    type: 'POST',
    url: URI + 'inventario/articulos/obtenerLista',
    data: {},
    dataType: 'json',
    success: function (response) {
      const { data: { listaArticulos } } = response;
      table.clear();
      table.rows.add(listaArticulos).draw();
    }
  });
}

function searchPerson(documentNumber, inputName) {
  $.ajax({
    url: URI + "brigadistas/curl",
    data: {
      type: '01',
      document: documentNumber
    },
    method: 'post',
    dataType: 'json',
    beforeSend: function () {
    },
    success: function (data) {
      const { data: { attributes: { nombres, apellido_paterno, apellido_materno } } } = data;
      $(inputName).val(nombres + ' ' + apellido_paterno + ' ' + apellido_materno);
    }
  });
}

function showModal(event, title) {
  $("#editarModal").modal("show");
  $("#editarModalLabel").text(title);
  event.stopPropagation();
  event.stopImmediatePropagation();
}

function toQueryString(params) {
  const query = Object.keys(params).map(key => key + '=' + params[key]).join('&');
  return query;
};*/