

<?php
echo 'hola';
die();
require_once 'Usuario.php';
$email = Utils::limpiar_texto($_GET['email']);
$usuario=new Usuario();
if($usuario->obtener_por_email($email)){
    echo "existe";
}else{
    echo "noexiste";
}
sleep(1);

?>

