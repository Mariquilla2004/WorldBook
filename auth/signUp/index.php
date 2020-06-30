<?php
session_start();

//In case the user is already logged in, redirect him/her to home.
if (isset($_SESSION['loggedin'])){
  header('Location: /home');
  exit();
}

?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
    <link rel='stylesheet' href='signUp.css' />
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title> WorldBook | Sign Up</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
          <a class="navbar-brand js-scroll-trigger" href='/'><img src="../../media/WB1.png" alt="Logo" width="45" height="45"></a>
        </div>
      </nav>
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
      <div class="col-md-8 col-lg-6">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="text-center mx-auto">
                <h2 class="login-heading mb-4" style= ''>Welcome to <span style="color:#40ABF3;">the Comunity!</span></h2>
              </div>
              <div class="col-md-9 col-lg-8 mx-auto">
                <form class="form-signin" id='signUpForm' action='' method="POST">

                  <div class="form-label-group">
                    <input type= 'text' id="inputUsername" class="form-control" placeholder="Username" name='registrationUser'required autofocus>
                    <label for="inputUsername">Username</label>
                    <small class= 'text text-danger' id= 'usernameError'></small>
                  </div>

                  <div class="form-label-group">
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name= 'registrationEmail'required>
                    <label for="inputEmail">Email address</label>
                    <small class= 'text text-danger' id= 'emError'></small>
                  </div>

                  <div class= 'row'>
                  <div class="form-label-group col">
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" name='registrationPass' required>
                    <label for="inputPassword">Password</label>
                    <small class= 'text text-danger' id= 'passError'></small>
                  </div>

                  <div class="form-label-group col">
                    <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" required>
                    <label for="inputConfirmPassword">Confirm password</label>
                    <small class= 'text text-danger' id= 'confirmPassError'></small>
                  </div>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block text-uppercase" type='submit'>Register</button>

                </form>
                  <br>
                  <div class="text-center"><small class='text text-muted'>Already have an account?
                    <a href='../logIn/'>Sign In </a>now.</small>
                  </div>

                  <hr class= 'my-4'>
                  <div class="form-signin">
                    <div class= 'text-center'>
                      <a class="btn btn-outline-danger btn-block" >
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

  <!-- Required scripts: Font Awesome and Bootstrap. -->
<script src="https://kit.fontawesome.com/6838ece04b.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <!-- Display friendly errors to the user. -->
  <script>

    //Get some DOM elements.
    var signUpForm = document.getElementById('signUpForm');
    var password = document.getElementById('inputPassword');
    var confirmPassword= document.getElementById('inputConfirmPassword');
    var confirmPassErr = document.getElementById('confirmPassError');

    //Check whether password field and confirm password field match.
    signUpForm.addEventListener('submit', function(e){
      e.preventDefault();

      //Empty all error messages.
      confirmPassErr.textContent = '';
      document.getElementById("emError").textContent ='';
      document.getElementById("usernameError").textContent= '';

      //Do the two passwords match?
      var match= password.value == confirmPassword.value;
      //If they do, submit the form.
      if (match){ this.submit(); }
      //Nope, passwords must match.
      else {
        confirmPassErr.innerHTML = 'Passwords must match';
      }

    });

    //Error! Email is already registerd.
    function emailError(){
      document.getElementById("emError").innerHTML = 'This email is already registered! Do you want to <a href="/auth/logIn">Sign In</a>?'
      return;
    }

    //Sorry, that username is already taken.
    function usernameError(){
      document.getElementById("usernameError").textContent = 'Oh oh! That username is already taken. Try again.'
      return;
    }
  </script>

</body>

</html>
<?php
//Require the db connection file and the error handler file.
require( '../../server-config/connect.php');
require( '../../server-config/error-handler.php');

//We only want to execute these lines when the user has submitted the form.
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  //Now, save the user's input to variables.
  $email= validate($_POST['registrationEmail']);
  $password= validate($_POST['registrationPass']);
  $username= validate($_POST['registrationUser']);
  $uid= createRandomId();

  //Only proceed if the given email is not yet registered.
  if (check_email($email) < 1){

    //Again we don't want users with the same username.
    if (check_username($username) < 1){

      //Congrats! You can be registered.
      //Let's create INSERT query string and prepare it with PDO.
      $pdo= getConn();
      $INSERT_query= 'INSERT INTO wb_users (uid, name, email, password, created_at) VALUES (?, ?, ?, ?, CURDATE())';
      $INSERT_stmt = $pdo->prepare($INSERT_query);

      //After that, execute it, set $_SESSION variables, an if successfuly registered, redirect to home.
      $INSERT_stmt->execute([$uid, $username, $email, $password]);

      $_SESSION['loggedin'] = true;
      $_SESSION['name'] = $username;
      $_SESSION['uid'] = $uid;
      $_SESSION['email'] = $email;

      //Success! Now go home...
      echo "<script> window.location = '/home?new=yes'; </script>";
      exit();

    } else {

      //Sorry... That username is already taken.
      echo "<script> usernameError(); </script>";
    }

  } else {

    //Come on! You are already registered!
    echo "<script> emailError(); </script>";
  }
}


//Is this email already registered in our db? check_email()!
function check_email($email){
  $query= 'SELECT COUNT(*) FROM wb_users WHERE email= ?';
  $pdo = getConn();
  $stmt= $pdo->prepare($query);
  $stmt->execute([$email]);
  $nRows= $stmt->fetchColumn();

  return $nRows;
}

//We don't want repeated usernames.
//This function will check whether the given username already exists.
function check_username($username){
  $query= 'SELECT COUNT(*) FROM wb_users WHERE name= ?';
  $pdo= getConn();
  $stmt= $pdo->prepare($query);
  $stmt->execute([$username]);
  $nRows= $stmt->fetchColumn();

  return $nRows;
}

//This function creates the random id that will identificate the user on worldbook.
function createRandomId(){
  $str = uniqid(true);
  return md5($str);
}

//This function is intended to prevent our script from XSS and other attacks, by sanitizing the inputs. Cross your fingers!
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
