<?php 
//Indicamos que la salida no vaya al cliiente sino que se guarde en un buffer
    ob_start(); 
?>

<form action="<?=RUTA?>registrar" method="post" enctype="multipart/form-data" id="formulario_registrar">
                    
                <input type="email" name="email" placeholder="Email" required class="border" id="email">
                <input type="password" name="password" placeholder="Contraseña" required class="border">
                <input type="text" name="nombre" placeholder="Nombre" required class="border">
                <input type="text" name="apellidos" placeholder="Apellidos" required class="border">
               <input type="text" name="provincia" placeholder="Provincia" required class="border">
               <!-- <select name="provincia" id="provincia" class="border">
                <option></option>
                <?php foreach ($provincias as $provincia):?>
                    <option value="<?php echo $provincia->getId()?>"><?php echo $provincia->getNombre()?></option>
                <?php endforeach; ?>
                </select>-->
                <input type="text" name="telefono" placeholder="Telefono" class="border">
                <input type="file" name="foto">
                <input type="submit" value="Insertar" class="boton_submit">
                      
            </form>

<?php 
//Obtenemos el contenido del buffer 
$contenido_vista = ob_get_clean();        
require '../app/plantillas/plantilla_bootstrap.php';        
 ?> 

