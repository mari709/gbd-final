<?php
include './conexion/conexion.php';

$sql = "select * from contactos where dir_calle like '%".$calle."%' and localidad like '%".$localidad."%'";
$mostrar = mysqli_query($link,$sql);


while($row = mysqli_fetch_assoc($mostrar)){

    echo "<tr>";
        echo "<td>".$row['dir_calle']."</td>";
        echo "<td>".$row['localidad']."</td>";
    echo "</tr>";      

