function emergencias(URI) {

    function showModal(event,title) {
        $("#editarModal").modal("show");
        $("#editarModalLabel").text(title);
        event.stopPropagation();
        event.stopImmediatePropagation();
    }

    $(document).ready(function () {
        $(".btn-nuevo").on('click', function (event) {
            $("#formRegistrar")[0].reset();
            $("#act").val(0);
            $("#enviar").text("Guardar");
            $("select").prop('selectedIndex',0);
            showModal(event, 'Registrar Nueva Emergencia');
          });
    
    });

    $("#formRegistrar").validate({
      rules: {
        tlf: { required: true },
        tipoLl: { required: true },
        tlf2: { required: true },
        tipoDoc: { required: true },
        nroDoc: { required: true },
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
            console.log(response);
            //const { status } = response;
            if (status === 200) {
              $("#editarModal").modal('hide');
              $("#formRegistrar")[0].reset();
              //$('.btn-editar').removeClass('active');
              //loadData(table);
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


}