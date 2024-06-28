



/*$("#iniciar").on("click", iniciarSesion);


function iniciarSesion() {
    let formulario = new FormData();
    formulario.append("accion","login");
    formulario.append("nombre_de_usuario",$("#nombre_de_usuario").val());
    formulario.append("contrasena",$("#contrasena").val());

    enviaAjax(formulario);
}



function enviaAjax(datos) {
    $.ajax({
      async: true,
      url: "",
      type: "POST",
      contentType: false,
      data: datos,
      processData: false,
      cache: false,
      beforeSend: function () {},
      timeout: 10000, //tiempo maximo de espera por la respuesta del servidor
      success: function (respuesta) {
      console.log(respuesta);
      },
      error: function (request, status, err) {
        // si ocurrio un error en la trasmicion
        // o recepcion via ajax entra aca
        // y se muestran los mensaje del error
        if (status == "timeout") {
          //pasa cuando superan los 10000 10 segundos de timeout
          muestraMensaje("Servidor ocupado, intente de nuevo");
        } else {
          //cuando ocurre otro error con ajax
          muestraMensaje("ERROR: <br/>" + request + status + err);
        }
      },
      complete: function () {},
    });
  }*/