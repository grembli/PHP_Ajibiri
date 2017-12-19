<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControladorAnuncio
 *
 * @author Usuario1
 */
class ControladorAnuncio {
    public function insertar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //Insertar el mensaje en la DB
            $anuncio = new Anuncio();
            $anuncio->setTitulo($_POST['titulo']);
            $anuncio->setDescripcion(Utils::limpiar_texto_editor($_POST['texto']));
            $anuncio->setPrecio($_POST['precio']);
            $anuncio->setUsuarios_id(Sesion::obtener()->getId());
            
            
            if($anuncio->insertar()){
                Utils::guardar_mensaje("Mensaje Creado");
            }
            else{
                Utils::guardar_mensaje("Error al insertar mensajes");
            }
            header('location:'.RUTA.'listar_anuncios');
        }
        else{
            require '../app/vistas/insertar_anuncio.php';
        }
    }
    public function borrar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $anuncio = new Anuncio();
            $token = $_POST['token'];
            $anuncio->obtener($_POST['id']);
            if($anuncio->borrar($token)){
                header('location:'.RUTA);
            }
            else{
                Utils::guardar_mensaje("No se ha podido eliminar");
                header('location:'.RUTA);
            }
            
        }
    }
    public function editar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $mensaje = new Mensaje();
            $mensaje->setTitulo($_POST['titulo']);
            $mensaje->setTexto($_POST['texto']);
            $mensaje->setId_usuario(Sesion::obtener());
            
            if($mensaje->actualizar()){
                Utils::guardar_mensaje("Mensaje Editado");
            }
            else{
                Utils::guardar_mensaje("Error al editar mensajes");
            }
            header('location:'.RUTA.'listar_mensajes');
            
        }
    }
    public function listar(){
        //Obtener todos los mensajes
        $anuncios = Anuncio::obtener_todos();
        
        //Inculir la vista 
        require '../app/vistas/listar_anuncios.php';
        
    }
    public function ver(){
        $anuncio = new Anuncio();
        
        $id = filter_var($_GET['parametro1'],FILTER_SANITIZE_NUMBER_INT);
        $anuncio->obtener($id);
        $anuncio->cargar_usuario();
        
        
        require '../app/vistas/ver_anuncio.php';
    }
    public function responder(){
        $mensaje = new Mensaje();
        $mensaje->setTexto(Utils::limpiar_texto_editor($_POST['texto']));
        $mensaje->setId_mensaje_padre(filter_var($_GET['parametro1'],FILTER_SANITIZE_NUMBER_INT));
        $mensaje->setId_usuario(filter_var(Sesion::obtener()->getId()));
         if ($mensaje->insertar()) {
            Utils::guardar_mensaje("Respuesta insertada");
        } else {
            Utils::guardar_mensaje("La respuesta no se ha podido insertar");
        }

        header("location: " . RUTA ."listar_mensajes");
    }
}

