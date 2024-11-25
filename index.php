<?php

//Require the connection to the database and the error handler.
require( 'server-config/error-handler.php');
require("server-config/connect.php");
require("auth/checkSession.php");

//Start the session.
  if( isset($_SESSION['loggedin']) ){
    header('Location: /home');
    exit();
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="WorldBook is the biggest library in the world. Sign Up to read your favourite books completely free.">
  <meta name="author" content="WorldBook">

  <title>WorldBook</title>


  <!-- Bootstrap Core CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- Custom Fonts-->
  <script src="https://kit.fontawesome.com/6838ece04b.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:500|Open+Sans:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">


  <!-- Custom CSS -->
  <link href="style.css" rel="stylesheet">

    <script
  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
  crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>



<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="media/WB1.png" alt="Logo" width="45" height="45"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menú
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#services">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
          </li>
          <div class='btn-toolbar' role= 'toolbar'>
            <div class=" btn-group mr-2 openSans">
                <button class="btn btn-primary" onclick="window.location= 'auth/logIn/'">Login</button>
              </div>
          <div class=" btn-group mr-2 ">
              <button class="btn btn-primary" onclick="window.location= 'auth/signUp/'" type="button">Sign Up</button>
            </div>
          </div>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero WB -->
  <section id="hero">
    <div class="poppins hero-container">
      <h1>Welcome to <span style="color:#40ABF3;">WorldBooK</span></h1>
      <h2><span style="color:#40ABF3;">Reviving </span>books.</h2>
      <a href="#about" class="btn-get-started js-scroll-trigger">Discover</a>
    </div>
  </section>

  <!-- INTRO -->
  <div class= 'space4'></div>
  <div id= 'about'></div>
  <div class="container">
    <!-- Portfolio Item Row -->
    <div class="row">
      <div class="col-md-5 pt-5">
        <h1 class="poppins">The biggest <span style='color:#40abf3'>library</span> in the <span style='color:#40abf3'>world</span>.</h1>
        <br>
        <hr class= 'my-4'>
        <h5 class="openSans pt-4" style="line-height: 1.6;">Yep, you heard right. With no <span style="color:#40ABF3;">buildings</span>, the WorldBook Library is fully managed by you, our <span style="color:#40ABF3;">users.</span></h5>
      </div>
      <div class="col-md-7">
        <img class="img-fluid" src="media/socialmedia.jpg" alt="">
      </div>
    </div>
    <div class= 'space4'></div>
  </div>
  </div>
  <!-- /.row -->


  <!-- Our Work -->
  <section class="page-section" id="services">
    <div class="container" id="work">
      <!-- Portfolio Item Heading -->
      <div class= 'space4'></div>
      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-7">
          <img class="img-fluid" src="media/readers-this-is-for-you.jpg" alt="">
        </div>

        <div class="col-md-5 pl-4 pt-3">
          <h1 class="my-3 poppins">Readers, this is for <span style="color:#40abf3;">you.</span></h1>
          <br>
          <hr class= 'my-4'>
          <h5 class= 'openSans pt-4'>For those who love reading as much as we do. WorldBook can't wait to connect you with your favourite books, and in the process, with the best people you'll ever meet!</h5>
          <br>
        </div>
      </div>
      <div class= 'container p-5'></div>
      <div class= 'container text-center'>

          <h1 class="mb-5 poppins"><span style="color:#40ABF3;">Okay</span>, but how does it work?</h1>
          <ul class= 'mr-5 list-group list-group-flush text-left openSans'>
            <li class= 'list-group-item'><h5>Pick a book.</h5></li>
            <li class= 'list-group-item'><h5>Add it to your WorldBook library.</h5></li>
            <li class= 'list-group-item'><h5>Share your books on the biggest self-managed library in the world.</h5></li>
            <li class= 'list-group-item' ><h5>We'll notify you when there are books near you!</h5></li>
            <li class= 'list-group-item'><h5>Talk to their owners, and they will lend it to you for free!</h5></li>
            <li class= 'list-group-item'><h5>Discuss your favourite books in public forums all over the world.</h5></li>
          </ul>

      </div>
    </div>

    <div class= 'container p-5'></div>
    <!--Servicios-->
  </section>
  <section id= 'atYourService'>
    <div class= 'space4'></div>
    <div class="container">
      <h1 class="text-center mt-0 poppins">At Your Service</h1>
      <hr class="divider my-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-book-open mb-4"style="color: #00b159;" ></i>
            <h3 class="h4 mb-2 poppins">For readers, by readers</h3>
            <p class="text-muted mb-0 openSans">WorldBook is an open <span style="color: #40ABF3;">comunity</span>, in which <span style="color: #40ABF3;">we</span> also participate!</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-shapes mb-4"style="color:#ffc425;" ></i>
            <h3 class="h4 mb-2 poppins">Especially designed for you</h3>
            <p class="text-muted mb-0 openSans">WorldBook's design was <span style="color: #40ABF3;">optimized</span> to give you the <span style="color: #40ABF3;">best</span> experience.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-globe-europe mb-4" style="color: #40ABF3;"></i>
            <h3 class="h4 mb-2 poppins">Connecting people</h3>
            <p class="text-muted mb-0 openSans">At WorldBook, you'll meet <span style="color: #40ABF3;">awesome</span> people with awesome <span style="color: #40ABF3;">books</span>.</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 text-center">
          <div class="mt-5">
            <i class="fas fa-4x fa-heart text-danger mb-4"></i>
            <h3 class="h4 mb-2 poppins">Made with Love</h3>
            <p class="text-muted mb-0 openSans">Love is our greatest <span style="color: #40ABF3;">weapon</span>, the WorldBook community our <span style="color: #40ABF3;">target</span>!</p>
            <br>
            <br>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class= 'p-5'></div>
  </section>



  <!-- Callout -->
  <section class="callout">
    <div class="container text-center">
      <h1 class="mx-auto mb-5 openSans600"><span style="color:#ffff;">Wanna be part of it?</span></h1>
      <a class="btn btn-primary btn-lg openSans400" href="auth/signUp/">Sign Up</a>&nbsp;&nbsp;
      <a class="btn btn-primary btn-lg openSans400" href="auth/logIn/">Login</a>
    </div>
  </section>

  <section class="bg-light page-section" id="team">
    <div class= 'pt-3'></div>
    <div class="container">
      <div class="row">
        <br>
        <br>
        <br>
        <div class="col-lg-12 text-center">
          <br>
          <br>
          <br>
          <br>
          <h1 class=" my-4 poppins">Our <span style="color:#40ABF3;">Amazing</span> Team</h1>
          <br>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="media/maria7.jpeg" alt="">
            <h4 class="poppins">María Varela</h4>
            <p class="text-muted openSans">Web Developer & CEO</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <!-- Add icon library -->
                <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <a href="https://www.facebook.com/mvarelacaraballo" class="fa fa-facebook" target='blank'></a>
              </li>
              <li class="list-inline-item">
                <a href="https://twitter.com/Mara88280380" class="fa fa-twitter" target="blank"></a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.instagram.com/mariavarela04/" class="fa fa-instagram" target="blank"></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="team-member">
            <img class="mx-auto rounded-circle" src="media/demi3.jpeg" alt="">
            <h4 class="poppins">Álvaro De Miguel</h4>
            <p class="text-muted openSans">Web Developer & CEO</p>
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <!-- Add icon library -->
                <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                <a href="https://www.facebook.com/alvaro.demiguel.1420" class="fa fa-facebook" target='blank'></a>
              </li>
              <li class="list-inline-item">
                <a href="https://twitter.com/_alvarodemiguel" class="fa fa-twitter" target='blank'></a>
              </li>
              <li class="list-inline-item">
                <a href="https://www.instagram.com/alvarodemiguel3" class="fa fa-instagram" target='blank'></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    <div class= 'space4'></div>
  </section>

  <!-- /.container -->


  <!-- Portfolio -->
  <section class="content-section" id="portfolio">
    <div class="container">
      <div class="content-section-heading text-center">
        <h3 class="text-secondary mb-0 openSans">Gallery</h3>
        <h2 class="mb-5 poppins">Photos From Our <span style="color:#40ABF3;">Readers</span></h2>
      </div>
          <div class="row no-gutters">
        <div class="col-lg-6">
          <a class="portfolio-item">
            <span class="caption">
              <span class="caption-content">
                <h2 class="poppins">Just Read</h2>
                <p class="mb-0 openSans">Enjoying a good book!</p>
              </span>
            </span>
            <img class="img-fluid" src="media/IMG_2724.jpg" alt="">
          </a>
        </div>
        <div class="col-lg-6">
          <a class="portfolio-item">
            <span class="caption">
              <span class="caption-content">
                <h2 class="poppins">Books</h2>
                <p class="mb-0 openSans">Too much work, I need a lot more time to read!</p>
              </span>
            </span>
            <img class="img-fluid" src="media/IMG_2733.jpg" alt="">
          </a>
        </div>
        <div class="col-lg-6">
          <a class="portfolio-item">
            <span class="caption">
              <span class="caption-content">
                <h2 class="poppins">Down Face</h2>
                <p class="mb-0 openSans">I can't find the perfect posture</p>
              </span>
            </span>
            <img class="img-fluid" src="media/bocaabajo.jpeg" alt="">
          </a>
        </div>
        <div class="col-lg-6">
          <a class="portfolio-item" >
            <span class="caption">
              <span class="caption-content">
                <h2 class="poppins">Babysitting</h2>
                <p class="mb-0 openSans">Wondering the best way to look after your syblings? It's story time!</p>
              </span>
            </span>
            <img class="img-fluid" src="media/niños5.jpeg">
          </a>
        </div>
    </div>
  </div>
    <br>
    <br>
  </section>

  <!--Contact Section-->
  <section id="contact">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h1 class="section-title poppins">Contact <span style="color: #40ABF3;">Us</span></h1>
        <p class="section-description openSans">Got a problem? We got you covered.</p>
      </div>
    </div>


    <div class="container wow fadeInUp mt-5">
      <div class="row justify-content-center">

        <div class="col-lg-3 col-md-4">

          <div class="info">
            <div>
              <i class="fas fa-map-marker-alt"></i>
              <p class="poppins">Virgen de Luján<br>Sevilla, 41011</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p class="poppins">admin@worldbook.es</p>
            </div>
          </div>

          <div class="social-links">
            <!-- Add icon library -->
            <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <!-- Add font awesome icons -->
            <a href="#contact" class="fa fa-facebook"></a>
            <a href="#contact" class="fa fa-twitter"></a>
            <a href="#contact" class="fa fa-instagram"></a>
            <a href="#contact" class="fa fa-linkedin"></a>
          </div>

        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form" id="contactForm">


            <div class="alert" id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>


            <form role="form" class="contactForm openSans400" id="contactForm1" action="https://formsubmit.co/admin@worldbook.es"  method="POST" >
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                  data-rule="minlen:4" data-msg="Please enter at least 4 chars" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                  data-rule="email" data-msg="Please enter a valid email" required/>
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                  data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required"
                  data-msg="Please write something for us" placeholder="Message" id="message" required></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>

      </div>

    </div>



    </div>
  </section>
  <!-- #contact -->

</main>


<!--Footer-->
<footer id="footer">
  <div class="footer-top">
    <div class="container">

    </div>
  </div>

  <div class="container openSans400">
    <div class="copyright">
      &copy; Copyright <strong>WorldBook</strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="index.html"><span style="color:#40ABF3;">WorldBook</span></a>
    </div>
  </div>
</footer>
<!-- #footer -->


<script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
  <!-- Custom scripts for this template -->
  <script src="main.js"></script>

  <!-- Nav scripts for animation -->
  <script>
    (function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 54)
        }, 1000, "easeInOutExpo");
        return false;
      }
    }
  });

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  // Activate scrollspy to add active class to navbar items on scroll
  $('body').scrollspy({
    target: '#mainNav',
    offset: 56
  });

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 100) {
      $("#mainNav").addClass("navbar-shrink");
    } else {
      $("#mainNav").removeClass("navbar-shrink");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);

  })(jQuery); // End of use strict

  </script>


</body>

</html>
