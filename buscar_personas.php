<?php
include './conexion/conexion.php';
session_start();
if(isset(($_SESSION['status']))){

?>
<!DOCTYPE html>
<html lang="es">

<!--head-->
<?php include_once './vistas/my-head.php' ?>
</head>

<body>
<!--navbar-->
<?php include_once './vistas/navbar.php' ?>
      <section class="container pt-4 buscador-personas">
        <h1 class="h1-encabezado pt-4 pb-4">Buscar personas</h1>
      </section>
      <section class="container mt-4"> 
        <form class='card p-4 card-shadow'>
            <h5 class="pasos">Completa total o parcialmente 1 o más campos para realizar la consulta</h5>
          <div class='card-body'>
            <div class="form-group">
              <div class="row pl-4 pr-4">
                <div class="col-sm-4">
                <label for="input-nombre">Nombre</label>
                <input type="text" class="form-control input-bloque-persona" id="input-nombre" name="input-nombre"  placeholder ="Laura" maxlength="50">
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="input-calle">Calle</label>
                  <input type="text" class="form-control input-bloque-persona" id="input-calle" name="input-calle" placeholder ="Falucho" maxlength="50" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="input-localidad">Localidad</label>
                  <input type="text" class="form-control input-bloque-persona" id="input-localidad" name="input-localidad" placeholder ="Mar del Plata" maxlength="50">    
                </div>
              </div>
            </div>
          </div>        
        </form>
      </section>
      <div class="text-center container" id="resultado-personas"></div>
      
      
      <script>
      
      function buscarDatos (valor1, valor2, valor3) {
        let parametros ={
          "var1": valor1,
          "var2": valor2,
          "var3": valor3
        };

        $.ajax({
          data: parametros,
          url: 'personas_buscadas.php',
          type: 'post',
          beforeSend: function() {
            $("#resultado-personas").html("<div class='alert alert-light card card-shadow' role='alert'>Realizando búsqueda...</div>");
          },
          success: function(response) {
            $("#resultado-personas").html(response);

          }
        });
      }

      $(document).on('keyup', '.input-bloque-persona', function(){
          let valor1 = $('#input-nombre').val();
          let valor2 = $('#input-calle').val();
          let valor3 = $('#input-localidad').val();
          buscarDatos(valor1, valor2, valor3);
      });
      </script>
  </body>
</html>
<?PHP
}
else{
  header('Location:login.php');
}

?>