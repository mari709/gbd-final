<?php 
//session_start();

include 'conexion/conexion.php';

$altura_uno = $_POST['valorCaja1'];
$altura_dos = $_POST['valorCaja2']; 
$a1 ='';
$a2 ='';

if($altura_dos < $altura_uno){ //para que corra altura_uno debe ser mas grande que altura_2
$a1 = $altura_uno;
$a2 = $altura_dos;
$altura_uno = $a2;
$altura_dos = $a1;
//$_SESSION['a1'] = "hola";

}

$position_counter = 1;
$sql ="
select counter,dir_calle,localidad from 
(select count(dir_calle)as counter, dir_calle,dir_numero,localidad from contactos
where dir_numero BETWEEN '".$altura_uno."'and '".$altura_dos."'
group by dir_calle ,localidad
ORDER BY `counter`  DESC limit 10) as cuenta
";//resolver si da 0 resultados

$sql2 ="select counter from 
(select count(dir_calle)as counter, dir_calle,dir_numero from contactos
where dir_numero BETWEEN '".$altura_uno."'and '".$altura_dos."'
group by dir_calle 
ORDER BY `counter`  DESC limit 1) as cuenta";



$hacer = mysqli_query($link,$sql);
$datacounter = mysqli_num_rows($hacer);

if($datacounter!=0){
$hacer2 = mysqli_query($link,$sql2);
$maxium_counter = mysqli_fetch_assoc($hacer2);
$rowcount = mysqli_num_rows($hacer2);
$mc_echo =  $maxium_counter['counter']; 

$view = "";

$view .="<a href ='lista-ranking-calles.php?data1=$altura_uno&data2=$altura_dos' class= 'btn btn-success btn-sm'><i class='bi bi-file-earmark-excel-fill'> Exportar lista a Excel</i></a>"; 
$view .="
<div class='pt-4 table-responsive-sm'>
<table class='table table-striped table-sm align-middle'>
        <thead class='thead-dark'>
                <tr id='titulo'>
                        <th>#</th>
                        <th>CALLE</th>
                        <th>REGISTROS</th>
                        <th>LOCALIDAD</th>
                        <th>LISTAS</th>
                </tr>
        </thead>
";
while($fila = mysqli_fetch_assoc($hacer)){

    $ppl = $fila['counter'] * 100;
    $ppl_d= $ppl / $mc_echo;
    $view .= "<tr><td>";
    $view .= $position_counter;
    $view .="</td><td>";
    $view .=$fila['dir_calle'];
    $view .="</td><td>";
    $view .= $fila['counter'];
    $view .="</td><td>";
    $view .=$fila['localidad'];
    $view .="</td><td>";
    $view .="<a class= 'btn btn-primary btn-sm' href='javascript:;' onclick='muestralista(";
    $view .='"';           
    $view .= $fila['localidad'];
    $view .='","';
    $view .= $fila['dir_calle'];
    $view .= '","';
    $view .= $altura_uno;
    $view .= '","';
    $view .= $altura_dos;
    $view .= '"';
    $view .=");return false' ><i class='bi bi-search'></i></a>";
    $view .="
            <script>
            function muestralista(p1,p2,p3,p4){
                                              var params ={
                                                           'valueone':p1,
                                                           'valuetwo':p2,
                                                           'valuetree':p3,
                                                           'valuefour':p4
                                                          };
  $.ajax({
  data:  params, //datos que se envian a traves de ajax
  url:   'personaldata.php', //archivo que recibe la peticion
  type:  'post', //método de envio
  beforeSend: function () {
          $('#resultado2').html('Procesando, espere por favor...');
  },
  success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
          $('#resultado2').html(response);
        
  }
});
}
</script>";
$view .="</td></tr>";
$position_counter ++;
}
$view .="</table>";



echo $view;
}
else
{echo "NO EXISTEN DOMICILIOS REGISTRADOS ENTRE LAS ALTURAS INGRESADAS. NO ES POSIBLE ARMAR EL RANKING.";}
?>
