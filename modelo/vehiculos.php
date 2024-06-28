<?php 

require_once("modelo/conexion.php");



class Vehiculo extends Conexion {
    private $placa;
    private $marca;
    private $modelo;
    private $ano;


    function set_placa($placa) {
        $this->placa = $placa;
    }
    function get_placa() {
        return $this->placa;
    }
    function set_marca($marca) {
        $this->marca = $marca;
    }
    function get_marca() {
        return $this->marca;
    }
    function set_modelo($modelo) {
        $this->modelo = $modelo;
    }
    function get_modelo() {
        return $this->modelo;
    }
    function set_ano($ano) {
        $this->ano = $ano;
    }
    function get_ano() {
        return $this->ano;
    }
    

    function existe($placa) {
        $conexion = $this->conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $conexion->query("Select * from vehiculo where placa =".$placa);
            $fila = $resultado->fetchAll(PDO::FETCH_BOTH);

            if ($fila) return true;
            else return false;
        } catch (Exception $error) {
            return false;
        }
    }
    function incluir() {

        $respuesta = array();

        if(!$this->existe($this->placa)) {
            $conexion = $this->conectar();
    
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $conexion->query("Insert into vehiculo(
                    placa,
                    marca,
                    modelo,
                    ano
                    )
                    Values(
                    '$this->placa',
                    '$this->marca',
                    '$this->modelo',
                    '$this->ano'
                    )");
    
                $respuesta['resultado'] = 'incluir';
                $respuesta['mensaje'] =  'Vehiculo Registrado';
            } catch(Exception $error) {
                $respuesta['resultado'] = 'error';
                $respuesta['mensaje'] =  $error->getMessage();
            } 
        } else {
            $respuesta['resultado'] = 'existe';
            $respuesta['mensaje'] =  'Ya existe la placa';
        }
        return $respuesta;
    }

    function modificar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		if($this->existe($this->placa)){
			try {
					$conexion->query("Update vehiculo set 
					    placa = '$this->placa',
						marca = '$this->marca',
						modelo = '$this->modelo',
						ano = '$this->ano'
						where
						placa = '$this->placa'
						");
						$respuesta ['resultado'] = 'modificar';
			            $respuesta ['mensaje'] =  'Registro Modificado';
			} catch(Exception $e) {
				$respuesta ['resultado'] = 'error';
			    $respuesta ['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$respuesta ['resultado'] = 'error';
			$respuesta ['mensaje'] =  'placa no registrada';
		}
		return $respuesta ;
	}
    function eliminar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		if($this->existe($this->placa)){
			try {
					$conexion->query("delete from vehiculo where
						placa = '$this->placa'
						");
						$respuesta['resultado'] = 'eliminar';
			            $respuesta['mensaje'] =  'Registro Eliminado';
			} catch(Exception $e) {
				$respuesta['resultado'] = 'error';
			    $respuesta['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$respuesta['resultado'] = 'error';
			$respuesta['mensaje'] =  'No existe la placa';
		}
		return $respuesta;
	}

    function consultar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		try{
			
			$resultado = $conexion->query("Select * from vehiculo");
			
			if($resultado){
				
				$html = '';
				foreach($resultado as $r){
					$html = $html.'<tr>';
                        $html= $html.'<th scope="row">';
                            $html= $html.$r["placa"];
                        $html= $html.'</th>';
                        $html= $html.'<td>';
                            $html= $html.$r["marca"];
                        $html= $html.'</td>';
                        $html= $html.'<td>';
                            $html= $html.$r["modelo"];
                        $html= $html.'</td>';
                        $html= $html.'<td>';
                            $html= $html.$r["ano"];
                        $html= $html.'</td>';
                        $html= $html.'<td id="acciones">';
                            $html= $html.'<span data-bs-toggle="modal" data-bs-target="#edicionVehiculo" onclick=botonEditar(this) data-placa="'.$r["placa"].'" id="icono" class="fa-solid fa-pen-to-square editar"></span>';
                            $html= $html.'<span onclick=botonEliminar(this) data-placa="'.$r["placa"].'" id="icono" class="fa-solid fa-trash-can borrar"></span>';
                        $html= $html.'</td>';
                    $html = $html.'</tr>';
				}
				
			    $respuesta['resultado'] = 'consultar';
				$respuesta['mensaje'] =  $html;
			}
			else{
				$respuesta['resultado'] = 'consultar';
				$respuesta['mensaje'] =  '';
			}
			
		}catch(Exception $e){
			$respuesta['resultado'] = 'error';
			$respuesta['mensaje'] =  $e->getMessage();
		}
		return $respuesta;
	}

}

?>