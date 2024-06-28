function consultar(){
    console.log("consultar")
	var datos = new FormData();
	datos.append('accion','consultar');
	postAjax(datos);	
}


$("#botonEdicion").on("click", modificar)
$("#botonGuardar").on("click", incluir)

function incluir() {
    console.log("incluir")
    let datos = new FormData();
    datos.append("accion","incluir");
    datos.append("cedula",$("#campoCedula").val());
    datos.append("nombres",$("#campoNombres").val());
    datos.append("apellidos",$("#campoApellidos").val());
    datos.append("telefono",$("#campoTelefono").val());
    datos.append("correo",$("#campoCorreo").val())
    datos.append("direccion",$("#campoDireccion").val())
    postAjax(datos);
    limpia();
}


function eliminar(cedula) {
    console.log("eliminar")
    let datos = new FormData();
    datos.append("accion","eliminar");
    datos.append("cedula",cedula);
    postAjax(datos);
    limpia();
}

function modificar() {
    console.log("modificando")
    let datos = new FormData();
    datos.append("accion","modificar");
    datos.append("cedula",$("#campoCedula2").val());
    datos.append("nombres",$("#campoNombres2").val());
    datos.append("apellidos",$("#campoApellidos2").val());
    datos.append("telefono",$("#campoTelefono2").val());
    datos.append("correo",$("#campoCorreo2").val())
    datos.append("direccion",$("#campoDireccion2").val())
    postAjax(datos);
    limpia();
}


function botonEliminar(botonEliminar) {
    console.log("botoneliminar")
    eliminar(botonEliminar.dataset.cedula);
}

function botonEditar(botonEditar) {
    console.log("botoneditar")
    $("#campoCedula2").val(botonEditar.dataset.cedula)

    
}

function limpia() {
    $("#campoCedula").val("")
    $("#campoNombres").val("")
    $("#campoApellidos").val("")
    $("#campoTelefono").val("")
    $("#campoCorreo").val("")
    $("#campoDireccion").val("")
    $("#campoCedula2").val("")
    $("#campoNombres2").val("")
    $("#campoApellidos2").val("")
    $("#campoTelefono2").val("")
    $("#campoCorreo2").val("")
    $("#campoDireccion2").val("")
}

$(document).ready(function() {
    crearDT();
    consultar();
})

function crearDT(){
    if (!$.fn.DataTable.isDataTable("#tablaclientes")) {
            $("#tablaclientes").DataTable({
                language: {
                    lengthMenu: "Por página _MENU_",
                    zeroRecords: "No se encontraron personas",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay personas registradas",
                    infoFiltered: "(filtrado de _MAX_ registros totales)",
                    search: "Buscar:",
                    paginate: {
                        first: "Primera",
                        last: "Última",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                },
                autoWidth: false,
                order: [[1, "asc"]],
            });
    }         
}


function destruyeDT(){
	if ($.fn.DataTable.isDataTable("#tablaclientes")) {
            $("#tablaclientes").DataTable().destroy();
    }
}


function postAjax(datos) {
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
            try {
                console.log(respuesta);
                var respuestaFinal = JSON.parse(respuesta);
                if (respuestaFinal.resultado == "consultar") {
                    destruyeDT();	
                    $("#contenidoTabla").html(respuestaFinal.mensaje);
                    crearDT();
                } else if (respuestaFinal.resultado == "incluir") {
                    console.log("deberia ocultar modal");
                    $("#registroCliente").modal("hide");
                    destruyeDT();
                    consultar();
                    crearDT();
                    $.Toast(respuestaFinal.mensaje,"","success");
                } else if (respuestaFinal.resultado == "eliminar") {
                    $("#registroCliente").modal("hide");
                    $("#edicionCliente").modal("hide");
                    $.Toast(respuestaFinal.mensaje,"","success");
                    destruyeDT();
                    consultar();
                    crearDT();
                }   else if (respuestaFinal.resultado == "modificar") {
                    console.log("resultadofinal modificar")
                    $("#edicionCliente").modal("hide");
                    $.Toast(respuestaFinal.mensaje,"","success");
                    destruyeDT();
                    consultar();
                    crearDT();
                }
                
                
                else if (respuestaFinal.resultado == "error") {
                    $("#registroCliente").modal("hide");
                    $.Toast(respuestaFinal.mensaje,"","error");
                }
                
                
                
                
                else if (respuestaFinal.resultado == "error") {
                muestraMensaje(respuestaFinal.mensaje);
            }
            } catch (e) {
            alert("Error en JSON " + e);
            }
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
}