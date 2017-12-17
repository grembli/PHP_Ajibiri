<?php ob_start(); ?>
<?php if ($anuncios != false): ?>
    <?php foreach ($anuncios as $anuncio): ?>

<div class="col-sm-3 anuncio">
            <a href="<?= RUTA ?>ver_mensaje/<?= $anuncio->getId() ?>"><p><?= $anuncio->getTitulo() ?></p></a>
            <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
        </div>

    <?php endforeach; ?>
<?php else: ?>
    <h1>No existe ningun anuncio aún.</h1>
<?php endif; ?>
<?php
$contenido_vista = ob_get_clean();

require '../app/plantillas/plantilla_bootstrap.php';
?>


