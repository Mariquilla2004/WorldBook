<?php

//Redirect to login if not registered.
session_start();
if( !isset($_SESSION['loggedin']) ){
  header('Location: /auth/logIn');
  exit();
}

//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
$pdo= getConn();

//Get the input submitted by the user, AND the user's id.
$title = validate($_POST['title']);
$author = validate($_POST['author']);
$uid= $_SESSION['uid'];

if (alreadyExists() < 1){

  //Get the input submitted by the user, AND the user's id.
  $title = validate($_POST['title']);
  $author = validate($_POST['author']);
  $uid= $_SESSION['uid'];

  //Prepare the query to insert the new book.
  $query='INSERT INTO library (title, author, owner_id) VALUES (?, ?, ?)';
  $stmt= $pdo->prepare($query);

  $stmt->execute([$title, $author, $uid]);

  //Success, redirect to home.
  header('Location: /home');

} else {
  echo "<script>window.location = '/home?error=book_already_registered';</script>";
}

//Does the book already exist? Let's check it.
function alreadyExists(){

  //Get the input submitted by the user, AND the user's id.
  $title = validate($_POST['title']);
  $author = validate($_POST['author']);
  $uid= $_SESSION['uid'];

  $pdo= getConn();
  $query='SELECT COUNT(book_id) FROM library WHERE title= ? AND author= ? AND owner_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$title, $author, $uid]);
  $nRows= $stmt->fetchColumn();

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
