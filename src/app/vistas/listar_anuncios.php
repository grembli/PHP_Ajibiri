<?php ob_start(); ?>
<?php if ($anuncios != false): ?>
    <?php foreach ($anuncios as $anuncio): ?>
        <?php $fotos = $anuncio->getFotos(); ?>
        <?php if($fotos == null):?>
        <div class="col-sm-3">
            <a href="<?= RUTA ?>ver_anuncio/<?= $anuncio->getId() ?>"><p><?= $anuncio->getTitulo() ?></p></a>
        </div>
        <?php else:?>
        <div class="col-sm-3">
            <a href="<?= RUTA ?>ver_anuncio/<?= $anuncio->getId() ?>"><p><?= $anuncio->getTitulo() ?></p></a>
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
        </div>
        <?php endif;?>
    <?php endforeach; ?>
<?php else: ?>
    <h1>No existe ningun anuncio aún.</h1>
<?php endif; ?>
<?php
$contenido_vista = ob_get_clean();

require '../app/plantillas/plantilla_bootstrap.php';
?>


