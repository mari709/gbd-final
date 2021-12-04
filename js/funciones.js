
function realizaProceso(valorCaja1, valorCaja2){
    var parametros = {
            "valorCaja1" : valorCaja1,
            "valorCaja2" : valorCaja2
    };
    console.log("Recibiendo valores");
    console.log(parametros.valorCaja1);
    console.log(parametros.valorCaja2);
    $.ajax({
            data:  parametros, //datos que se envian a traves de ajax
            url:   'procesos.php', //archivo que recibe la peticion
            type:  'post', //método de envio
            beforeSend: function () {
                    $("#resultado").html("Procesando, espere por favor...");
                    $("#card1-resultado").removeClass("d-none");
                    $('#resultado2').html("");
                    

            },
            success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
                $("#card1-resultado").removeClass("d-none");
                $('#resultado2').html("");
                $('#paso2').html("Principales calles con más contribuyentes en el rango seleccionado");
                $("#resultado").html(response);

                    

                    
            }
    });
};