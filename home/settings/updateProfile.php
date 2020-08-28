<?php
//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
require("../../auth/checkSession.php");

  //Redirect to logIn page if user's not signed in.
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
  }

  //Get all POST values.
  $new_name= validate($_POST['username']);
  $new_fav_book= validate($_POST['fav_books']);
  $new_bio= validate($_POST['bio']);
  $uid= $_SESSION['uid'];

  //Then, connection to database and prepare the UPDATE query.
  $pdo= getConn();

  if(check_username($new_name) < 1){
    $query= 'UPDATE wb_users SET
              name= ?,
              fav_book= ?,
              bio= ?
              WHERE uid= ?';
    $stmt= $pdo->prepare($query);

    //Now, execute the query.
    $stmt->execute([$new_name, $new_fav_book, $new_bio, $uid]);

    //Finally, set the new session variables.
    $_SESSION['name'] = $new_name;
    $_SESSION['fav_book'] = $new_fav_book;
    $_SESSION['bio'] = $new_bio;

    header('Location: /home/settings?update=successful');
  } else {
    header('Location: /home/settings?error=username_already_exists');
  }

  //Prepare strings to be uploaded to a db.
  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  //This function will check whether the given username already exists.
  function check_username($username){
    $query= 'SELECT COUNT(*) FROM wb_users WHERE name= ? AND uid != ?';
    $pdo= getConn();
    $stmt= $pdo->prepare($query);
    $stmt->execute([$username, $_SESSION['uid']]);
    $nRows= $stmt->fetchColumn();

    return $nRows;
  }
?>
