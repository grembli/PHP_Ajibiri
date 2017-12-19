<?php

ob_start(); 
?>

<div id="anuncio">
    <?php if(Sesion::existe()/* && Sesion::obtener()->getId() == $anuncio->getUsuario_id()*/):?>
    <div id="iconos">
      
        <a href="<?=RUTA?>editar_anuncio/<?= $anuncio->getId() ?>"><span class="glyphicon glyphicon-pencil"></span> </a>
         <a href="<?=RUTA?>borrar_anuncio/<?= $anuncio->getId() ?>"><span class="glyphicon glyphicon-remove"></span> </a>
    </div>
    <?php endif;?>
    
    <div>
        <?php $fotos = $anuncio->getFotos(); ?>
        <?php if($fotos == null):?>
            <h3><?=$anuncio->getTitulo()?></h3>
            <div class="separador3"></div>
            <div>
                <p><?=$anuncio->getDescripcion()?></p>
                <p><?=$anuncio->getPrecio(); echo "€"?></p>
            </div>
            <?php if(Sesion::existe()):?>
            <div>
        
            </div>
            <?php else:?>
            <div>
                <br>
                <br>
                <h4>Debes estar registrado para poder ver mas información</h4>
            </div>
            <?php endif;?>
               
            
        <?php else:?>
          <h3><?=$anuncio->getTitulo()?></h3>
          <div class="separador3"></div>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php foreach ($fotos as $foto): ?>
                        <div class="item <?php
                        if ($foto->getPrincipal() == 1) {
                            echo "active";
                        }
                        ?>">
                             
                            <img src="<?= RUTA ?>web/imagenes/fotos/<?= $foto->getNombre(); ?>" class="img-responsive" style="width:100%" alt="Image">
                           
                            <br>
                            
                            <br>
                        </div>
           <?php endforeach; ?>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>
          
        <div>
            <p><?=$anuncio->getDescripcion()?></p>
            <p><?=$anuncio->getPrecio(); echo "€"?></p>
        </div>
        <?php if(Sesion::existe()):?>
            <div>
        
            </div>
        <?php else:?>
            <div>
                <br>
                <br>
                <h4>Debes estar registrado para poder ver mas información</h4>
            </div>
        <?php endif;?>
        
        <?php endif;?>
   
</div>




<?php
//Obtenemos el contenido del buffer y lo guardamos en $contenido_vista
$contenido_vista = ob_get_clean(); 

//Incluimos la plantilla
require '../app/plantillas/plantilla_bootstrap.php';

?>
