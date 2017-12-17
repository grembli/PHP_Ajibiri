<?php 
//Indicamos que la salida no vaya al cliiente sino que se guarde en un buffer
    ob_start(); 
?>
<script>
    $(document).ready(function(){
 $('#email').change(function(){  
                //AJAX
                $.ajax({
                    url:"<?=RUTA?>comprobar_email",
                    type:"GET",
                    data:"email="+$('#email').val(),
                    success:function(respuesta){
                        if(respuesta=="existe")
                        {
                            alert("Ya existe ese email");
                        }
                    },
                    beforeSend:function(){
                        $('#preloader').css('display','inline');
                    },
                    complete:function(){
                        $('#preloader').css('display','none');
                    }
                });
            });
             });
        </script>
<form action="<?=RUTA?>registrar" method="post" enctype="multipart/form-data" id="formulario_registrar">
                    
                <input type="email" name="email" placeholder="Email" required class="border" id="email">
                <input type="password" name="password" placeholder="Contraseña" required class="border">
                <input type="text" name="nombre" placeholder="Nombre" class="border">
                <input type="text" name="apellidos" placeholder="Apellidos" required class="border">
               <input type="text" name="provincia" placeholder="Provincia" required class="border">
              
                <input type="text" name="telefono" placeholder="Telefono" class="border">
                <input type="file" name="foto">
                <input type="submit" value="Insertar" class="boton_submit">
                      
            </form>
        <img src="<?=RUTA?>web/imagenes/30.gif" height="20" id="preloader" style="display: none">

<?php 
//Obtenemos el contenido del buffer 
$contenido_vista = ob_get_clean();        
require '../app/plantillas/plantilla_bootstrap.php';        
 ?> 

