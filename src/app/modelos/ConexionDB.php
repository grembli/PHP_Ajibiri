<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConexionDB
 *
 * @author Usuario1
 */
class ConexionDB {
    static function conectar()
    {
        $con = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_BD);
        
        if($con->connect_error)
        {
            die("Error al conectar con la BD" . $con->connect_error);
        }
        else
        {
            $con->set_charset("utf8");
            return $con;
        }
    }
}
