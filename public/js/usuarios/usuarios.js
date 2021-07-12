function usuarios(URI) {
  var vacia = false;
  var clon;
  var i = 0;
  var grid = "<div class='col-sm-4 offset-sm-4'><div id='insert_reg'"+
  "class='panel panel-primary'>	<div class='panel-heading text-center row'>"+
	"<div class='col-sm-12'>Regiones Asignadas</div></div></div></div>";
  var resetSelect = "";

  $("#region option").each(function(){
    if ($(this).val() != "" ){        
      resetSelect += "<option value='"+$(this).val()+"'>"+$(this).text()+"</option>\n";
    }
  });

  function clonar(){
    clon = $("#selectRegion").clone(true,true);
  }

  function addRegion(){

    $("#agregar").on('click', function(event){
      var div = "<div class='row black'>";
      var fila = "";
      $('#region option:selected').each(function() {
        fila += div + "<div class='col-sm-9 border border-info'>"+$(this).text()+
        "<input name='grupoReg[]' type='hidden' value='"+$(this).val()+"' /><input type='hidden' value="+
        $(this).index()+" /></div><div class='col-sm-3 border border-info text-center'><a href='#' class='"+
        "link-dark'><i class='fa fa-trash fa-lg' aria-hidden='true' title='Borrar'></i></a></div></div>";
        i++;
      });
      $("#insert_reg").append(fila);
      $("#asignar").val(i);

     // alert($(".black").prev().prop('tagName'));

      $(".link-dark").on('click', function(event){
        
        var divPadre = this.parentNode;
        var divHerm = divPadre.previousSibling;
        var txt = $(divHerm).text();
        var index = divHerm.lastChild;
        var value = index.previousSibling;
        if($("#region option").length == 0) vacia = true;

        if(vacia)
          $("#region").append("<option value='"+value.value+"'>"+txt+"</option>");
        else
          $('#region option').eq(index.value).before($("<option></option>").val(value.value).html(txt));
        
        if(i == 1) i = "";
        if(i > 1) i--;
        
        $(divHerm).remove();
        $(divPadre).remove();
        $("#asignar").val(i);       
          
      });

      $('#region option:selected').remove();
      
      //alert($("#insert_reg div:last-child").text());
    });
  }

  function showModal(event,title) {
    $("#editarModal").modal("show");
    $("#editarModalLabel").text(title);
    event.stopPropagation();
    event.stopImmediatePropagation();
  }

  function buscar(valor) {
    var dni = valor;
    var opt = '<option value="" class="lista">---Seleccione---</option>';
    i = 0;

    if($("#userStatus").attr("class") != "")
        $("#userStatus").removeClass($("#userStatus").attr("class"));
    
    
    $("#padreRegion").empty();
    $("#padreRegion").html(clon);
    $("#region").empty();
    $("#region").html(resetSelect);
    $("#grilla").html(grid);
            
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
          const { data } = response;
          const { regiones } = response;
          const { perfiles } = response;
          const { regiones_user } = response;
          //console.log(regiones_user);
          var k = 0; j = 0;
          var reg, idreg;
          var html = "";
          var datagrid1 = "";
          var div = "<div class='row black'>";
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

          for(k in regiones) {
            reg = regiones[k].region;
            idreg = regiones[k].idregion;
            for(j in regiones_user){
              if(idreg == regiones_user[j].idregion){
                var indice = ""; txt = ""; valor = "";
                $("#region option").each(function(){
                  if ($(this).val() == idreg ){
                    valor = $(this).val();
                    txt = $(this).text();
                    indice = $(this).index();
                    $(this).remove();
                    //console.log(valor+" "+txt+" "+indice);
                  }
                });
                datagrid1 = div + "<div class='col-sm-9 border border-info' id='div"+i+"'>"+reg+
                "<input id='input"+i+"' name='grupoReg[]' type='hidden' value='"+idreg+"' /><input type='hidden' value="+
                indice+" /></div><div class='col-sm-3 border border-info text-center'><a href='#' class='"+
                "link-dark'><i class='fa fa-trash fa-lg' aria-hidden='true' title='Borrar'></i></a></div></div>";
                
                $("#insert_reg").append(datagrid1);
                $(".link-dark").on('click', function(event){
        
                  var divPadre = this.parentNode;
                  var divHerm = divPadre.previousSibling;
                  var txt = $(divHerm).text();
                  var index = divHerm.lastChild;
                  var value = index.previousSibling;
                  if($("#region option").length == 0) vacia = true;
          
                  if(vacia)
                    $("#region").append("<option value='"+value.value+"'>"+txt+"</option>");
                  else
                    $('#region option').eq(index.value).before($("<option></option>").val(value.value).html(txt));
                  
                  if(i == 1) i = "";
                  if(i > 1) i--;
                  
                  $(divHerm).remove();
                  $(divPadre).remove();
                  $("#asignar").val(i);       
                    
                });
                i++;
              }
            }
          }
          addRegion();
          $("#asignar").val(i);

          html = opt;
          for(k in perfiles) {
            if(perfiles[k].idperfil == data[0].idperfil){
              reg = perfiles[k].perfil;
              idreg = perfiles[k].idperfil;
              html += '<option value="'+idreg+'" selected>'+reg+'</option>';
            }else
              html += '<option value="' + perfiles[k].idperfil + '">' + perfiles[k].perfil + '</option>';
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
    clonar();
    
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
            const btnEdit = data.activo == 1 ? `
            <button class="btn btn-warning btn-circle actionEdit" title="Editar Registro" type="button" style="margin-right: 5px;"">
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
        { data: "regiones" },
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

      vacia = false;
      buscar(valor);
      showModal(event, 'Editar Usuario');
    });

    $(".btn-nuevo").on('click', function (event) {
      //divNuevo = "<div id='nuevoDiv' style='display: none' ></div>";
      $("#padreRegion").empty();
      $("#padreRegion").html(clon);
      $("#region").empty();
      $("#region").html(resetSelect);
      $("#grilla").html(grid);
      addRegion();
      i = 0;
      
      //console.log(clon);
      //console.log($("#selectRegion"));
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
      vacia = false;
      showModal(event, 'Registrar Nuevo Usuario');
    });

    
  
  
    $("#formRegistrar").validate({     
      rules: {
        dni: { required: true, minlength: 8, maxlength: 8 },
        nombres: { required: true },
        apellidos: { required: true },
        perfil: { required: true },
        estatus: { required: true },
        user: { required: true },
        pass: { required: true },
        asignar: { required: true },
      },
      messages: {
        dni: { required: "Campo requerido" },
        nombres: { required: "Campo requerido" },
        apellidos: { required: "Campo requerido" },
        perfil: { required: "Campo requerido" },
        estatus: { required: "Campo requerido" },
        user: { required: "Campo requerido" },
        pass: { required: "Campo requerido" },
        asignar: { required: "Campo Requerido" },
      },
      submitHandler: function (form, event) {
        var formData = new FormData(document.getElementById("formRegistrar"));
        /*for(let [name, value] of formData) {
          alert(`${name} = ${value}`); // key1 = value1, luego key2 = value2
        }*/
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
            /*$("#nuevoDiv").clone().html("#selectRegion");
            $("#nuevoDiv").remove();
            $("#selectRegion").show();*/
            $("#editarModal").modal('hide');
            console.log(response);
            /*$("#selectRegion").remove();
            $("#nuevoDiv").show();*/
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