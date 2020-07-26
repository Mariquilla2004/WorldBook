<?php
//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
session_start();

if(!isset($_SESSION['loggedin']) ){
  header('Location: /auth/logIn');
  exit();
}

//Get the db connection, prepare the query to delete the user, prepare() it with PDO, and execute it!
$pdo= getConn();
$query= 'DELETE FROM wb_users WHERE uid= ?;';
$stmt= $pdo->prepare($query);
$stmt->execute([$_SESSION['uid']]);

//On success, destroy the current session and redirect to root page.
session_destroy();
header('Location: /');
?>
