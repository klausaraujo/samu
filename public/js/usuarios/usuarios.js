function usuarios(URI) {
  
  function showModal(event,title) {
    $("#editarModal").modal("show");
    $("#editarModalLabel").text(title);
    event.stopPropagation();
    event.stopImmediatePropagation();
  }

  function buscar(valor) {
    var dni = valor;
    var i = 0;
    var opt = '<option value="" class="lista">---Seleccione---</option>';

    if($("#userStatus").attr("class") != "")
        $("#userStatus").removeClass($("#userStatus").attr("class"));
            
    $("#formRegistrar")[0].reset();
    $("#labelStatus").show();
    $('#dni').attr('disabled', 'disabled');
    $("#dni").val(dni);
    $("#etiq").hide();
    $("#etiq1").hide();
    $("#etiq2").hide();
    $("#buscar").hide();
    $("#act").val(1);
    $("#enviar").text("Actualizar");
    $("select").prop('selectedIndex',0);
    //Recorrer todos los td de la tabla
    /*$('#dt-usuarios').each(function(){
      $(this).find('td').each(function(){
        console.log($(this).text());
        console.log($(this).rowIndex());
      });
    });*/
    
    $.ajax({
      type: 'POST',
      url: URI + 'usuarios/main/extraeUsuario',
      data: {dni:dni},
      dataType: 'json',
      success: function (response) {
        if (response.status === 200) {
          const { regiones } = response;
          const { perfiles } = response;
          const { data } = response;
          var i = 0;
          var reg, idreg;
          if(data[0].activo == 1){
            $("#userStatus").addClass("alert-success");
            $("#userStatus").text("Activo");
          }else if(data[0].activo == 0){
            $("#userStatus").addClass("alert-warning");
            $("#userStatus").text("Inactivo");
          }
          $("#iduser").val(data[0].idusuario);
          $("#nombres").val(data[0].nombres);
          $("#apellidos").val(data[0].apellidos);
          html = opt;
          for(i in regiones) {
            if(regiones[i].idregion == data[0].idregion){
              reg = regiones[i].region;
              idreg = regiones[i].idregion;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + regiones[i].idregion + '">' + regiones[i].region + '</option>';
          }
          $("#region").html(html);
          i = 0;
          html = opt;
          for(i in perfiles) {
            if(perfiles[i].idperfil == data[0].idperfil){
              reg = perfiles[i].perfil;
              idreg = perfiles[i].idperfil;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + perfiles[i].idperfil + '">' + perfiles[i].perfil + '</option>';
          }
          $("#perfil").html(html);

        } else {
          alert("No existe el usuario");
        }
      }
    });
  }
  
  
  $(document).ready(function () {
    var data;
    
    var table = $('#dt-usuarios').DataTable({
      data: lista,
      pageLength: 10,
      dom: 'Bfrt<"col-sm-12 inline"i> <"col-sm-12 inline"p>',
      
      autoWidth: true,
      lengthMenu: [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, 'Todas']],
      columns: [
        {
          data: null,

            render: function (data, type, row, meta) {
            const btnEdit = /*data.activo == 1 ? */`
            <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;"">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` /*: `
            <button class="btn btn-warning btn-circle disabled" title="Editar Registro" type="button" style="margin-right: 5px;">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>` */;

            const btnDelete = /*data.activo == 1 ? `<button class="btn btn-danger btn-circle actionDeleteComi" title="Anular Registro" type="button style="margin-right: 5px;">
              <i class="fa fa-times" aria-hidden="true"></i>
            </button>` : */`<button class="btn btn-danger btn-circle disabled" title="Anular Registro" type="button style="margin-right: 5px;">
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

    $(".actionEdit").on('click', function (event) {
      var valor ="", i = 0;
      $(this).parents("tr").find("td").each(function(){
        if(i == 1)
          valor = $(this).html();
        i++;
      });

      buscar(valor);
      showModal(event, 'Editar Usuario');
    });

    $(".btn-nuevo").on('click', function (event) {
      $("#formRegistrar")[0].reset();
      $("#labelStatus").hide();
      $('#dni').prop('disabled', false);
      $("#etiq").show();
      $("#etiq1").show();
      $("#etiq2").show();
      $("#buscar").show();
      $("#act").val(0);
      $("#enviar").text("Guardar");
      $("select").prop('selectedIndex',0);
      showModal(event, 'Registrar Nuevo Usuario');
    });
  
  
    $("#formRegistrar").validate({      
      rules: {
        dni: { required: true, minlength: 8, maxlength: 8 },
        nombres: { required: true },
        apellidos: { required: true },
        region: { required: true },
        perfil: { required: true },
        estatus: { required: true },
        user: { required: true },
        pass: { required: true },
      },
      messages: {
        dni: { required: "Campo requerido" },
        nombres: { required: "Campo requerido" },
        apellidos: { required: "Campo requerido" },
        region: { required: "Campo requerido" },
        perfil: { required: "Campo requerido" },
        estatus: { required: "Campo requerido" },
        user: { required: "Campo requerido" },
        pass: { required: "Campo requerido" },
      },
      submitHandler: function (form, event) {
        var formData = new FormData(document.getElementById("formRegistrar"));
       
        $.ajax({
          type: 'POST',
          url: URI + 'usuarios/main/guardarUsuario',
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
              loadData(table);
              $('.alert-success').fadeIn(1000);
            } else {
              $('.alert-danger').fadeIn(1000);
            }
            /*setTimeout(() => {
              $('.alert').fadeOut(1000);
            }, 1500);*/
          }
        });
      }
    });

  });

  function loadData(table) {
    $.ajax({
      type: 'POST',
      url: URI + 'usuarios/main/listausuarios',
      data: {},
      dataType: 'json',
      success: function (response) {
        const { data: { listaUsuarios } } = response;
        table.clear();
        table.rows.add(listaUsuarios).draw();
        
        $(".actionEdit").on('click', function (event) {
          var valor ="", i = 0;
          $(this).parents("tr").find("td").each(function(){
            if(i == 1)
              valor = $(this).html();
            i++;
          });
    
          buscar(valor);
          showModal(event, 'Editar Usuario');
        });
      }
    });
  }
}