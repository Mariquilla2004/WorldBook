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

if (!isset($_GET['u'])){
  $_GET['u'] = $_SESSION['name'];
}
if (!userExists($_GET['u'])){
  header('Location: userNotFound.php');
  exit();
}

//Get the user's bio and fav_book.
$user_bio = getUsersBio($_GET['u']);
$user_fav_book = getUsersFavBook($_GET['u']);

//Check if a user exists.
function userExists($u){
  $pdo = getConn();
  $stmt= $pdo->prepare('SELECT COUNT(*) FROM wb_users WHERE name = ?');
  $stmt->execute([$u]);

  $nRows = $stmt->fetchColumn();
  return $nRows>0 ? true : false;
}

//Get User's Fav Book.
function getUsersFavBook($u){
  $pdo = getConn();
  $stmt = $pdo->prepare('SELECT fav_book FROM wb_users WHERE name = ?');
  $stmt->execute([$u]);
  return $stmt->fetch();
}

//Get User's bio.
function getUsersBio($u){
  $pdo = getConn();
  $stmt2 = $pdo->prepare('SELECT bio FROM wb_users WHERE name = ?');
  $stmt2->execute([$u]);
  return $stmt2->fetch();
}

//Fetch all books from this user, and display them as bootstrap cards.
function fetchLibrary($u){

  //Get the PDO connection.
  $pdo= getConn();

  //Now, get the books!
  $query='SELECT title, author FROM library WHERE owner_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$u]);

  //Display each of them to the user.
  while($result= $stmt->fetch(PDO::FETCH_ASSOC)){

    echo "<div>
            <div class='card bookCard'>
              <p class='card-header' id=".base64_encode($result['title']).">" . $result['title'] . "</p>
              <div class='text-right' style='margin-top: auto;' id=".base64_encode($result['author']).">
              </div>
            </div>
          </div>";
    }
}

//This will get all books in the user's whishlist.
function fetchWishlist($u){

  //Get the PDO connection.
  $pdo= getConn();

  //Select the wanted books from the db.
  $query='SELECT title, author FROM wishlist WHERE requester_id = ?';
  $stmt= $pdo->prepare($query);
  $stmt->execute([$u]);

  //Display each of them to the user.
    while($result= $stmt->fetch(PDO::FETCH_ASSOC)){

      echo "<div>
              <div class='card bookCard'>
                <p class='card-header' id=".base64_encode($result['title']).">" . $result['title'] . "</p>
                <div class='text-right' style='margin-top: auto;' id=".base64_encode($result['author']).">
                </div>
              </div>
            </div>";
    }
}

