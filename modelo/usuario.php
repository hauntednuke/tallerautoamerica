<?php

require_once('modelo/conexion.php');


class Usuario extends Conexion {
    private $nombre_de_usuario;
    private $contrasena;

    function set_usuario($valor) {
        $this->nombre_de_usuario = $valor;
    }

    function set_contrasena($valor) {
        $this->contrasena = $valor;
    }

    function get_usuario() {
        return $this->nombre_de_usuario;
    }

    function get_contrasena() {
        return $this->contrasena;
    }

    public function existe($nombre_de_usuario) {
        $conexion = $this->conectar();
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        try {
            $consulta = $conexion->query("Select * from usuario where nombre_de_usuario ='$nombre_de_usuario'");
            $fila = $consulta->fetchAll(PDO::FETCH_BOTH);
            if ($fila) {
    
                return true;
            } else {
    
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function login_usuario() {
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!$this->existe($this->nombre_de_usuario)) return "¡El Usuario no existe!";

		try {

			$consulta = $conexion->prepare("SELECT * FROM usuario WHERE 
			nombre_de_usuario=:nombre_de_usuario");
			$consulta->bindParam(':nombre_de_usuario', $this->nombre_de_usuario);
			$consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
			if ($resultado && password_verify($this->contrasena,$resultado["contrasena"])) {
				$_SESSION["loggedin"] = true;
				$_SESSION["usuario"]= $this->nombre_de_usuario;
				return $resultado;
                
			} else {
				return "fallido";
			}
		} catch (Exception $e) {
			return $e;
		}
	}



    public function registrar_usuario()
	{
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			// Consulta SQL con marcadores de posición
			$sql = "INSERT INTO usuario (
                nombre_de_usuario,
                contrasena
            ) VALUES (
                :nombre_de_usuario,
                :contrasena
            )";

			// Preparar la consulta
			$consulta = $conexion->prepare($sql);
            $contrasena_hash = password_hash($this->contrasena,PASSWORD_DEFAULT);
			// Asociar valores a los marcadores de posición con bindParam
			$consulta->bindParam(':nombre_de_usuario', $this->nombre_de_usuario, PDO::PARAM_STR);
			$consulta->bindParam(':contrasena', $contrasena_hash, PDO::PARAM_STR);

			// Aquí debes asignar valores a las variables $idusuario, $nombres, $apellidos, $contrasena, $id_pregunta_s, $respuesta
			// Estos valores deben provenir de tus variables o de algún otro proceso de tu aplicación
            
			// Ejecutar la consulta preparada
			$consulta->execute();

			return "Usuario registrado exitosamente";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

    public function validarusuario() {
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try {
			$consulta = $conexion->prepare("SELECT nombre_de_usuario FROM usuario WHERE nombre_de_usuario = :nombre_de_usuario");
			$consulta->bindParam(':usuario', $this->nombre_de_usuario);
			$consulta->execute();
			$consulta = $consulta->fetch(PDO::FETCH_ASSOC);
			if ($consulta) {
				return $consulta; // Devuelve el ID de usuario y el ID de la pregunta de seguridad
			} else {
				return false; // El usuario no existe en la base de datos
			}
		} catch (Exception $e) {
			return false; // Ocurrió un error al ejecutar la consulta
		}
	}

    public function borrar_usuario()
	{
		$conexion = $this->conectar();
		$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		try {
			$conexion->query("delete from usuario
						where
						nombre_de_usuario = '$this->nombre_de_usuario'
						");
			return "Registro Eliminado";
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

}

?>