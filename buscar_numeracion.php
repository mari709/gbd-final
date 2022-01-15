
<?php
session_start();
if(isset(($_SESSION['status']))){

include './conexion/conexion.php';
$first_name ="no hay nada";
$number_mayor ="";
$streetn = $_POST['valor'];//nombre de la calle

$counter = strlen($streetn);

$sql_one = "select dir_calle from contactos where dir_calle like '%".$streetn."%' limit 1";  
//$sql_one = "select dir_calle,count(*)as contador from contactos where dir_calle like '%".$streetn."%' group by dir_calle order by contador desc limit 1";
$sql_two = "select  dir_numero from contactos where dir_calle like '%".$streetn."%' order by dir_numero desc limit 1";

if (strlen($streetn)>2){

$sql_search = mysqli_query($link,$sql_one);//existe calle?
$exists = mysqli_num_rows($sql_search);
if($exists>0){

$sql_search_assoc = mysqli_fetch_assoc($sql_search);
$first_name = $sql_search_assoc['dir_calle'];// nombre común de la calle
$sql_search2 = mysqli_query($link,$sql_two);
$sql_search_assoc2 = mysqli_fetch_assoc($sql_search2);
$number_mayor = $sql_search_assoc2['dir_numero'];// altura maxima de la calle


echo "<div class='card-body'>";
            echo "<div> <b>$first_name</b></div>";
            echo '<label for="max_text_input"><span> Altura A  </span></label>';
            echo "<input class='text-left' step='100' type='number' id='max_text_input' value='0' min='0'>";

            echo "<div><label for='min_text_input'class ='texto'> Altura B </label>";
            echo "<input type='number' step='100' id='min_text_input' value='0' min='0'>";
            echo "</div>";
            echo "</div>";
?>
            <!-- echo "<input type='range' value='".$number_mayor."' name='min_range_input' step='10' min='0' max='".$number_mayor."' onchange='updTextmin(this.value);'>"; -->
            <!-- echo "<input type='range' value ='0' name='max_range_input'  min='0' max='".$number_mayor."' onchange='updTextmax(this.value);'>"; -->

            <td>
              <input type="button" class ="btn btn-primary btn-sm " href="javascript:;" onclick="realizaProceso2($('#max_text_input').val(),$('#min_text_input').val(),'<?php echo $streetn;?>');return false;" value="mostrar"/> 

<?php

echo "</td>";
echo "</tr>";
echo "</table>";

echo "
<script>
function updTextmax(val) {
        document.getElementById('max_text_input').value=val; 
      }

function updTextmin(val) {
        document.getElementById('min_text_input').value=val; 
      }
      function realizaProceso2(v1,v2,v3)
                 {
                console.log('presiono boton mostrar');
                 var values = {
                              'valuestreet':v3,
                              'valuen1':v2,
                              'valuen3':v1
                 };
                 console.log(values.valuestreet);   
                 console.log(values.valuen1);   
                 console.log(values.valuen3);

                 $.ajax({
                  data:  values, //datos que se envian a traves de ajax
                  url:   'buscar_numeracion2.php', //archivo que recibe la peticion
                  type:  'post', //método de envio
                  beforeSend: function () {
                          $('#informe').html('Procesando, espere por favor...');
                  },
                  success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                          $('#informe').html(response);
                  }
                })







                 }


</script>
";

}
else{ 
  echo "no existe calle";}

}
else

echo "<p class = 'text-center'>Ingrese mas letras por favor. Escriba el nombre completo de la calle  para obtener resultados precisos </p>";
                

                
        
}
else{
  header('Location:login.php');
}

?>