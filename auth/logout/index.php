<?php
session_start();

 if (isset($_SESSION['loggedin'])) {
  session_destroy();
  header('Location: /auth/logIn');
  exit();

} else {
  header('Location: /auth/logIn');
  exit();

}
 ?>
