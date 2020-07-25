<?php
session_start();

//In case the user is already logged in, redirect him/her to /home.
if (isset($_SESSION['loggedin'])){
  header('Location: /home');
  exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
       <link rel= 'stylesheet' href= 'login.css' />
       <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i" rel="stylesheet">

         <!--Bootstrap-->
         <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
         integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
         <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
         integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
         crossorigin="anonymous"></script>
   <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>

   <title> WorldBook | Login</title>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href="/"><img src="../../media/WB1.png" alt="Logo" width="45" height="45"></a>
        </div>
      </nav>
        <div class="container-fluid">
            <div class="row no-gutter">
              <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
              <div class="col-md-8 col-lg-6">
                <div class="login d-flex align-items-center py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-9 col-lg-8 mx-auto">
                        <h3 class="login-heading mb-4">Welcome back!</h3>
                        <form action='./index.php' method='POST'>
                          <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name='email'required autofocus>
                            <label for="inputEmail">Email address</label>
                            <small class= 'text text-danger' id= 'emailError'></small>
                          </div>

                          <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name='pass'required>
                            <label for="inputPassword">Password</label>
                            <small class= 'text text-danger' id= 'passError'></small>
                          </div>
                          <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                          </div>
                          <button class="btn btn-lg btn-primary btn-block text-uppercase" id="submit">Log In</button>
                          <br>
                        </form>
                          <div class="text-center">
                            <a class="small" href="passwordReset.html">Forgot password?</a>
                            <br>
                            <small class= 'text text-muted'>Don't have an account? <a href= '../signUp/'>Sign Up </a>now.</small>
                          </div>

                          <hr class= 'my-4'>
                          <div class="form-signin">
                            <div class= 'text-center'>
                              <button class="btn btn-outline-danger btn-block">
                                <div id= 'i'><i class="fab fa-google mr-2"></i></div><div id= 'g'>Sign In with Google</div>
                              </button>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--Required scripts -->
    <script src="https://kit.fontawesome.com/6838ece04b.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src= 'logIn.js'></script>
    </body>
</html>
<?php

//Require the database connection and the error handler file.
require('../../server-config/error-handler.php');
require('../../server-config/connect.php');

//Declare some variables we will be using.
$login_email = $login_password = "";

//Only execute the query when the form is submitted.
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  //Set the query that selects from the database the user we are looking for. Then prepare() it to protect our db from SQL injection.
  $query= 'SELECT uid, password, name, bio, fav_book FROM wb_users WHERE email = ?';
  $pdo= getConn();
  $stmt= $pdo->prepare($query);

  //After that, get the input values submitted by the user.
  $login_email= validate($_POST['email']);
  $login_password= validate($_POST['pass']);

  //Execute() the query!
  $stmt->execute([$login_email]);


  //Fetch rows.
  $row = $stmt->fetch();
  $rows_found = $stmt->rowCount();

  //If we get results, proceed to log the user in.
  if ($rows_found > 0) {

  //The password the user has submitted equals the one we've got from our query.
    if ($login_password == $row['password']){

      //Set some sessions to identificate the new logged user.
      $_SESSION['loggedin'] = true;
      $_SESSION['uid'] = $row['uid'];
      $_SESSION['email'] = $login_email;
      $_SESSION['name'] = $row['name'];
      $_SESSION['bio'] = $row['bio'];
      $_SESSION['fav_book'] = $row['fav_book'];

      //Good to go!
      echo "<script> window.location='/home'; </script>";
      exit();

    } else {
      //Oh, oh, wrong password!
      echo "<script> wrongPassword(); </script>";
    }

  //Otherwise, the email is wrong!
  } else {
    echo "<script> wrongEmail(); </script>";
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
