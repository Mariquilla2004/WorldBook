<?php
  //Require the database connection and the error handler file.
  require('../../server-config/error-handler.php');
  require('../../server-config/connect.php');
  require('../../auth/checkSession.php');

  //Redirect to log In page if the user isn't logged in.
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();

  //Else perform the proper actions.
  } else {

    //Only update the password if the old_password field is correct.
    if (verify_password($_SESSION['uid'], validate($_POST['old_password'])) > 0 ){

      //Get the uid, the new, and the old password.
      $new_password = validate($_POST['new_password']);
      $uid= $_SESSION['uid'];
      $old_password= $_POST['old_password'];
      //Get the db connection and declare the query.
      $pdo= getConn();
      $query= 'UPDATE wb_users SET
                password= ?
                WHERE uid=?
                AND password=?';

      //Prepare and execute the query that will update the user's password.
      $stmt= $pdo->prepare($query);
      $stmt->execute([$new_password, $uid, $old_password]);

      // Redirect to settings page on success.
      header('Location: /home/settings?success=updated_password');
      exit();

    } else {
      header('Location: /home/settings?error=incorrect_password');
      exit();
    }
  }

  //Verify if the provided password is correct.
  function verify_password($uid, $password){
    $pdo= getConn();
    $query = 'SELECT COUNT(*) FROM wb_users WHERE uid= ? AND password= ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$uid, $password]);
    $nRows= $stmt->fetchColumn();
    return $nRows;
  }

  //Prepare strings to be uploaded to a db.
  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
