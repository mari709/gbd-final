<?php
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=listadocontribuyentes.xls');

include './conexion/conexion.php';
?>
<table>
<tr>
<td>NOMBRE</td>
<td>DIRECCION</td>
<td>NUMERO</td>
<td>PISO/DEPTO</td>
<td>LOCALIDAD</td>
<td>PROVINCIA</td>
<td>CODIGO POSTAL</td>
</tr>
<?php
$sqlquery ="select * from contactos where localidad like '".$_GET['v1']."' and dir_calle like '".$_GET['v2']."' and dir_numero between '".$_GET['v3']."' and '".$_GET['v4']."'";
$sqlcall = mysqli_query($link,$sqlquery);
while ($data = mysqli_fetch_assoc($sqlcall)){
    echo "<tr>";
    echo "<td>".$data['nombre']."</td>";
    echo "<td>".$data['dir_calle']."</td>";
    echo "<td>".$data['dir_numero']."</td>";
    echo "<td>".$data['dir_piso_depto']."</td>";
    echo "<td>".$data['localidad']."</td>";
    echo "<td>".$data['pcia']."</td>";
    echo "<td>".$data['c_postal']."</td>";
    echo "<tr>";
}
?>
</table>