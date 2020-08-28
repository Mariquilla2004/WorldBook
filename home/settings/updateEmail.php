<?php
  //Require the reauthentication script.
  require("../../auth/reauthenticate/index.php");

  //Redirect to log In page if the user isn't logged in.
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();

  //Else perform the proper actions.
  } else {

    //Only proceed if the email provided is linked to another account already.
    if(check_email($_POST['email']) < 1){

      //Get the PDO connection and prepare the query.
      $pdo = getConn();
      $query= 'UPDATE wb_users
                SET email= ?
                WHERE uid= ?';

      $stmt = $pdo->prepare($query);

      //Execute the query, and update the email session to match the updated email.
      $stmt->execute([$_POST['email'], $_SESSION['uid']]);
      $_SESSION['email'] = $_POST['email'];

      //On success, redirect back to settings and display a success message.
      header('Location: /home/settings?success=email_updated');

    //Return error in case of email already registered.
    } else {
      header('Location: /home/settings?error=email_already_registered');
    }
  }

  //Is this email already registered in our db? check_email()!
  function check_email($email){
    $query= 'SELECT COUNT(*) FROM wb_users WHERE email= ? AND uid != ?';
    $pdo = getConn();
    $stmt= $pdo->prepare($query);
    $stmt->execute([$email, $_SESSION['uid']]);
    $nRows= $stmt->fetchColumn();

    return $nRows;
  }
 ?>
