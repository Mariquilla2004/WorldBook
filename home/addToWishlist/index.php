<?php
//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
require("../../auth/checkSession.php");

//Require the connection to the database.
$pdo= getConn();

//Get the input submitted by the user, AND the user's id.
$title = validate($_POST['title']);
$author = validate($_POST['author']);
$name= $_SESSION['name'];

//Only add the book if it hasn't been added before.
if (alreadyExists($title, $author, $name) < 1){

  //Prepare and execute the query to insert the new book.
  $query='INSERT INTO wishlist (title, author, requester_id) VALUES (?, ?, ?)';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$title, $author, $name]);

  //All good! Redirect to home.
  header('Location: /home');

} else {
  echo "<script>window.location = '/home?error=book_already_registered';</script>";
}
//Does the book already exist? Let's check it.
function alreadyExists($title, $author, $name){

  $pdo= getConn();
  $query='SELECT COUNT(requester_id) FROM wishlist WHERE title= ? AND author= ? AND requester_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$title, $author, $name]);
  $nRows= $stmt->fetchColumn();

  return $nRows;
}

//Trying not to get Reflected XSS attacks...
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
