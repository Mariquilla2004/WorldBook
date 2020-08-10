<?php
//Require the connection to the database.
require("../../server-config/connect.php");
require("../../server-config/error-handler.php");
session_start();

$pdo= getConn();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)){

  switch ($_POST['action']) {

    case 'delete':

      if (isset($_SESSION['delete_title']) && isset($_SESSION['delete_author'])){

        $title= $_SESSION['delete_title'];
        $author= $_SESSION['delete_author'];
        $from= $_SESSION['delete_from'];

        if ($from === 'library'){
          $query='DELETE FROM library WHERE author= ? AND title= ? AND owner_id = ?';

        } else if ($from === 'wishlist'){
          $query='DELETE FROM wishlist WHERE author= ? AND title= ? AND requester_id = ?';

        }

        $stmt= $pdo->prepare($query);
        $stmt->execute([$author, $title, $_SESSION['name']]);

        //Unset the sessions we previously used.
        unset($_SESSION['delete_title']);
        unset($_SESSION['delete_author']);
        unset($_SESSION['delete_from']);

      } else {
        header('Location: /home');
        exit();
      }

      break;

      case 'setDelete':

      if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['from'])){
        $_SESSION['delete_author'] = base64_decode($_POST['author']);
        $_SESSION['delete_title'] = base64_decode($_POST['title']);
        $_SESSION['delete_from'] = $_POST['from'];

      } else {
        header('Location: /home');
      }

      break;
  }
}

 ?>
