<?php

/* 
 * Archivo de configuración
 */

/*
 * DATOS DE CONEXIÓN A MYSQL
 */
define('MYSQL_USER', 'root');
define('MYSQL_PASS','');
define('MYSQL_HOST','localhost');
define('MYSQL_BD','ajibiri');


/**
 * Constante con la ruta absoluta de nuestra web con URL amigable
 * Para incluir archivos en PHP seguimos asumiendo que estamos en web/index.php
 * Ahora los enlaces desde el cliente serán del tipo <a href="<?=RUTA?>ver_mensaje">,
 * Para incluir css/js/img serán con href="<?=RUTA?>/web/imagenes/foto.jpg"
 * Para redirigir desde PHP será header("location:".RUTA."ver_mensaje");
 * Los include y require no se modifican
 */
define('RUTA','/Ajibiri/');
