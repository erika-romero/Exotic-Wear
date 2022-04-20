<?php
try {
    $dbhost = 'localhost';
    $dbname='exoticwear';
    $dbuser = 'root';
    $dbpass = '123321..';

    $connection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
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


