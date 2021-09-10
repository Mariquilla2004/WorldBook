<?php

//Require the connection to the database.
$pdo= getConn();

//Insert all matching books into a table named 'matches'.
$query=  'INSERT INTO matches (title, author, owner, requester)
          SELECT library.title, library.author, library.owner_id, wishlist.requester_id
          FROM library
          INNER JOIN wishlist
          ON (library.title = wishlist.title AND library.author = wishlist.author)
          ON DUPLICATE KEY UPDATE
          title = VALUES(title)';

//Prepare and execute the query.
$stmt= $pdo->prepare($query);
$stmt->execute();

//Insert all matching books into a table named 'matches'.
$query2=  'INSERT INTO matches (title, author, owner, requester)
          SELECT library.title, library.author, library.owner_id, wishlist.requester_id
          FROM wishlist
          INNER JOIN library
          ON (library.title = wishlist.title AND library.author = wishlist.author)
          ON DUPLICATE KEY UPDATE
          title = VALUES(title)';

//Prepare and execute the query.
$stmt2= $pdo->prepare($query2);
$stmt->execute();

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
