<?php

//Require the connection to the database.
require("../../server-config/connect.php");
$pdo= getConn();

//Also we'll need the session to get user ids.
session_start();

//Only add the book if it hasn't been added before.
if (alreadyExists() < 1){

  //Get the input submitted by the user, AND the user's id.
  $title = validate($_POST['title']);
  $author = validate($_POST['author']);
  $uid= $_SESSION['uid'];

  //Prepare the query to insert the new book.
  $query='INSERT INTO wishlist (title, author, requester_id) VALUES (?, ?, ?)';
  $stmt= $pdo->prepare($query);

  $stmt->execute([$title, $author, $uid]);

  //All good! Redirect to home.
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
  $query='SELECT COUNT(requester_id) FROM wishlist WHERE title= ? AND author= ? AND requester_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$title, $author, $uid]);
  $nRows= $stmt->fetchColumn();

  return $nRows;
}

//Hi, hacker, you won't do any XSS attack here.
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
