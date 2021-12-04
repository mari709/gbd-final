<?PHP
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=listadobusquedacalle.xls');


include './conexion/conexion.php';

$imp_calle = $_GET['data1'];
$imp_numeroa = $_GET['data2'];//menor
$imp_numerob = $_GET['data3'];//mayor

?>
<table>
<tr>
<td>NOMBRE</td>
<td>CALLE</td>
<td>NUMERO</td>
<td>PISO/DEPTO</td>
<td>LOCALIDAD</td>
<td>PROVINCIA</td>
<td>CODIGO POSTAL</td>
</tr>
<?php
$sqlquery2 ="select * from contactos where dir_calle like '%".$imp_calle."%' and dir_numero between '".$imp_numeroa."' and '".$imp_numerob."'";
$sqlcall2 = mysqli_query($link,$sqlquery2);
while ($data2 = mysqli_fetch_assoc($sqlcall2)){
    echo "<tr>";
    echo "<td>'".$data2['nombre']."'</td>";
    echo "<td>'".$data2['dir_calle']."'</td>";
    echo "<td>'".$data2['dir_numero']."'</td>";
    echo "<td>'".$data2['dir_piso_depto']."'</td>";
    echo "<td>'".$data2['localidad']."'</td>";
    echo "<td>'".$data2['pcia']."'</td>";
    echo "<td>'".$data2['c_postal']."'</td>";
    echo "<tr>";
}
?>
</table>

