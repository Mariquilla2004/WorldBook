<?php

//Require the connection to the database.
require("../../server-config/connect.php");
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
 ?>
