<script src="js/sweetalert2@10.js"></script>
<?php
include './conexion/conexion.php';
$calle = $_POST['valuestreet'];
$numerouno = $_POST['valuen1'];
$numerodos = $_POST['valuen3'];

$mayor = '';
$menor = '';
$view4 = '';

if ($numerodos<$numerouno){
                          $mayor = $numerouno;
                          $menor = $numerodos;
                          }
else{
     $mayor = $numerodos;
     $menor = $numerouno;
    }                          

$sql_table = "select * from contactos where dir_calle like '%".$calle."%' and dir_numero between '".$menor."' and '".$mayor."'";
$sql_mostrar = mysqli_query($link,$sql_table);
$sql_res = mysqli_num_rows($sql_mostrar);


if(($sql_res>0)&&($sql_res<100))
{

$view4.="<table mx-auto table table-striped table-sm ";
$view4.="<tr><td class=' mx-auto' ><a href ='excel_buscar_calles.php?data1=$calle&data2=$menor&data3=$mayor' class= 'btn btn-success btn-sm'><i class='bi bi-file-earmark-excel-fill mx-auto'> Exportar lista a Excel</i></a></td></tr>";
$view4.="<tr><td>";
$view4.="</table>";


$view4.="<table class='mx-auto table table-striped table-sm align-middle'>
<thead>
<tr id='titulo'>
	<td>NOMBRE</td>
	<td>CALLE</td>
	<td>LOCALIDAD</td>
	<td>FICHAS</td>
</tr>
</thead>
<tbody>";

$btnmodal = 0;
while ($fila = mysqli_fetch_assoc($sql_mostrar)) {

$btnmodal ++;
$btnname = 'b';
$btnname .=$btnmodal;

$view4.="<tr>
<td>".$fila['nombre']."</td>
<td>".$fila['dir_calle']."</td>
<td>".$fila['localidad']."</td>
<td>

<center><!-- Button trigger modal -->
<button type='button' id='".$btnname."' class='btn btn-primary btn-sm'>
  mostrar
</button></center>

</td>
</tr>

<script >
	$(document).ready(function () {
		$('#".$btnname."').click(function(){
      Swal.fire({
        html: `<h1>FICHA DE DATOS</h1><hr>
       <table>
      
       <tr>
       <td>NOMBRE :</td>
       <td>";
       $view4 .= $fila['nombre'];
       $view4 .="          
       </td>
       </tr>
       <tr>
       <td>DIRECCION :</td>
       <td>";
       $view4 .=$fila['dir_calle'];
       $view4 .= ' '; 
       $view4 .=$fila['dir_numero'];
       $view4 .="
       </td>
       </tr>";
       
        if ($fila['dir_piso_depto']!=''){
       
       $view4 .="   
       <tr>
       <td>PISO / DEPTO</td>
       <td>";
       $view4 .= $fila['dir_piso_depto'];
       $view4 .="</td>
       </tr>";
        }
      
       $view4 .=" 
       <td>LOCALIDAD</td><td> ";
       $view4 .= $fila['localidad'];
       $view4 .="
       </td>
       </tr>
       <tr>
       <td>PROVINCIA :</td>
       <td>";
       $view4 .= $fila['pcia'];
       $view4 .="
       </td>
       <tr>
       <td>CÓDIGO POSTAL :</td>
       <td>";
       $view4 .= $fila['c_postal'];
       $view4 .="
       </td>
       </tr>
       <tr>
       </tr>
       </table>
       <br>
       <input type='button' class='btn btn-primary btn-sm'value='Imprimir' onclick='javascript:window.print()' />
        `,
    });
		});
	});
</script>
";
$btnname = 'b';
}
$view4.="</tbody></table>";

//fin tabla visible
$view4.="</td></tr>";
$view4.="</table>";

////////////// fin incrustacion
}
if($sql_res>100){
$view4 .="La consulta devuelve mas de 100 registros. Ajuste el rango para un resultado mas acotado.";
}



echo $view4;
?>