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

    header("location: ingreso.php");

    //return print("Exitos lo lograste");

}
else{

    echo "<img src=\"https://i.ibb.co/nQxdpFM/images-q-tbn-ANd9-Gc-Q0o-TV7-Zv-E42-CVw-Rvs1s-MQMXh6-Jh5q-B3jz-M7b-JTDr-Ft-LC-i-p-KQFqll-Eg-HTp-IDZ0.jpg\" alt=\"images-q-tbn-ANd9-Gc-Q0o-TV7-Zv-E42-CVw-Rvs1s-MQMXh6-Jh5q-B3jz-M7b-JTDr-Ft-LC-i-p-KQFqll-Eg-HTp-IDZ0\" border=\"0\">"."<br>";
    return print('<h1>Ingreso no permitido<br>Usuario y/o contraseña invalido</h1>');
}


/*$usuario= $_POST['usuario'];
$clave= $_POST['clave'];
session_start();
$_SESSION['$usuario']=$usuario;*/

/*try {
    $dbhost = 'localhost';
    $dbname='formulario';
    $dbuser = 'erika';
    $dbpass = '123321..';

    $connection = new PDO("pgsql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    $sql = "SELECT*FROM usuarios where usuario='$usuario' and contrasena='$clave'";
    $consulta= pg_query($conexion,$query);
    $cantidad = pg_num_rows($consulta);
    if($cantidad>0){
   
        header("location: ingreso.php");
    } else {
        echo "Datos incorrectos";
    }
   
  pg_free_result($consulta);
   pg_close($conexion);

    
} catch (PDOException $e) {
    die("Error message: " . $e->getMessage());
}*/
?>
