<?php
include './conexion/conexion.php';

session_start();
if(isset(($_SESSION['status']))){

?>
<!DOCTYPE html>
<html lang="es">
<!--head-->
<?php include_once './vistas/my-head.php' ?>
<script src= "js/escucha_calle.js"></script>
</head>

<body>
<!--navbar-->
<?php include_once './vistas/navbar.php' ?>
      <section class="container pt-4 buscador-personas">
        <h1 class="h1-encabezado pt-4 pb-4">Buscar personas por calle</h1>
      </section>
      
      <main>
      <section class="container mt-4"> 
      <form class='card p-4 card-shadow'>
        <div class="container form-group w-50 text-left">
          <label for="input-buscar-calle"><h5 class="pasos">Escribe el nombre de la calle</h5></label>
          <input type="text" class="form-control ml-2" id="input-buscar-calle" name="input-buscar-calle"  placeholder ="Tucumán" maxlength="50">
        </div>


        <div class="text-center container" id="resultado-calle"></div> 
        <div class="text-center container" id="informe"></div>
      </form>
</section>
      </main>

    </body>
</html>
<?PHP
}
else{
  header('Location:login.php');
}

?>