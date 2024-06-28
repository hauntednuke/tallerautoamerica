<?php


if(!is_file("modelo/".$pagina.".php")) {
    echo "no existe la clase ".$pagina;
    exit();
}

require_once("modelo/".$pagina.".php");

if (is_file("vista/".$pagina.".php")) {



    if($_POST) {
        $cliente = new Cliente();

        $accion = $_POST["accion"];
        
        if($accion == "consultar") {

            echo json_encode($cliente->consultar());

        } else if ($accion == "eliminar") {

            $cliente->set_cedula($_POST["cedula"]);
            echo json_encode($cliente->eliminar());

        }else {
            $cliente->set_cedula($_POST["cedula"]);
            $cliente->set_nombres($_POST["nombres"]);
            $cliente->set_apellidos($_POST["apellidos"]);
            $cliente->set_telefono($_POST["telefono"]);
            $cliente->set_correo($_POST["correo"]);
            $cliente->set_direccion($_POST["direccion"]);
            if($accion=="incluir") {
                echo json_encode($cliente->incluir());
            }elseif ($accion=="modificar"){
                echo json_encode($cliente->modificar());
            }
        }
        
        exit;
    }

















    require_once("vista/".$pagina.".php");
} else echo "pagina ".$pagina."en construcción"





?>