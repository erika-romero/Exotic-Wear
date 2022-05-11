<?php
try {
    $dbhost = '167.172.224.38';
    $dbname='login';
    $dbuser = 'erika';
    $dbpass = '123321..';
    define("KEY","develoteca");
    define("COD","AES-128-ECB");

    $connection = new PDO("pgsql:host={$dbhost};port=5432;dbname={$dbname}", $dbuser, $dbpass);
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


