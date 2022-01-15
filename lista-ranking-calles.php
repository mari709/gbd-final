<?php
include './conexion/conexion.php';

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=listadoranking.xls');

$sql ="
select counter,dir_calle,localidad from 
(select count(dir_calle)as counter, dir_calle,dir_numero,localidad from contactos
where dir_numero BETWEEN '".$_GET['data1']."'and '".$_GET['data2']."'
group by dir_calle ,localidad
ORDER BY `counter`  DESC limit 50) as cuenta
";

$puesto = 1;
?>

<table>
<tr>
<td>PUESTO</td>
<td>DOMICILIOS REG.</td>
<td>CALLE</td>
<td>LOCALIDAD</td>    
</tr>

<?php
$sqlhacer = mysqli_query($link,$sql);
while ($data= mysqli_fetch_assoc($sqlhacer))
{
echo "<tr>";    
echo "<td>".$puesto."</td>";
echo "<td>".$data['counter']."</td>";
echo "<td>".$data['dir_calle']."</td>";
echo "<td>".$data['localidad']."</td>";
echo "</tr>";
$puesto++;
}
?>

</table>

<?php