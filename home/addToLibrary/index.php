<?php
//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
require("../../auth/checkSession.php");

//Redirect to login if not registered.
if( !isset($_SESSION['loggedin']) ){
  header('Location: /auth/logIn');
  exit();
}

$pdo= getConn();

//Get the input submitted by the user, AND the user's id.
$title = validate($_POST['title']);
$author = validate($_POST['author']);
$name= $_SESSION['name'];

if (alreadyExists($title, $author, $name) < 1){

  //Prepare and execute the query to insert the new book.
  $query='INSERT INTO library (title, author, owner_id) VALUES (?, ?, ?)';
  $stmt= $pdo->prepare($query);

  $stmt->execute([$title, $author, $name]);

  //Success, redirect to home.
  header('Location: /home');

} else {
  echo "<script>window.location = '/home?error=book_already_registered';</script>";
}

//Does the book already exist? Let's check it.
function alreadyExists($title, $author, $name){

  //Fetch any columns having the exact same title, author, and owner than the given.
  $pdo= getConn();
  $query='SELECT COUNT(book_id) FROM library WHERE title= ? AND author= ? AND owner_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$title, $author, $name]);
  $nRows= $stmt->fetchColumn();

  //Return the result.
  return $nRows;
}

//Dear hackers, I really hope this stops some of your attacks.
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
