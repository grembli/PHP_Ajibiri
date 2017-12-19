<?php 
//Indicamos que la salida no vaya al cliiente sino que se guarde en un buffer
    ob_start(); 
?>

        
        <h3>Registrar</h3>
        
<form action="<?=RUTA?>registrar" method="post" enctype="multipart/form-data" id="formulario_registrar">
                   <div class="separador3"></div> 
                <input type="email" name="email" placeholder="Email" required class="border" id="email">
                <input type="password" name="password" placeholder="Contraseña" required class="border">
                <input type="text" name="nombre" placeholder="Nombre" class="border">
                <input type="text" name="apellidos" placeholder="Apellidos" required class="border">
                <select name="provincia" id="provincia" class="formulario_index" style="color:black">
                            <option></option>
                            <?php $provincias= Utils::obtener_provincias(); ?>
                            <?php foreach ($provincias as $provincia): ?>
                                <option value="<?php echo $provincia['id_provincia'] ?>" style="color:black"><?php echo $provincia['provincia'] ?></option>
                <?php endforeach; ?>
                        </select>
               
              
                <input type="text" name="telefono" placeholder="Telefono" class="border">
                <input type="file" name="foto">
                <br>
                <br>
                <input type="submit" value="Insertar" class="boton_submit">
                
                <img src="<?=RUTA?>web/imagenes/30.gif" height="20" id="preloader" style="display: none">
                      
            </form>
        <p id="texto_registro">Al registrarte, aceptas las Condiciones de Servicio y la Política de Privacidad. Otros podrán encontrarte por correo electrónico o por número de teléfono cuando sea proporcionado.</p>
        

<?php 
//Obtenemos el contenido del buffer 
$contenido_vista = ob_get_clean();        
require '../app/plantillas/plantilla_bootstrap.php';        
 ?> 

