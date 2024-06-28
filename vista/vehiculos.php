<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "comunes/head.php" ?>
    <script defer src="js/vehiculos.js"></script>
    <title>Inicio</title>
</head>
<body>
    <?php include "comunes/nav.php"?>
    <div class="container mx-5" style="flex: 1 1 auto;">
        <main id="principal">
            <h1 class="hero">PÁGINA VEHÍCULOS</h1>
            <div class="container">
                <div class="col d-flex mt-4">
                    <button id="registrarVehículo" class="botonRegistrar" data-bs-toggle="modal" data-bs-target="#registroVehiculo">
                        Registrar Vehículo
                    </button>
                    <button style="display:none;"id="buscarVehiculo" class="btn btn-dark ms-4"">Buscar Vehiculo</button>
                    <input style="display:none;"id="nombreVehiculo" type="text">
                </div>
            </div>
            <div class="container mt-5">
                <table class="table tablaprincipal" id="tablavehiculos">
                    <thead>
                        <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Año</th>
                        <th id="acciones" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenidoTabla">
                    </tbody>
                </table>
            </div>
            <div class="modal" tabindex="-1" id="registroVehiculo">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">Registrar Vehiculo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label for="">Placa</label>
                                    <input type="text" id="campoPlaca">
                                </div>
                                <div class="col">
                                    <label for="">Marca</label>
                                    <input type="text" id="campoMarca">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Modelo</label>
                                    <input type="text" id="campoModelo">
                                </div>
                                <div class="col">
                                    <label for="">Año</label>
                                    <input type="text" id="campoAno">
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
            <div class="modal" tabindex="-1" id="edicionVehiculo">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title">Editar Vehiculo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label for="">Placa</label>
                                    <input disabled type="text" id="campoPlaca2">
                                </div>
                                <div class="col">
                                    <label for="">Marca</label>
                                    <input type="text" id="campoMarca2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Modelo</label>
                                    <input type="text" id="campoModelo2">
                                </div>
                                <div class="col">
                                    <label for="">Año</label>
                                    <input type="text" id="campoAno2">
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