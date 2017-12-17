<?php

session_start();
/**
 * Token
 */
/*if(isset($_SESSION['token'])){
    $token = time()+ rand(); 
    $_SESSION['token']=$token;
}
else{
    $token = time()+ rand(); 
    $_SESSION['token']=$token;
}*/

/*
 * LIBRERÍAS Y CONFIGURACIÓN
 */
require_once '../app/config.php';
require_once '../app/modelos/ConexionDB.php';
require_once '../app/controladores/ControladorAnuncio.php';
require_once '../app/controladores/ControladorUsuario.php';
require_once '../app/modelos/Usuario.php';
require_once '../app/modelos/Anuncio.php';
require_once '../app/modelos/Foto.php';
require_once '../app/modelos/Utils.php';
require_once '../app/modelos/Sesion.php';


$mapa= array(
    'registrar'=>array('controlador'=>'ControladorUsuario', 'metodo'=>'registrar', 'privado'=>false),
    'login'=>array('controlador'=>'ControladorUsuario', 'metodo'=>'login', 'privado'=>false),
    'logout'=>array('controlador'=>'ControladorUsuario', 'metodo'=>'logout', 'privado'=>true),
    'insertar_anuncio'=>array('controlador'=>'ControladorAnuncio', 'metodo'=>'insertar', 'privado'=>true),
    'borrar_anuncio'=>array('controlador'=>'ControladorAnuncio', 'metodo'=>'borrar', 'privado'=>true),
    'editar_anuncio'=>array('controlador'=>'ControladorAnuncio', 'metodo'=>'editar', 'privado'=>true),
    'listar_anuncios'=>array('controlador'=>'ControladorAnuncio', 'metodo'=>'listar', 'privado'=>false),
    'ver_anuncio'=>array('controlador'=>'ControladorAnuncio', 'metodo'=>'ver', 'privado'=>false),
    'cambiar_foto'=>array('controlador'=>'ControladorUsuario', 'metodo'=>'cambiar_foto', 'privado'=>true),
    'comprobar_email'=>array('controlador'=>'ControladorUsuario', 'metodo'=>'comprobar_email', 'privado'=>false),
    
);

/*
 * ENRUTAMIENTO: RECOGEMOS LA ACCIÓN RECIBIDA POR GET COMO index.php?accion=inicio
 */
if(isset($_GET['accion']) && !empty($_GET['accion'])){ //COMPROBAMOS SI EL USUARIO HA INDICADO UNA ACCIÓN
    if(isset($mapa[$_GET['accion']])){   //COMPROBAMOS SI LA ACCIÓN ESTÁ EN EL MAPA
        $accion = $_GET['accion'];
    }
    else    //LA ACCIÓN NO ESTÁ EN EL MAPA (NO EXISTE)
    {
        header('Status: 404 Not Found');    
        echo "<html><body><h1>Error 404: No existe la ruta <i>$_GET[accion]</p></body></html>";
        exit;
    }
}
else    //NO SE HA INDICADO NINGUNA ACCIÓN, PONEMOS LA ACCIÓN POR DEFECTO
{
    $accion='listar_anuncios';
}


/*
 * EJECUTAMOS EL MÉTODO DEL CONTROLADOR ASOCIADOS A LA ACCIÓN EN EL MAPA
 */
$clase_controlador = $mapa[$accion]['controlador'];
$metodo = $mapa[$accion]['metodo'];

$obj_controlador = new $clase_controlador();
$obj_controlador->$metodo();
