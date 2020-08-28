<?php
session_start();

 if (isset($_SESSION['loggedin'])) {
  setcookie("login_sessione", "", 1, "/");
  setcookie("login_sessionp", "", 1, "/");
  session_destroy();
  header('Location: /auth/logIn');
  exit();

} else {
  header('Location: /auth/logIn');
  exit();

}
 ?>
