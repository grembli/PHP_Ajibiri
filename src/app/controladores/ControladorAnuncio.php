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
            $anuncio->setFotos($_POST['fotos']);
            
            if($anuncio->insertar()){
                Utils::guardar_mensaje("Anuncio Creado");
            }
            else{
                Utils::guardar_mensaje("Error al insertar anuncio");
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
            $anuncio->obtener($_POST['id']);
            print_r($anuncio);
            die();
            if($anuncio->borrar()){
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
            
            $anuncio = new Anuncio();
            $anuncio->setTitulo($_POST['titulo']);
            $anuncio->setTexto($_POST['texto']);
            $anuncio->setId_usuario(Sesion::obtener());
            
            if($anuncio->actualizar()){
                Utils::guardar_mensaje("Anuncio Editado");
            }
            else{
                Utils::guardar_mensaje("Error al editar anuncio");
            }
            header('location:'.RUTA.'listar_anuncios');
            
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
        $usuario = new Usuario();
        $id = filter_var($_GET['parametro1'],FILTER_SANITIZE_NUMBER_INT);
        $anuncio->obtener($id);
        if(Sesion::existe()){
            $usuario->obtener($anuncio->getUsuarios_id());
        }
        require '../app/vistas/ver_anuncio.php';
    }
}

