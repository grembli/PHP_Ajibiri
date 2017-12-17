<?php

class ControladorUsuario {

    public function registrar() {
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $usuario = new Usuario();
            if(!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['apellidos'])){
                $usuario->setEmail($_POST['email']);//No hace falta limpiar ya que estan en los sets 
                $usuario->setPassword(sha1($_POST['password']));
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellidos($_POST['apellidos']);
                $usuario->setProvincia($_POST['provincia']);
                $usuario->setTelefono($_POST['telefono']);
                    
                $usuario->copiar_foto_disco($_FILES['foto']['tmp_name'],$_FILES['foto']['name']);
                
                $usuario->setCod_cookie(sha1(time()+rand()));
                IF($usuario->insertar())//Se añande a la BBDD
                {
                    Utils::guardar_mensaje("Usuario creado");
                }else{
                    Utils::guardar_mensaje("Error al guardar el usuario");
                }
                header("location:".RUTA);
            }else{
                Utils::guardar_mensaje("Debes rellenar los campos obligatorios");
                header("location:".RUTA);
            }
        }else{
                //Mostrar la vista dregistrar.php
            require '../app/vistas/registrar.php';
            }
        
    }
        
    

    public function login() {
        //Recogemos los datos por post
        $email = Utils::limpiar_texto($_POST['email']);
        $password = Utils::limpiar_texto($_POST['password']);
        $password_cod = sha1($password);
        $usuario = new Usuario();
        if ($usuario->obtener_por_email($email)) {
               
            if ($password_cod == $usuario->getPassword()) {
                //Usuario correcto iniciar sesaion
                Sesion::iniciar($usuario);
                 Utils::guardar_mensaje("Email correcto");
               
            } else {
                //Usuario incorrecto
                Utils::guardar_mensaje("Contraseña incorrecta");
            }
        }else{
            Utils::guardar_mensaje("No existe ese email");
        }
        header("location: ".RUTA);
    }

    public function logout() {
        Sesion::cerrar();
        Utils::guardar_mensaje("Se ha cerrado la sesion.");
        header("location: ".RUTA);
    }

    public function comprobar_email(){
        $email = Utils::limpiar_texto($_GET['email']);
        if($usuario->obtener_usuario($email))
        {
            echo "existe";
        }
        else
        {
            echo "noexiste";
        }

            sleep(1);
    }
    
     public function cambiar_foto() {
        $nombre_temporal = $_FILES['foto']['tmp_name'];
        $nombre_original = Utils::limpiar_texto($_FILES['foto']['name']);
        $usuario = Sesion::obtener();
        //Copia la foto al disco y actualiza la propiedad foto
        $usuario->copiar_foto_disco($nombre_temporal, $nombre_original);
        //Actualiza el usuario en la BD
        $usuario->actualizar();
        //Actualizamos el objeto guardado en la sesión
        Sesion::actualizar($usuario);
        
        echo $usuario->getFoto();
        
    }

    
    
    /* public function obtener_provincias(){
        
        $provincias=Usuario::obtener_provincias();
         require '../app/vistas/registrar.php';
        
    }*/
}


