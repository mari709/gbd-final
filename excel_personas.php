<?php
include 'conexion/conexion.php';
$nombre = $_GET['pnombre'];
$calle = $_GET['pcalle'];
$localidad = $_GET['plocalidad'];
$sqlquery = "select nombre,c_postal,localidad,pcia,dir_calle,dir_numero,dir_piso_depto
from `contactos` where nombre like '%$nombre%' and dir_calle like '%$calle%' and localidad like '%$localidad%'
";

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=personasbuscadas.xls');

?>
<table>
  <tr>
  <td>Nombre</td>
  <td>Calle</td>
  <td>Numero</td>
  <td>Piso/Depto</td>
  <td>Localidad</td>
  <td>Provincia</td>
  <td>C&oacute;digo Postal</td>
   
  </tr>
<?php
$sqlcall = mysqli_query($link,$sqlquery);

while($data = mysqli_fetch_assoc($sqlcall)){

  echo "<tr>";
  echo "<td>".$data['nombre']."</td>";
  echo "<td>".$data['dir_calle']."</td>";
  echo "<td>".$data['dir_numero']."</td>";
  echo "<td>".$data['dir_piso_depto']."</td>";
  echo "<td>".$data['localidad']."</td>";
  echo "<td>".$data['pcia']."</td>";
  echo "<td>".$data['c_postal']."</td>";
  echo "</tr>";
  

}
echo "</table>";
?>



</table>