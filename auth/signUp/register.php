<?php
session_start();
if ($_SESSION['loggedin']){
  header('Location: /home');
}

//Require the file to connect to database.
require('../../server-config/connect.php');

$email= $_POST['registrationEmail'];
$password= $_POST['registrationPass'];
$username= $_POST['registrationUser'];
$uid= createRandomId();

//Create query string and perform it.
$query= 'INSERT INTO wb_users (uid, name, email, password, created_at) VALUES (?, ?, ?, ?, CURDATE())';
$stmt = $pdo->prepare($query);

//If registered, redirect to home.
if ($stmt->execute([$uid, $username, $email, $password])){

  $_SESSION['loggedin'] = true;
  $_SESSION['name'] = $username;
  $_SESSION['uid'] = $uid;
  $_SESSION['email'] = $email;

  header('Location: /home?newuser=yes');
  exit();
}

function createRandomId(){
  $str = uniqid(true);
  return md5($str);
}
?>
