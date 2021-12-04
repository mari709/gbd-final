<?php
include './conexion/conexion.php';

$nombre = $_POST['var1'];
$calle = $_POST['var2'];
$localidad = $_POST['var3'];
$sql = "select * from contactos where nombre like '%".$nombre."%' and dir_calle like '%".$calle."%' and localidad like '%".$localidad."%'";

$mostrar = mysqli_query($link,$sql);
$counter = mysqli_num_rows($mostrar);


if($counter>=50){
    echo "<div class='alert alert-light' role='alert'>La búsqueda arroja mas de 50 resultados. <strong>Por favor reformule la búsqueda</strong></div>";

}

if($counter==0){
echo "<div class='alert alert-light' role='alert'>No hay coincidencias para esta búsqueda</div>";

}

if(($counter>0) && ($counter<50)){
    echo "<span class='alert alert-light card' role='alert'>Se encontraron $counter resultados para esta búsqueda</span><span><a href='excel_personas.php?pnombre=$nombre&pcalle=$calle&plocalidad=$localidad' class='btn btn-success'><i class='bi bi-file-earmark-excel-fill'> Exportar lista a Excel</i></a></span>";
    echo "<div class='pt-4 table-responsive-sm'>";
    echo "<table class='table table-striped table-sm align-middle'>";
        echo "<thead class='thead-dark'>";
            echo "<tr>";
                echo "<th scope='col'>#</th>";
                echo "<th scope='col'>Nombre</th>";
                echo "<th scope='col'>Calle</th>";
                echo "<th scope='col'>Número</th>";
                echo "<th scope='col'>Localidad</th>";
                echo "<th scope='col'>Ver</th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

    $nro_reg_persona = 0;
    $id_btn_persona = 'p';
   
    $counter = 0;


    while($row = mysqli_fetch_assoc($mostrar)){
        
        $id_btn_persona .=((string)$nro_reg_persona);
        //echo $id_btn_persona;
        $nro_reg_persona++;

        $counter++;
        $btnname ='p';
        $btnname .=$counter;

        echo "<tr>";
            echo "<td scope='row'>$nro_reg_persona</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['dir_calle']."</td>";
            echo "<td>".$row['dir_numero']."</td>";
            echo "<td>".$row['localidad']."</td>";
            echo "<td><a id='$btnname' class='btn btn-primary'><i class='bi bi-search'></i></a></td>";
        echo "</tr>";      

        echo "
        

            <script>
            $(document).ready(function () {
                $('#".$btnname."').click(function() {
                    Swal.fire({
                        html: `<h2>Ficha de datos</h2>
                                <hr>
                                <p><span class='ficha'>Nombre: </span>".$row['nombre']."</p>
                                <p><span class='ficha'>Dirección: </span>".$row['dir_calle']. " " .$row['dir_numero']."</p>
                                <p><span class='ficha'>Localidad: </span>".$row['localidad']."</p>
                                <p><span class='ficha'>Provincia: </span>".$row['pcia']."</p>
                                <p><span class='ficha'>Código Postal: </span>".$row['c_postal']."</p>
                                <input type='button' class='btn btn-secondary' value='Imprimir' onclick='javascript:window.print()' />`
                    })
                })
            });
            </script>
        ";

    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";  
    $btnname='p';
}



$close = mysqli_close($link); ?>