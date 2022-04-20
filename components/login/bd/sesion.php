<?php

ini_set('display_errors', '1');

include('conexion.php');


$usuario = $_POST['usuario'];
$clave   = $_POST['clave'];

$sql = "SELECT * FROM usuarios 
        WHERE Usuario    = '{$usuario}' 
        AND   Contraseña = '{$clave}'";

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

    //echo "<img src=\"https://i.ibb.co/nQxdpFM/images-q-tbn-ANd9-Gc-Q0o-TV7-Zv-E42-CVw-Rvs1s-MQMXh6-Jh5q-B3jz-M7b-JTDr-Ft-LC-i-p-KQFqll-Eg-HTp-IDZ0.jpg\" alt=\"images-q-tbn-ANd9-Gc-Q0o-TV7-Zv-E42-CVw-Rvs1s-MQMXh6-Jh5q-B3jz-M7b-JTDr-Ft-LC-i-p-KQFqll-Eg-HTp-IDZ0\" border=\"0\">"."<br>";
    return print('<h1>Ingreso no permitido<br>Usuario y/o contraseña invalido</h1>');
}



?>
