<?php
$link = mysqli_connect( "localhost", "root", "")
or die ("no se ha podido conectar con la base de datos");
mysqli_select_db($link, "contribuyentes_resumida")
or die("Error al tratar de selecccionar esta base de datos");

//$string = "hola mundo";
?>