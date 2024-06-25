<?php
  
if (!is_file("modelo/usuario.php")){

	echo "Falta definir la clase ".$pagina;
	exit;
} 

require_once("modelo/usuario.php");  


  if(is_file("vista/".$pagina.".php")){
	
	  if(!empty($_POST)){
		$usuario = new Usuario();   
		  //como ya sabemos si estamos aca es //porque se recibio alguna informacion
		  //de la vista, por lo que lo primero que //debemos hacer ahora que tenemos una 
		  //clase es guardar esos valores en ella //con los metodos set
		  $accion = $_POST['accion'];
		  		  
			  $usuario->set_usuario($_POST['nombre_de_usuario']);
			  $usuario->set_contrasena($_POST['contrasena']);
			  if($accion=='incluir'){
				echo  json_encode($usuario->registrar_usuario());
			  }
		  exit;
	  }
	  
	  
	  require_once("vista/".$pagina.".php"); 
  }
  else{
	  echo "pagina en construccion";
  }
?>