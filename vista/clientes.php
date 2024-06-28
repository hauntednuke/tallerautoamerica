<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "comunes/head.php" ?>
    <script defer src="js/clientes.js"></script>
    <title>Inicio</title>
</head>
<body>
    <?php include "comunes/nav.php"?>
    <div class="container mx-5" style="flex: 1 1 auto;">
        <main id="principal">
            <h1 class="hero">PÁGINA CLIENTES</h1>
            <div class="container">
                <div class="col d-flex mt-4">
                    <button id="registrarCliente" class="botonRegistrar" data-bs-toggle="modal" data-bs-target="#registroCliente">
                        Registrar Cliente
                    </button>
                    <button style="display:none;"id="buscarCliente" class="btn btn-dark ms-4"">Buscar Cliente</button>
                    <input style="display:none;"id="nombreCliente" type="text">
                </div>
            </div>
            <div class="container mt-5">
                <table class="table tablaprincipal" id="tablaclientes">
                    <thead>
                        <tr>
                        <th scope="col">Nombre Completo</th>
                        <th scope="col">Cedula/RIF</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th id="acciones" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenidoTabla">
                    </tbody>
                </table>
            </div>
            <div class="modal" tabindex="-1" id="registroCliente">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">Registrar Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label for="">Cedula</label>
                                    <input type="text" id="campoCedula">
                                </div>
                                <div class="col">
                                    <label for="">Nombres</label>
                                    <input type="text" id="campoNombres">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Apellidos</label>
                                    <input type="text" id="campoApellidos">
                                </div>
                                <div class="col">
                                    <label for="">Telefono</label>
                                    <input type="text" id="campoTelefono">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Correo</label>
                                    <input type="text" id="campoCorreo">
                                </div>
                                <div class="col">
                                    <label for="">Dirección</label>
                                    <input type="text" id="campoDireccion">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="botonGuardar">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" id="edicionCliente">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">Editar Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label for="">Cedula</label>
                                    <input disabled type="text" id="campoCedula2">
                                </div>
                                <div class="col">
                                    <label for="">Nombres</label>
                                    <input type="text" id="campoNombres2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Apellidos</label>
                                    <input type="text" id="campoApellidos2">
                                </div>
                                <div class="col">
                                    <label for="">Telefono</label>
                                    <input type="text" id="campoTelefono2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Correo</label>
                                    <input type="text" id="campoCorreo2">
                                </div>
                                <div class="col">
                                    <label for="">Dirección</label>
                                    <input type="text" id="campoDireccion2">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="botonEdicion">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>