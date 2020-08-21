<?php
//Start the session.
  session_start();
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
  }

//Require the connection to the database and the error handler.
require( '../server-config/error-handler.php');
require("../server-config/connect.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>WorldBook | Profile</title>

  <!-- Custom fonts, js and css for this template-->
    <script src="https://kit.fontawesome.com/6838ece04b.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:300|Open+Sans:300,300,400&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">


  <!-- Custom styles for this template-->
  <link href="/home/css/sb-admin-2.css" rel="stylesheet">
  <style>
    .poppins{
      font-family: 'Poppins', sans-serif;
    }
    .text-black{
      color: black;
    }
  </style>


</head>

<body id="page-top">

          <!-- Toast Container -->
          <div style="position: relative;">
            <div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-danger alert-dismissible fade hide" id='book_already_registered' role="alert">
                <img src='/media/alert-triangle.svg' class='mr-2'>Sorry, you can't add the same book twice!
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
              </div>
            </div>
          </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../media/WB1.png" alt="logo" width="40" height="40">
        </div>
        <div class="sidebar-brand-text mx-3">WorldBook</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-book"></i>
          <span>My Bookshelf</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fas fa-grin-stars"></i>
          <span>Friders</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fas fa-users"></i>
          <span>Forums</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <i class="fas fa-fw fa-pencil-alt"></i>
          <span>Stories</span>
        </a>
        <div id="collapsePages" class="collapse hide" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="#">Public stories</a>
            <a class= 'collapse-item' href= '#'>Drafts</a>
            <div class="dropdown-divider"></div>
            <a class="collapse-item" href="#">New draft</a>
            <a class="collapse-item" href="#">New story</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="fas fa-newspaper"></i>
          <span>News</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span id='alertsBadge' class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Alerts -->
              <div id='alertsMenu' class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>

                <!-- Notificate users about book matches. -->
                <div id='alertsContent'>
                </div>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span id='messagesBadge' class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Messages -->
              <div id='messagesMenu' class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>

                <div id='messagesContent'>
                </div>
                <a class="dropdown-item text-center small text-gray-500" href="chat">Read More messages.</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id= 'userName'><?php echo $_SESSION['name'];?></span>
                <img class= 'img-profile rounded-circle' src= '../media/avatar1.jpeg'></img>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="settings">
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
        <!-- End of Topbar -->

        <!-- Begin Page Content -->

        <div class='container text-center mt-5 poppins text-black h4'>
          404 Error. This user doesn't exist!
        </div>

      </div>
          <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; WorldBook 2019</span>
            </div>
          </div>
        </footer>
      <!-- End of Footer -->

        </div>

      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>



    <!-- **HOME MODALS** -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a href='/auth/logout?home=yes' class="btn btn-primary" style = 'color: #fff;'>Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Library Modal-->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a book to your library!</h5>
          <button type="button" id= "close" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action='./addToLibrary/index.php' method='post'>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Title:</label>
              <input type="text" class="form-control" name='title' required>
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Author:</label>
              <input type="text" class="form-control" name='author' required>
            </div>
              <button class="btn btn-primary">Add</button>
          </form>
          </div>
        </div>
        </div>
      </div>



  <!-- Wishlist Modal-->
  <div class="modal fade" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">What do you wanna read now?</h5>
            <button type="button" id= "close" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form id="wishlistForm" action="./addToWishlist/index.php" method="post">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Title:</label>
                <input type="text" class="form-control" name="title" required>
              </div>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Author:</label>
                <input type="text" class="form-control" name="author" required>
                <br>
                <button class="btn btn-primary">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>



    <!-- Delete Book Modal. -->
  <div class="modal fade" id="deleteBook">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title openSans400" style='color: #40abf3;'>Delete Book</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body openSans400">
          Are you sure you wanna delete this book?
          <br>
          You can't undo this!
        </div>

        <!-- Modal footer -->
        <div class="modal-footer openSans400">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Not really</button>
          <button type="submit"class="btn btn-danger delete">Yep</button>
        </div>

      </div>
    </div>
  </div>


      <!-- Delete Book Modal. -->
  <div class="modal fade" id="editBook">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title openSans400" style='color: #40abf3;'>Edit Book</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body openSans400">
          <p>Hey!
            <br>
            You can't edit any book (for now).
            <br>
            This is still under development so any feedback will be most appreciated!
            <br>
            Thanks for your understanding.
        </div>

        <!-- Modal footer -->
        <div class="modal-footer openSans400">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          <form action='./editBook/index.php' method='post'><button type="submit"class="btn btn-primary" disabled>Save Changes</button></form>
        </div>

      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script>
    !function(t){
    "use strict";t("#sidebarToggle, #sidebarToggleTop")
    .on("click",function(o){t("body")
    .toggleClass("sidebar-toggled"),
    t(".sidebar")
    .toggleClass("toggled"),t(".sidebar")
    .hasClass("toggled")&&t(".sidebar .collapse")
    .collapse("hide")}),
    t(window)
    .resize(function(){
        t(window).width()<768&&t(".sidebar .collapse")
        .collapse("hide")}),t("body.fixed-nav .sidebar")
        .on("mousewheel DOMMouseScroll wheel",function(o){
            if(768<t(window).width()){
                var e=o.originalEvent,l=e.wheelDelta||-e.detail;this.scrollTop+=30*(l<0?1:-1),o.preventDefault()}})
                ,t(document)
                .on("scroll",function(){
                    100<t(this).scrollTop()?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()})
                    ,t(document).on("click","a.scroll-to-top",function(o){
                        var e=t(this);t("html, body").stop().animate({
                            scrollTop:t(e.attr("href")).offset().top},1e3,"easeInOutExpo"),o.preventDefault()})}

    (jQuery);
  </script>
  <script>

  $(document).ready(function(){

    //Get the 'trash' and the 'edit' icons.
    var trash = document.getElementsByClassName('trash');
    var edit = document.getElementsByClassName('edit');
    var add = document.getElementsByClassName('add');

    //Change their color on hover.
    iconAnimate(trash, 'trash-2.svg', 'trash-2-obscure.svg');
    iconAnimate(edit, 'edit-3.svg', 'edit-3-obscure.svg');
    iconAnimate(add, 'plus.svg', 'plus-obscure.svg');

    getNotifications();
    getAlerts();
    setInterval(function(){getAlerts()}, 5000);
    setInterval(function(){getNotifications();}, 5000);

  });

    //Give color animation effect on icon hover.
    function iconAnimate(icon, original, dark){

      //Using jQuery loop through each of them.
      Array.from(icon).forEach(function(e){

        //On mouse over, change icon color to a darker one.
        e.addEventListener('mouseover', function(){
          e.setAttribute("src", '/media/' + dark);
        });

        //And on mouse out, go back to the original color.
        e.addEventListener('mouseout', function(){
          e.setAttribute("src", '/media/' + original);
        })
      });
    }

    //Display number of notifications.
    function notification(a,b){
      var notificationNumber= $(a).length;
      if (notificationNumber == 0){
        $(b).text('');
      }else{
        $(b).text(notificationNumber);
      }
    }


    function getNotifications(){
      $.ajax({
        type: 'POST',
        url: 'chat/action.php',
        data: {action: 'unread', timeOffset: -new Date().getTimezoneOffset()/60},
        success: function(r){

          if(r != 'No New Messages'){
            r_obj = JSON.parse(r);
            $('#messagesContent').text('');

            for (var i=0; i<r_obj.length; i++){
              var messageHTML = '<a class="m dropdown-item d-flex align-items-center" id="'+r_obj[i].from+'" href="#">'+
                                              '<div class="mr-3">'+
                                                '<div class="icon-circle">'+
                                                  '<img class="rounded-circle img-fluid img-profile" src="/media/avatar1.jpeg">'+
                                                '</div>'+
                                              '</div>'+
                                              '<div class="openSans400">'+
                                                  decode(r_obj[i].from)+
                                                  ' <span class="text-success poppins">(<span class="messageCounter">1</span>)</span>'+' '+
                                                '<span class="small text-gray-500 text-left">'+
                                                  r_obj[i].sent_at+
                                                '</span>'+
                                                '<div class="poppins text-14">'+
                                                  r_obj[i].message+
                                                '</div>'+
                                              '</div>'+
                                            '</a>';
              if($('.m').length == 0 || $('#'+r_obj[i].from).length == 0){

                  $('#messagesContent').append(messageHTML);
                  notification('#messagesContent > a', '#messagesBadge');

              } else if($('.m').length > 0){

                $('.m').each(function(){

                  if($(this).attr('id') == r_obj[i].from){
                    var n = +($(this).find('.messageCounter').text());
                    $(this).find('.messageCounter').text(n+1);
                  }

                });
              }
            }

          } else if(r=='No New Messages'){
          $('#messagesContent').html("<a class='dropdown-item d-flex align-items-center' href='#'><div class='text-gray-500'>No Messages</div></a>");

          }
        }

      });
    }

    $('#messagesContent').on('click', '.m', function(){
      $.ajax({
          type: 'POST',
          url: 'chat/action.php',
          data: {action:'changeUser', user: $(this).attr('id')},
          success: function(){
            window.location='chat';
          }
      });
    });

    //Notificate stuff.
    function getAlerts(){
      $.ajax({
        type: 'POST',
        url: '/server-config/getMatches.php',
        data: {timeOffset: -new Date().getTimezoneOffset()/60},
        success: function(r){
          $('#alertsContent').html(r);
          notification('#alertsContent > a', '#alertsBadge');
        }
      })
    }

    function decode(str) {
      return decodeURIComponent(atob(str).split('').map(function (c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      }).join(''));
    }

  </script>
