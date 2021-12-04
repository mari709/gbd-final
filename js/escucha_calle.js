function busqueda(valor){

  console.log('Datos enviados a ajax');
  console.log (valor);
  
    $.ajax({
      data:  {valor,valor}, //datos que se envian a traves de ajax
      url:   'buscar_numeracion.php', //archivo que recibe la peticion
      type:  'post', //método de envio
      beforeSend: function () {
              $("#resultado-calle").html("Procesando, espere por favor...");
      },
      success:  function (response) { //una vez que el archivo recibe el request lo procesa y lo devuelve
              $("#resultado-calle").html(response);
      }
  });
  }


  $(document).on('keyup','#input-buscar-calle', function(){
      var valor = $(this).val();
      busqueda(valor);
      $("#informe").html("");
  });

  


