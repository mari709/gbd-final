<?php
include './conexion/conexion.php';
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<!--head--> 

<?php include_once './vistas/my-head.php' ?>
    <link href="estilos/signin.css" rel="stylesheet">
</head>

  <body class="text-center">
    <form class="form-signin" action = "access.php" method="post">
    <img src="favicon.png" alt="logo"/>
      <h2 class="m-3 lambdaweb-title">Lambda Web</h2>
      <h6 class="mb-3"><br></h6>
      <label for="username" class="sr-only">Nombre de usuario</label>
      <input type="text" id="username" class="form-control mb-3" placeholder="Nombre de usuario" required autofocus name="user" >
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Contraseña" required name="password">
      <button class="btn btn-md  btn-primary btn-block" type="submit">Ingresar</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
  </body>
</html>