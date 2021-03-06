<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Usuario1
 */
class Usuario {
     private $id;
    private $email;
    private $password; 
    private $foto;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $provincia;

        function getId() {
        return $this->id;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getFoto() {
        return $this->foto;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    function obtener($id){
        $id=filter_var($id,FILTER_SANITIZE_NUMBER_INT);
        $con = ConexionDB::conectar();
        $sql="SELECT * FROM usuarios WHERE id= ?";
        //Preparamos la consulta
        if(!$consulta_preparada=$con->prepare($sql)){
            die("Error al preprarar la consulta: ".$con->error);
        }
        //Asociamos parametros
        $consulta_preparada->bind_param('i', $id);
        //Ejecutamos la consulta
        $consulta_preparada->execute();
        //Obtenemos resultado
        if(!$resultado= $consulta_preparada->get_result()){
            die("Error al preprarar la consulta: ".$con->error);
        }
        //Obtenemos un array con los datos del suario
        if($usuario_array=$resultado->fetch_assoc()){
        //Asignamos los valores obtenidos de la BD a las propiedades
        $this->setEmail($usuario_array['email']);
        $this->setFoto($usuario_array['foto']);
        $this->setPassword($usuario_array['password']);
        $this->setId($usuario_array['id']);
        $this->setNombre($usuario_array['nombre']);
        $this->setApellidos($usuario_array['apellidos']);
        $this->setTelefono($usuario_array['telefono']);
        $this->setProvincia($usuario_array['provincia']);
        $con->close();
        return true;
        }else{
            $con->close();
            return false;
        }
    }
    
     function obtener_por_email($email){
        $email=filter_var($email,FILTER_SANITIZE_EMAIL);
        $con = ConexionDB::conectar();
        $sql="SELECT * FROM usuarios WHERE email= ?";
        //Preparamos la consulta
        if(!$consulta_preparada=$con->prepare($sql)){
            die("Error al preprarar la consulta: ".$con->error);
        }
        //Asociamos parametros
        $consulta_preparada->bind_param('s', $email);
        //Ejecutamos la consulta
        $consulta_preparada->execute();
        //Obtenemos resultado
        if(!$resultado= $consulta_preparada->get_result()){
            die("Error al preprarar la consulta: ".$con->error);
        }
        //Obtenemos un array con los datos del suario
        if($usuario_array=$resultado->fetch_assoc()){
        //Asignamos los valores obtenidos de la BD a las propiedades
        $this->setEmail($usuario_array['email']);
        $this->setApellidos($usuario_array['apellidos']);
        $this->setNombre($usuario_array['nombre']);
        $this->setProvincia($usuario_array['provincia']);
        $this->setTelefono($usuario_array['telefono']);
        $this->setFoto($usuario_array['foto']);
        $this->setPassword($usuario_array['password']);
        $this->setId($usuario_array['id']);
        $con->close();
        return true;
        }else{
            $con->close();
            return false;
        }
        
    }
    
        function borrar(){
             $con = ConexionDB::conectar();
        $sql="DELETE FROM usuarios WHERE id= ?";
        //Preparamos la consulta
        if(!$consulta_preparada=$con->prepare($sql)){
            die("Error al preprarar la consulta: ".$con->error);
        }
        $id=$this->getId();
        //Asociamos parametros
        $consulta_preparada->bind_param('i', $id);
        //Ejecutamos la consulta
        $consulta_preparada->execute();
        //Obtenemos resultado
        if($consulta_preparada->affected_rows){
            $con->close();
            return true;
        }else{
            $con->close();
            return false;
        }
        //Obtenemos un array con los datos del suario
    }
        function insertar(){
        $con = ConexionDB::conectar();
        $sql="INSERT INTO usuarios (email, password, nombre, apellidos, provincia, telefono, verificado, foto) VALUES (?,?,?,?,?,?,?,?)";
        //Preparamos la consulta
        if(!$consulta_preparada=$con->prepare($sql)){
            die("Error al preprarar la consulta: ".$con->error);
        }
        $id=$this->getId();
        //Creamos variables
        $nombre= $this->getNombre();
        $provincia= $this->getProvincia();
        $apellidos= $this->getApellidos();
        $telefono=$this->getTelefono();
        $email =$this->getEmail();
        $password =$this->getPassword();
        $foto= $this->getFoto();
        $verificado=null;
        //Asociamos parametros
        $consulta_preparada->bind_param('ssssssss', $email,$password,$nombre,$apellidos,$provincia,$telefono,$verificado,$foto);
        //Ejecutamos la consulta
       if(!$resultado=$consulta_preparada->execute()){
           die("error al ejecutar consulta ". $con->error);
       }
        $this->id=$consulta_preparada->insert_id;
        
        $con->close();
        return $resultado;
    }
    

    
         function actualizar(){
        //Conectamos con la BD
        $con = ConexionDB::conectar();
        $sql= "UPDATE usuarios SET foto=? WHERE id=?";
        //Preparamos la consulta
        if(!$consulta_preparada = $con->prepare($sql))
        {
            die('Error al preparar la consulta: '.$con->error);
        }
        //Asociamos parámetros
        $nombre= $this->getNombre();
        $provincia= $this->getProvincia();
        $apellidos= $this->getApellidos();
        $telefono=$this->getTelefono();
        $email =$this->getEmail();
        $password =$this->getPassword();
        $foto= $this->getFoto();
        $verificado=null;
        $id = $this->getId();
        $consulta_preparada->bind_param('si', $foto,$id);
        //Ejecutamos la consulta
        if(!$resultado = $consulta_preparada->execute())
        {
            die("Error al ejecutar la consulta" . $con->error);
        }
        //Cerramos la conexión
        $con->close();
        
        return $resultado;
    }
    
       function copiar_foto_disco($origen,$nombre_original){
        $origen_limpio = filter_var($origen,FILTER_SANITIZE_STRING);
        //El nombre de la foto va a ser un md5 aleatorio
        $nombre_foto = md5(time()+rand());
        //Recorto la extensión
        $array = explode(".", $nombre_original);
        $extension = $array[count($array)-1];
        //Comprobamos que no existe ya un archivo con el mismo nombre
        while(file_exists("imagenes/$nombre_foto.$extension")){
            $nombre_foto = md5(time()+rand());
        }
        //Muevo el archivo de su ruta temporal a la carpeta definitiva
        
        
        //Cargo la imagen desde el disco
        
      if($extension=="jpeg"){
          
          move_uploaded_file($origen_limpio, "imagenes/$nombre_foto.$extension");
            $recurso_imagenjpeg = imagecreatefromjpeg("imagenes/$nombre_foto.$extension");
            $recurso_imagen_escaladojpeg = imagescale($recurso_imagenjpeg, 100);
            if(!imagejpeg($recurso_imagen_escaladojpeg,"imagenes/$nombre_foto.$extension")){
                Utils::guardar_mensaje("Fallo al redimensionar la imagen");
            }
 
      }else{
          if($extension=='png'){
          move_uploaded_file($origen_limpio, "imagenes/$nombre_foto.$extension");
            $recurso_imagenpng = imagecreatefrompng("imagenes/$nombre_foto.$extension");
            $recurso_imagen_escaladopng = imagescale($recurso_imagenpng, 100);
            if(!imagepng($recurso_imagen_escaladopng,"imagenes/$nombre_foto.$extension")){
                Utils::guardar_mensaje("Fallo al redimensionar la imagen");
            } 
          }else{
              Utils::guardar_mensaje("Fallo al guardar la imagen");
          }
      }
        
        $this->setFoto("$nombre_foto.$extension");
    }
    
    
    
    
    
     
    

}
