<?php
//Require the db connection file and the error handler file.
require( '../../../server-config/connect.php');
require( '../../../server-config/error-handler.php');

//Let's start the session, and if the user's already logged in, redirect him/her to /home.
session_start();
if (isset($_SESSION['loggedin'])){
  header('Location: /home');
  exit();
}

//Now, save the user's input to variables.
$email= $_POST['registrationEmail'];
$password= $_POST['registrationPass'];
$username= $_POST['registrationUser'];
$uid= createRandomId();

//Create query string and prepare it with PDO.
$query= 'INSERT INTO wb_users (uid, name, email, password, created_at) VALUES (?, ?, ?, ?, CURDATE())';
$stmt = $pdo->prepare($query);

//After that, execute it, set SESSION variables, an if successfuly registered, redirect to home.
$stmt->execute([$uid, $username, $email, $password]);

  $_SESSION['loggedin'] = true;
  $_SESSION['name'] = $username;
  $_SESSION['uid'] = $uid;
  $_SESSION['email'] = $email;

  //Success! Now go home...
  header('Location: /home?newuser=yes');
  exit();


//This function creates the random id that will identificate the user on worldbook.
function createRandomId(){
  $str = uniqid(true);
  return md5($str);
}
?>
