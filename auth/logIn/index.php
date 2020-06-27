<?php
session_start();

//In case the user is already logged in, redirect him/her to /home.
if ($_SESSION['loggedin']){
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
                        <form action='login-with-email.php' method='post'>
                          <div class="form-label-group">
                            <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name='LOGIN_EMAIL'required autofocus>
                            <label for="inputEmail">Email address</label>
                            <small class= 'text text-danger' id= 'emError'></small>
                          </div>

                          <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name='LOGIN_PASSWORD'required>
                            <label for="inputPassword">Password</label>
                            <small class= 'text text-danger' id= 'passError'></small>
                          </div>
                          <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                          </div>
                          <button class="btn btn-lg btn-primary btn-block text-uppercase" id="submit">Sign in</button>
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
                              <a class="btn btn-outline-danger btn-block" onclick= 'googleSignIn()'>
                                <div id= 'i'><i class="fab fa-google mr-2"></i></div><div id= 'g'>Sign In with Google</div></a>
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
