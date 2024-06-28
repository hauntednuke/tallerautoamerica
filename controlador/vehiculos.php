<?php


if(!is_file("modelo/".$pagina.".php")) {
    echo "no existe la clase ".$pagina;
    exit();
}

require_once("modelo/".$pagina.".php");

if (is_file("vista/".$pagina.".php")) {



    if($_POST) {
        $vehiculo = new Vehiculo();

        $accion = $_POST["accion"];
        
        if($accion == "existe") {
            echo json_encode($vehiculo->existe($_POST["placa"]));
        }

        if($accion == "consultar") {

            echo json_encode($vehiculo->consultar());

        } else if ($accion == "eliminar") {

            $vehiculo->set_placa($_POST["placa"]);
            echo json_encode($vehiculo->eliminar());

        }else {
            $vehiculo->set_placa($_POST["placa"]);
            $vehiculo->set_marca($_POST["marca"]);
            $vehiculo->set_modelo($_POST["modelo"]);
            $vehiculo->set_ano($_POST["ano"]);
            if($accion=="incluir") {
                echo json_encode($vehiculo->incluir());
            }elseif ($accion=="modificar"){
                echo json_encode($vehiculo->modificar());
            }
        }
        
        exit;
    }

















    require_once("vista/".$pagina.".php");
} else echo "pagina ".$pagina."en construcción"





?>