<?php

require('../../server-config/connect.php');

$query= 'SELECT uid, password, name FROM wb_users WHERE email = ?';
$stmt= $pdo->prepare($query);

$login_email= $_POST['LOGIN_EMAIL'];
$login_password= $_POST['LOGIN_PASSWORD'];

if ($stmt->execute([$login_email])){

  $row = $stmt->fetch();

  if($login_password === $row['password']){
    session_start();

    $_SESSION['loggedin'] = true;
    $_SESSION['uid'] = $row['uid'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['name'] = $row['name'];

    header('Location: /home');

  } else {
    echo "Incorrect credentials";
  }
}

$stmt->close();
?>
