<?php
try {
    //$dbhost = '167.172.224.38';
    $dbhost = 'localhost';
    $dbname='login';
    $dbuser = 'romero';
    $dbpass = '123321..';
    define("KEY","develoteca");
    define("COD","AES-128-ECB");

    $connection = new PDO("mysql:host={$dbhost};port=3306;dbname={$dbname}", $dbuser, $dbpass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    return $connection;
    //$sql = 'SELECT * FROM students';

    //foreach ($connection->query($sql) as $row) {
      //  var_dump($row);
    //}

    //$connection = null;
} catch (PDOException $e) {
    die("Error message: " . $e->getMessage());
}

?> 


