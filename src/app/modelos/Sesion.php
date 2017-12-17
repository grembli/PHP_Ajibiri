<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sesion
 *
 * @author Usuario1
 */
class Sesion {
        /**
     * Funcion que inicia sesion y guarda el objeto del usuairio conectado en variables de sesion
     * @param type $usuario objeto de la clase usuario del usuario que hace login
     */
    public static function iniciar($usuario){
        $_SESSION['USUARIO_LOGIN']= serialize($usuario);
    }
    /**
     * Funcion que cierra la sesion de usuario borrando su variable de sesion
     */
    public static function cerrar(){
       unset($_SESSION['USUARIO_LOGIN']);
    }
    /**
     * Comprueba si el usuario ha iniciado sesion o no
     * @return type
     */
    public static function existe(){
        return isset($_SESSION['USUARIO_LOGIN']);
    }
    /**
     * Obtiene los datos del usuario conectado
     * @return usuario objeto con los datos del usuario conectado
     */
    public static function obtener(){
        if(isset($_SESSION['USUARIO_LOGIN'])){
            
            return unserialize($_SESSION['USUARIO_LOGIN']);
        }else{
            return false;
        }
    }
    public static function actualizar($nuevo_usuario){
        $_SESSION['USUARIO_LOGIN']= serialize($nuevo_usuario);
    }
}
