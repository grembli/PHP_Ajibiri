<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ajibiri</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="<?=RUTA?>web/js/alertifyjs/css/alertify.min.css" rel="stylesheet" type="text/css">
   <script type="text/javascript" src="<?=RUTA?>web/js/jquery-3.2.1.min.js"></script>
   
   <!--Animaciones y las fuentes de google-->
   <script src="<?=RUTA?>web/js/wow.min.js"></script>
   <link rel="stylesheet" href="<?=RUTA?>web/css/animate.css">
  <script type="text/javascript" src="<?=RUTA?>web/js/alertifyjs/alertify.min.js"></script>
  <link href="<?=RUTA?>web/css/estilos.css" rel="stylesheet" type="text/css">
  <style>
       .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
  </style>
  <!--Scripts de ajax-->
    <script>
        $(document).ready(function(){
            $('#foto_usuario').click(function(){
                    $('#input_foto').click();
                });
                $('#input_foto').change(function(){
                    
                    var formData = new FormData($("#formulario_foto")[0]);
                    $.ajax({
                        url:"<?=RUTA?>cambiar_foto",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(respuesta)
                        {
                            //alert(respuesta);
                            //Cambiamos la foto del usuario mediante js
                            $('#foto_usuario').attr('src','<?=RUTA?>web/imagenes/'+respuesta);
                        }
                    });
                });
                });
    </script>
</head>
<body>
<!--HEADER-->
 
<nav class="navbar navbar-inverse" style="color:whitesmoke">
  <div class="container-fluid colores">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>	
    </div>
        <?php if(Sesion::existe()):?>
    <div class="collapse navbar-collapse colores" id="myNavbar">
      <ul class="nav navbar-nav">
          <li> <img src="<?=RUTA?>web/imagenes/<?= Sesion::obtener()->getFoto() ?>" id="foto_usuario" style="cursor: pointer;">
               <form action="<?=RUTA?>cambiar_foto" enctype="multipart/form-data" id="formulario_foto" style="display: none" method="post">
                <input type="file" name="foto" id="input_foto" >
                <input type="text" name="direccion_actual" value="<?= $_SERVER['REQUEST_URI']  ?>">
            </form>
                 <?= Sesion::obtener()->getNombre()?>&numsp;<?= Sesion::obtener()->getApellidos()?></li>
        <li><a href="<?=RUTA?>listar_anuncios">Listado de anuncios</a></li>
        <li><a href="#">Mis anuncios</a></li>
        <li><a href="#">Poner un anuncio</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a href="<?=RUTA?>logout"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesion</a></li>
      </ul>
    </div>
         <?php  else: ?>
    <div class="collapse navbar-collapse" id="myNavbar"> 
 
      <ul class="nav navbar-nav">
          <li><img src="<?=RUTA?>web/imagenes/chiquito1.png" style="height: 50px; margin-left: 0px;" id="foto_inicio"/></li>
        <li><a href="<?=RUTA?>listar_anuncios">Inicio</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><form id="login" action="<?=RUTA?>login" method="post" class="formulario_index">
                 
                  <input type="email" name="email" placeholder="email" style="color:black">
                      <input type="password" name="password" placeholder="****" style="color:black">
                     <input type="submit" value="Iniciar" class="boton">
              
              </form></li> 
		<li><a href="<?=RUTA?>registrar"><span></span> Registrar</a></li>
      </ul>
    </div>
   <?php  endif;?> 
      
      
  </div>
</nav>

<div class="jumbotron nombre_pagina">
  <div class="container text-center">
      <?php Utils::mostrar_mensaje()?>
      <h1>Ajibiri</h1>
  </div>
</div>




  
   <!--LISTAR IMAGENES--> 
<div class="container-fluid bg-3 text-center">    
   <?= $contenido_vista;
                    ?>
</div><br>






</body>
</html>

