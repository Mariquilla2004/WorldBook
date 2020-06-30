<?php

error_reporting(E_ALL);

function myExceptionHandler ($e){
    error_log($e);
    http_response_code(500);

    if (ini_get('display_errors')) {
        echo $e;

    } else {
        echo "

        <!DOCTYPE html>
        <html lang= 'en'>
          <head>
            <meta charset='utf-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0, shrink-to-fit=no'>
            <link rel ='icon' type= 'image/ico' href= '/media/W-logo.png'/>
            <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700' rel='stylesheet'>
            <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
            <link rel= 'stylesheet' href= '/server-config/error-handler-style.css'>

            <title>WorldBook | Reset password</title>
          </head>
          <body>
            <header>
            <nav class='navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink' id= 'mainNav'>
              <div class='container'>
                <a class='navbar-brand js-scroll-trigger' href='/index.html'><img src='/media/WB1.png' alt='Logo' width='45' height='45'></a>
                <button class='navbar-toggler navbar-toggler-right' type='button' data-toggle='collapse' data-target='#navbarResponsive' aria-controls='navbarResponsive' aria-expanded='false' aria-label='Toggle navigation'>
                  Menu
                  <i class='fas fa-bars'></i>
                </button>
                <div class='navbar-collapse collapse w-100 order-3 dual-collapse2' id='navbarResponsive'>
                  <ul class='navbar-nav ml-auto' role= 'toolbar'>
                    <div class='nav-item nav-link'>
                        <button class='btn btn-primary' id='login'>Login</button>
                      </div>
                    <div class='nav-item nav-link'>
                      <button class='btn btn-primary' id='signup'>Sign Up</button>
                    </div>
                  </div>
              </ul>
              </div>
            </nav>
            </header>

            <div class= 'vertical-center'>
              <div class= 'container openSans'>
                <h1 class='display-4' class='poppins'>Oh, Oh, that's an error...</h1>
                <br>
                <h3 style='font-weight: 100;'> An internal server error has been ocurred :(
                  <br>
                  Please try again later.</h3>
                  <br>
                <h3 style=''> Take me <a href='/'>home</a>.</h3>
              </div>
            </div>
            <!--Footer-->
          <footer id='footer' class= 'footer'>
              <div class='container'>
                <div class='copyright'>
                  &copy; Copyright <strong>WorldBook</strong>. All Rights Reserved
                </div>
                <div class='credits'>
                  Designed by <a href='/index.html'><span style='color:#40ABF3;'>WorldBook</span></a>
                </div>
              </div>
            </footer>

            <script>
              document.getElementById('login').addEventListener('click', function(e){
                window.location = '/auth/logIn';
              });

              document.getElementById('signup').addEventListener('click', function(e){
                window.location = '/auth/signUp';
              });
            </script>
          </body>



          ";
    }
}

set_exception_handler('myExceptionHandler');

set_error_handler(function ($level, $message, $file = '', $line = 0)
{
    throw new ErrorException($message, 0, $level, $file, $line);
});

register_shutdown_function(function ()
{
    $error = error_get_last();
    if ($error !== null) {
        $e = new ErrorException(
            $error['message'], 0, $error['type'], $error['file'], $error['line']
        );
        myExceptionHandler($e);
    }
});


?>