//Prevent XSS.
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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

   <!-- Custom styles for this template-->
   <script src="https://kit.fontawesome.com/6838ece04b.js" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
   <link href="/home/css/sb-admin-2.css" rel="stylesheet">
   <link href='profile.css' rel='stylesheet'>

 </head>
 <body id="page-top">

   <!-- Page Wrapper -->
   <div id="wrapper">

     <!-- Sidebar -->
     <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style= 'background-color:#40ABF3'>

       <!-- Sidebar - Brand -->
       <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
         <div class="sidebar-brand-icon rotate-n-15">
           <img src="../../media/WB1.png" alt="logo" width="40" height="40">
         </div>
         <div class="sidebar-brand-text mx-3">WorldBook</div>
       </a>

       <!-- Divider -->
       <hr class="sidebar-divider my-0">

       <!-- Nav Item - Dashboard -->
       <li class="nav-item">
         <a class="nav-link" href="/home">
           <i class="fas fa-book"></i>
           <span>My Bookshelf</span></a>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider">

       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="">
           <i class="fas fa-grin-stars"></i>
           <span>Friders</span>
         </a>
       </li>

       <!-- Divider -->
       <hr class="sidebar-divider">


       <!-- Nav Item - Pages Collapse Menu -->
       <li class="nav-item">
         <a class="nav-link collapsed" href="">
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
         <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow mb-3">

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
                 <div id='alertsContent'></div>
                 <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
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
               <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                 <h6 class="dropdown-header">
                   Message Center
                 </h6>
                 <div id='messagesContent'></div>
                 <a class="dropdown-item text-center small text-gray-500" href="/home/chat">Read More Messages</a>
               </div>
             </li>

             <div class="topbar-divider d-none d-sm-block"></div>

             <!-- Nav Item - User Information -->
             <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="mr-2 d-none d-lg-inline text-gray-600 small" id= 'userName'><?php echo $_SESSION['name']?></span>
                 <img class= 'img-profile rounded-circle' src= '../../media/avatar1.jpeg'></img>
               </a>
               <!-- Dropdown - User Information -->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="/home/profile">
                   <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                   Profile
                 </a>
                 <a class="dropdown-item" href="/home/settings">
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

        <!-- Begin of Profile -->
        <div class='row mx-5 b'>

          <div class='col-3 offset-md-1 p'>
          <img class='rounded-circle img-fluid img-profile mt-2' src='/media/avatar1.jpeg' />
        </div>
          <div class='col mt-2 p'>
            <p class='h2 text-black openSans400'><?php echo validate($_GET['u']); ?>
              <span id='messageBanner' class='messageBanner align-middle p-1 ml-4'><img src='/media/message-circle-1px.svg' /> Message</span>
            </p>
            <br>
            <p class='text-black poppins'>3 <span class='poppins300 mr-4'>Friders</span>5 <span class='poppins300'>Books in Library</span></p>
            <?php
              echo (strlen($user_fav_book['fav_book']) > 0 && strlen(trim($user_fav_book['fav_book'])) != 0) ? "<p class='text-black h6 openSans400'><b>Fav Book: </b>" . $user_fav_book['fav_book'] . ".</p>" : "";

              echo ( strlen($user_bio['bio']) > 0 && strlen(trim($user_bio['bio'])) != 0) ? "<p class='text-black h6 openSans400'>" . $user_bio['bio'] . "</p>" : "";
            ?>
            <br>
          </div>

        </div>
        <hr class='my-3 mx-5'>

        <br>
        <div class='row mx-5 mt-4'>
            <p class="col offset-md-1 h4  mb-4 text-black openSans300">
              <?php echo validate($_GET['u']); ?>'s Library
            </p>
        </div>

        <div class='row mx-5 no-gutters mh-225'>

          <div class='col-1 align-self-center'>
            <div class='prev' id='prevButton' aria-controls='customize' tabindex="-1" data-controls='prev'>
              <img src='https://ganlanyuan.github.io/tiny-slider/demo/images/angle-left.png'>
            </div>
          </div>
          <div class="col-10 align-self-center" id='libraryCarousel'>
            <div id='my-slider'>
              <?php fetchLibrary(validate($_GET['u'])); ?>
            </div>
          </div>
          <div class='col-1 align-self-center'>
            <div class='next' id='nextButton' aria-controls='customize' tabindex='-1' data-controls='next'>
              <img src='https://ganlanyuan.github.io/tiny-slider/demo/images/angle-right.png'>
            </div>
          </div>

        </div>

        <br>
        <br>
        <br>
        <br>

          <!-- Wishlist -->
        <div class='row mx-5'>
          <p class="col offset-md-1 h4  mb-4 text-black openSans300">
            <?php echo validate($_GET['u']); ?>'s Wishlist
          </p>
        </div>

        <div class='row mx-5 no-gutters mh-225'>

          <div class='col-1 align-self-center'>
            <div class='prev' id='wprevButton' aria-controls='customize' tabindex="-1" data-controls='prev'>
              <img src='https://ganlanyuan.github.io/tiny-slider/demo/images/angle-left.png'>
            </div>
          </div>
          <div class="col-10 align-self-center" id='wishlistCarousel'>
            <div id='Otherslider'>
              <?php fetchWishlist(validate($_GET['u'])); ?>
            </div>
          </div>
          <div class='col-1 align-self-center'>
            <div class='next' id='wnextButton' aria-controls='customize' tabindex='-1' data-controls='next'>
              <img src='https://ganlanyuan.github.io/tiny-slider/demo/images/angle-right.png'>
            </div>
          </div>

        </div>
        <br><br>

        <br><br>



       </div>
       <!-- End of #content -->

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
     <!-- End of Content Wrapper -->

   </div>
   <!-- End of Page Wrapper -->

   <!-- Scroll to Top Button-->
   <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
   </a>

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
           <a class="btn btn-primary" href='/auth/logout?home=yes' style = 'color: #fff;'>Logout</a>
         </div>
       </div>
     </div>
   </div>

   <script>

     $(document).ready(function(){

       getNotifications();
       getAlerts();
       setInterval(function(){getAlerts()}, 5000);
       setInterval(function(){getNotifications();}, 5000);


     });

     $('#messageBanner').click(function(){
       $.ajax({
         type: 'POST',
         url: '/home/chat/action.php',
         data: {action: 'changeUser', user: '<?php echo base64_encode(validate($_GET['u'])); ?>'},
         success: function(){
           window.location = '/home/chat';
         }
       });
     });

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
         url: '/home/chat/action.php',
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
                                               '<div class=" openSans400">'+
                                                   decode(r_obj[i].from)+' '+
                                                   '<span class="text-success poppins">(<span class="messageCounter">1</span>)</span>'+' '+
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
           url: '/home/chat/action.php',
           data: {action:'changeUser', user: $(this).attr('id')},
           success: function(){
             window.location='/home/chat';
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

     //Give color animation effect on icon hover.
     function iconAnimate(icon, original, dark){


         //On mouse over, change icon color to a darker one.
         $('#userCardRow').on('mouseover', icon, function(){
           $(this).attr("src", '/media/' + dark);
         });

         //And on mouse out, go back to the original color.
         $('#userCardRow').on('mouseout', icon, function(){
           $(this).attr("src", '/media/' + original);
         })
     }
   </script>

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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>
   <script>
   var oslider = tns({
   container: '#my-slider',
   items: 1,
   nav: false,
   prevButton: '#prevButton',
   nextButton: '#nextButton',
   responsive: {
     600: {
       items: 2,
       gutter: 2
     },
     768: {
       items: 3,
       gutter: 4
     },
     1013: {
       items: 4,
       gutter: 5
     },
     1200: {
       items: 4,
       gutter: 5
     }
   }
 });

   var slider = tns({
       container: '#Otherslider',
       items: 1,
       nav: false,
       prevButton: '#wprevButton',
       nextButton: '#wnextButton',
       responsive: {
         600: {
           items: 2,
           gutter: 2
         },
         768: {
           items: 3,
           gutter: 4
         },
         1013: {
           items: 4,
           gutter: 5
         },
         1200: {
           items: 4,
           gutter: 5
         }
       }
     });

   if ( $('#Otherslider > div').length === 0){
     $('#wprevButton').hide();
     $('#wnextButton').hide();
     $('#wishlistCarousel').append('<p class="text-center h5 openSans300"><i>There\'s nothing in <?php echo validate($_GET['u']); ?>\'s Wishlist!</i></p>')

   }

   if ( $('#my-slider > div').length === 0){
     $('#nextButton').hide();
     $('#prevButton').hide();
     $('#libraryCarousel').append('<p class="text-center h5 openSans300"><i>There\'s nothing in <?php echo validate($_GET['u']); ?>\'s Library!</i></p>');
   }
   </script>
 </body>

 </html>
