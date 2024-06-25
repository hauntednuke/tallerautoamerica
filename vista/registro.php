<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "comunes/head.php" ?>
    <script defer src="js/registro.js"></script>
    <title>Registro</title>
</head>
<body>
<section class="vh-100 fila fila-centrado">

  <div class="container-md fila fila-centrado">
    <img class="login-logo" src="comunes/img/3dlogo.png">
    <h1 class="ms-5 login-titulo">AUTOAMÉRICA<br/>MOTORS</h1>
  </div>

  <div class="container">
    <form>
      <h2 class="mb-4">Registro</h2>
      <!-- Email input -->
      <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="nombre_de_usuario" name="nombre_de_usuario" class="form-control-lg"
          placeholder="Introduzca el usuario" />
        <label class="form-label ms-3" for="nombre_de_usuario">Nombre de usuario</label>
      </div>
  
      <!-- Password input -->
      <div data-mdb-input-init class="form-outline mb-3">
        <input type="password" id="contrasena" name="contrasena" class="form-control-lg"
          placeholder="Introduzca la contrasena" />
        <label class="form-label ms-3" for="contrasena">Contraseña</label>
      </div>
  
      <div class="text-center text-lg-start mt-4 pt-2">
        <button  id="enviar_registro" type="button" data-mdb-button-init data-mdb-ripple-init class="login-boton btn btn-lg"
          style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrarse</button>
      </div>
    </form>

  </div>

      </div>
    </div>
  </div>
</section>
</body>
</html>