<?php

ini_set('display_errors', '1');

include('conexion.php');


$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$sql = "SELECT * FROM usuarios 
        WHERE usuario    = '{$usuario}' 
        AND   contrasena = '{$clave}'";

//echo $sql;die();

foreach ($connection->query($sql) as $value) {
    
    $userBd = $value['usuario'];
    $pwdBD  = $value['contrasena'];
}


if(isset($userBd) && isset($pwdBD)){

    //header("location: login.html");

    return print("Exitos lo lograste");

}
else{

    
    return print('<h1>Ingreso no permitido<br>Usuario y/o contraseña invalido</h1>');
}



?>
