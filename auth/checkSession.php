<?php
  session_start();
  if (isset($_COOKIE['login_sessionp']) && isset($_COOKIE['login_sessione'])){
    $pdo= getConn();
    $stmt = $pdo->prepare('SELECT uid, password, name, bio, fav_book FROM wb_users WHERE email = ?');
    $stmt->execute([$_COOKIE['login_sessione']]);

    $row = $stmt->fetch();
    $rows_found = $stmt->rowCount();

    if ($rows_found > 0 && password_verify($row['password'], $_COOKIE['login_sessionp'])){

      $_SESSION['loggedin'] = true;
      $_SESSION['uid'] = $row['uid'];
      $_SESSION['email'] = $_COOKIE['login_sessione'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['bio'] = $row['bio'];
      $_SESSION['fav_book'] = $row['fav_book'];

    }
  }
 ?>
