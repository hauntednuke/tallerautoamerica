<?php 

require_once("modelo/conexion.php");



class Cliente extends Conexion {
    private $cedula;
    private $nombres;
    private $apellidos;
    private $telefono;
    private $correo;
    private $direccion;

    function set_cedula($cedula) {
        $this->cedula = $cedula;
    }
    function get_cedula() {
        return $this->cedula;
    }
    function set_nombres($nombres) {
        $this->nombres = $nombres;
    }
    function get_nombres() {
        return $this->nombres;
    }
    function set_apellidos($apellidos) {
        $this->apellidos = $apellidos;
    }
    function get_apellidos() {
        return $this->apellidos;
    }
    function set_telefono($telefono) {
        $this->telefono = $telefono;
    }
    function get_telefono() {
        return $this->telefono;
    }
    function set_correo($correo) {
        $this->correo = $correo;
    }
    function get_correo() {
        return $this->correo;
    }
    function set_direccion($direccion) {
        $this->direccion = $direccion;
    }
    function get_direccion() {
        return $this->direccion;
    }

    function existe($cedula) {
        $conexion = $this->conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $resultado = $conexion->query("Select * from cliente where cedula =".$cedula);
            $fila = $resultado->fetchAll(PDO::FETCH_BOTH);

            if ($fila) return true;
            else return false;
        } catch (Exception $error) {
            return false;
        }
    }
    function incluir() {

        $respuesta = array();

        if(!$this->existe($this->cedula)) {
            $conexion = $this->conectar();
    
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $conexion->query("Insert into cliente(
                    cedula,
                    nombres,
                    apellidos,
                    telefono,
                    correo,
                    direccion
                    )
                    Values(
                    '$this->cedula',
                    '$this->nombres',
                    '$this->apellidos',
                    '$this->telefono',
                    '$this->correo',
                    '$this->direccion'
                    )");
    
                $respuesta['resultado'] = 'incluir';
                $respuesta['mensaje'] =  'Cliente Registrado';
            } catch(Exception $error) {
                $respuesta['resultado'] = 'error';
                $respuesta['mensaje'] =  $error->getMessage();
            } 
        } else {
            $respuesta['resultado'] = 'existe';
            $respuesta['mensaje'] =  'Ya existe la cedula';
        }
        return $respuesta;
    }

    function modificar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		if($this->existe($this->cedula)){
			try {
					$conexion->query("Update cliente set 
					    cedula = '$this->cedula',
						nombres = '$this->nombres',
						apellidos = '$this->apellidos',
						telefono = '$this->telefono',
						correo = '$this->correo',
						direccion = '$this->direccion'
						where
						cedula = '$this->cedula'
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
			$respuesta ['mensaje'] =  'Cedula no registrada';
		}
		return $respuesta ;
	}
    function eliminar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		if($this->existe($this->cedula)){
			try {
					$conexion->query("delete from cliente where
						cedula = '$this->cedula'
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
			$respuesta['mensaje'] =  'No existe la cedula';
		}
		return $respuesta;
	}

    function consultar(){
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$respuesta = array();
		try{
			
			$resultado = $conexion->query("Select * from cliente");
			
			if($resultado){
				
				$html = '';
				foreach($resultado as $r){
					$html = $html.'<tr>';
                        $html= $html.'<th scope="row">';
                            $html= $html.$r["nombres"]." ".$r["apellidos"];
                        $html= $html.'</th>';
                        $html= $html.'<td>';
                            $html= $html.$r["cedula"];
                        $html= $html.'</td>';
                        $html= $html.'<td>';
                            $html= $html.$r["direccion"];
                        $html= $html.'</td>';
                        $html= $html.'<td>';
                            $html= $html.$r["telefono"];
                        $html= $html.'</td>';
                        $html= $html.'<td id="acciones">';
                            $html= $html.'<span data-bs-toggle="modal" data-bs-target="#edicionCliente" onclick=botonEditar(this) data-cedula="'.$r["cedula"].'" id="icono" class="fa-solid fa-pen-to-square editar"></span>';
                            $html= $html.'<span onclick=botonEliminar(this) data-cedula="'.$r["cedula"].'" id="icono" class="fa-solid fa-trash-can borrar"></span>';
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