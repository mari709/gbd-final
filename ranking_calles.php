<?php
include './conexion/conexion.php';
session_start();
if(isset(($_SESSION['status']))){
        
//$error_reporting = E_ALL & ~E_NOTICE;
$sql = "SELECT dir_numero from contactos order by dir_numero DESC limit 1";
$sql_exec = mysqli_query($link, $sql);
$sql_exec_datos = mysqli_fetch_assoc($sql_exec);
$altura_maxima = $sql_exec_datos['dir_numero'];

?>
<!DOCTYPE html>
<html lang="es">

<!--head-->
<?php include_once './vistas/my-head.php' ?>
<script src="js/funciones.js"></script>
</head>

<body>
<!--navbar-->
<?php include_once './vistas/navbar.php' ?>
      <section class="container pt-4 buscador-personas">
        <h1 class="h1-encabezado pt-4 pb-4">Ranking de 10 calles con más contribuyentes</h1>
      </section>

<?php 

 
         echo"     
        <div class='text-center pt-4'>
                        <h5 class='pasos'>Indicar rango de alturas para saber calles con más contribuyentes en ese rango</h5>
                        <div class='card-body'>
                        <div>
                                <label>Altura A</label>
                                <input type='range' value='0' min='0' max='".$altura_maxima."' onchange='updTextmin(this.value);'>
                                <input type='number' class='ranking-a__number' step='100' min='0' id='input_min_number' value='0' oninput='validity.valid||(value='')';>
                        </div>
                        <div>
                                <label>Altura B</label>
                                <input type='range' value='".$altura_maxima."' name='max_range' min='0' max='".$altura_maxima."' onchange='updTextmax(this.value);'>
                                <input type='number' class='ranking-b__number' step='1' id='input_max_number' min='0' value='".$altura_maxima."' oninput='validity.valid||(value='')';>
                        </div>

";?>
                        <input type="button" class="btn btn-primary" value="mostrar" href="javascript:;" onclick="realizaProceso($('#input_min_number').val(), $('#input_max_number').val());return false;">   
                </div>
        
<!-- PASO 2 --> 
<div class='contenedor-grilla m-4'>

                <div id="card1-resultado"  class='card d-none paso2 pt-4'>
                        <div class='card-body '>
                        <h6 id="paso2"></h6>
                        <div id="resultado"></div>
                        </div>
                </div>
<!-- PASO 3 --> 

                <div id=card2-resultado class="card  paso3  pt-4">
                        <h4 class="pasos"></h4>
                        <div class='card-body'>
                        <div id="resultado2"></div>
                        </div>
                </div>
</div>


<script>
function updTextmin(val) {
        document.getElementById('input_min_number').value=val; 
}
function updTextmax(val) {
        document.getElementById('input_max_number').value=val; 
}
</script>
<?PHP
}
else{
  header('Location:login.php');
}

?>