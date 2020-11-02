<?php

  function getConn(){
    $host= 'localhost';
    $db_user= 'worldbook-server';
    $db_password= 'chocolateEsVida';
    $db_name= 'worldbook';
    $charset= 'utf8mb4';
    $port= '3306';

    $options = [
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset;port=$port";
    return new \PDO($dsn, $db_user, $db_password, $options);
  }
?>
