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
    datos.append("placa",$("#campoPlaca").val());
    datos.append("marca",$("#campoMarca").val());
    datos.append("modelo",$("#campoModelo").val());
    datos.append("ano",$("#campoAno").val());
    postAjax(datos);
    limpia();
}


function eliminar(placa) {
    console.log("eliminar")
    let datos = new FormData();
    datos.append("accion","eliminar");
    datos.append("placa",placa);
    postAjax(datos);
    limpia();
}

function modificar() {
    console.log("modificando")
    let datos = new FormData();
    datos.append("accion","modificar");
    datos.append("placa",$("#campoPlaca2").val());
    datos.append("marca",$("#campoMarca2").val());
    datos.append("modelo",$("#campoModelo2").val());
    datos.append("ano",$("#campoAno2").val());
    postAjax(datos);
    limpia();
}


function botonEliminar(botonEliminar) {
    console.log("botonEliminar")
    console.log("placa: "+botonEliminar.dataset.placa)
    eliminar(botonEliminar.dataset.placa);
}

function botonEditar(botonEditar) {
    console.log("botonEditar")
    console.log("placa: "+botonEditar.dataset.placa)
    $("#campoPlaca2").val(botonEditar.dataset.placa)

    
}

function limpia() {
    $("#campoPlaca").val("")
    $("#campoMarca").val("")
    $("#campoModelo").val("")
    $("#campoAno").val("")
    $("#campoPlaca2").val("")
    $("#campoMarca2").val("")
    $("#campoModelo2").val("")
    $("#campoAno2").val("")
}

$(document).ready(function() {
    crearDT();
    consultar();
})

function crearDT(){

    if (!$.fn.DataTable.isDataTable("#tablavehiculos")) {
            $("#tablavehiculos").DataTable({
                language: {
                    lengthMenu: "Mostrar por página _MENU_",
                    zeroRecords: "No se encontraron vehículos",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No hay vehículos registrados",
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
	if ($.fn.DataTable.isDataTable("#tablavehiculos")) {
            $("#tablavehiculos").DataTable().destroy();
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
                    $("#registroVehiculo").modal("hide");
                    destruyeDT();
                    consultar();
                    crearDT();
                    $.Toast(respuestaFinal.mensaje,"","success");
                } else if (respuestaFinal.resultado == "eliminar") {
                    $("#registroVehiculo").modal("hide");
                    $("#edicionVehiculo").modal("hide");
                    $.Toast(respuestaFinal.mensaje,"","success");
                    destruyeDT();
                    consultar();
                    crearDT();
                }   else if (respuestaFinal.resultado == "modificar") {
                    console.log("resultadofinal modificar")
                    $("#edicionVehiculo").modal("hide");
                    $.Toast(respuestaFinal.mensaje,"","success");
                    destruyeDT();
                    consultar();
                    crearDT();
                }
                
                
                else if (respuestaFinal.resultado == "error") {
                    $("#registroVehiculo").modal("hide");
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