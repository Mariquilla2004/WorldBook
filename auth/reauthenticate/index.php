<?php

//Require the database connection and the error handler file.
require('../../server-config/error-handler.php');
require('../../server-config/connect.php');
session_start();

//In case the user is already logged in, redirect him/her to /home.
if (!isset($_SESSION['loggedin'])){
  header('Location: /auth/logIn');
  exit();
}
 ?>


<!DOCTYPE html>
<html lang="en" class='h-100'>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>WorldBook | Reauthenticate</title>

  <!-- Include bootstrap through CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body class='h-100'>

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

      <div class="topbar-divider d-none d-sm-block"></div>

      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small" id= 'userName'><?php echo $_SESSION['name'];?></span>
          <img class= 'img-fluid rounded-circle' style='width: 2rem;' src= '../../media/avatar1.jpeg'></img>
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="/home/profile">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
          </a>
          <a class="dropdown-item" href="">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </a>
        </div>
      </li>

    </ul>

  </nav>
<div class="container h-75">
  <div class="row h-100 justify-content-center align-items-center">
    <div class='card'>
      <div class='card-header'>Reauthentication For <?php echo $_SESSION['name']; ?></div>
      <div class='card-body'>
        <div class='card-title'>Please re-enter your password to continue</div>
        <form class="" method='post' action=''>
          <div class="form-group">
            <label for="password">Your Password</label>
            <input type="password" name='password' class="form-control" id="password" placeholder="Enter Your Password Here">
          </div>
          <div class='form-group'>
            <button type='submit' class='btn btn-success'>Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>



<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //Set the query that selects from the database the user we are looking for. Then prepare() it to protect our db from SQL injection.
    $query= 'SELECT password FROM wb_users WHERE uid= ?';
    $pdo= getConn();
    $stmt= $pdo->prepare($query);

    //Execute() the query!
    $stmt->execute([$_SESSION['uid']]);
    $row = $stmt->fetch();

    //If we get results, proceed to log the user in.
    if ($row['password'] == validate($_POST['password'])){
      header('Location: /home/');
      exit();
    }
  }

  //This function is intended to prevent our script from XSS and other attacks, by sanitizing the inputs. Cross your fingers!
  function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
