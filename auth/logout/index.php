<?php
session_start();

if ($_GET['home'] == 'yes' && $_SESSION['loggedin']){
  session_destroy();
  header('Location: /');
  exit();

} elseif ($_SESSION['loggedin']) {
  header('Location: /home');
  exit();

} else {
  header('Location: /auth/logIn');
  exit();

}
 ?>
