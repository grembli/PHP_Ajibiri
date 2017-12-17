<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utils
 *
 * @author Usuario1
 */
class Utils {
    /**
 * Guarda un mensaje en una variable de sesión que será mostrado en otra página con la función mostrar_mensaje
 * @param type $mensaje
 */
static function guardar_mensaje($mensaje) {
    $_SESSION['mensaje_flash'] = $mensaje;
}

/**
 * Muestra el mensaje guardado y lo borra
 */
static function mostrar_mensaje() {
    if (isset($_SESSION['mensaje_flash'])) {
        
           echo "<script type=\"text/javascript\">
                  alertify.set('notifier','position', 'botttom-right');
                  alertify.success('$_SESSION[mensaje_flash]');</script>";
            unset($_SESSION['mensaje_flash']);
    }
}

    static function limpiar_texto($texto) {
    $texto = trim($texto); //Quita espacios al principio y al final del texto
    $texto_limpio = htmlentities($texto); //Limpia etiquetas html
    $con = ConexionDB::conectar();
    $texto_limpio = $con->escape_string($texto_limpio);
    $con->close();
    return $texto_limpio;
    }

  static function limpiar_texto_editor($texto) {
        $texto_limpio = trim($texto);  //Quita espacios al principio y al final del texto
        $texto_limpio = htmlentities($texto_limpio);   //Limpia de etiquetas html
        $texto_limpio = str_ireplace("&lt;p&gt;", "<p>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/p&gt;", "</p>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;b&gt;", "<b>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/b&gt;", "</b>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;a&gt;", "<a>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/a&gt;", "</a>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;li&gt;", "<li>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/li&gt;", "</li>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;ul&gt;", "<ul>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/ul&gt;", "</ul>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;ol&gt;", "<ol>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/ol&gt;", "</ol>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;span&gt;", "<span>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/span&gt;", "</span>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;k&gt;", "<k>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/k&gt;", "</k>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;sup&gt;", "<sup>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/sup&gt;", "</sup>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;sub&gt;", "<sub>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;/sub&gt;", "</sub>",$texto_limpio);
        $texto_limpio = str_ireplace("&lt;hr&gt;", "<hr>",$texto_limpio);
        $con = ConexionDB::conectar();
        $texto_limpio = $con->escape_string($texto_limpio);
        $con->close();
        return $texto_limpio;
    }
}

