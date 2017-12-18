<?php ob_start(); ?>

<script src="<?= RUTA ?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.min.js" type="text/javascript"></script>
<link href="<?= RUTA ?>web/js/jQuery-TE_v.1.4.0/jquery-te-1.4.0.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
    $(document).ready(function () {
        $('textarea').jqte();
    });
</script>
<div id="insertar">
    <form id="formulario_insertar_mensaje" action="<?= RUTA ?>insertar_anuncio" method="post">
    <div id="fotos" class="col-sm-6">
        <input type="file" name="foto0">
        <input type="file" name="foto1">
        <input type="file" name="foto2">
        <input type="file" name="foto3">
        
    </div>
    <div id="formulario" class="col-sm-6">
   
        <input type="text" name="titulo" id="titulo_mensaje" placeholder="Titulo..." style="width: 80%">
        <textarea rows="15" name="texto" id="texto_mensaje" placeholder="Texto del mensaje..."></textarea>
        <input type="submit" value="Insertar">
    </div>
    </form>

</div>
<?php
$contenido_vista = ob_get_clean();

require '../app/plantillas/plantilla_bootstrap.php';
?>


