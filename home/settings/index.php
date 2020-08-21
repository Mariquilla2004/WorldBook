<?php
//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");

session_start();

  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
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

  <title>WorldBook | Settings</title>

  <!-- Custom styles for this template-->
  <script src="https://kit.fontawesome.com/6838ece04b.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:500|Open+Sans&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <!-- Custom styles for this template-->
  <link href= '/home/css/sb-admin-2.css' rel= 'stylesheet'>
  <link href='./settings.css' rel='stylesheet'>



  <style>
    .rectangle {
      height: 225px;
      width: 160px;
      background-color: rgb(204, 204, 204);
    }

    .fa-plus-circle{
      padding-top: 3cm;
      padding-left: 2cm;
      background-color: rgb(204, 204, 204);
      border: none;
    }
    </style>

</head>

<body id="page-top">

  <!-- Toast Container -->
  <div style="position: relative;">
    <?php display_errors(); ?>
  </div>


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">
          <a class="navbar-brand" href="/home">
          <img src="/media/W-logo.png" width="40" height="40">
        </a>

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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id= 'userName'><?php echo $_SESSION['name'];?></span>
                <img class= 'img-profile rounded-circle' src= '../../media/avatar1.jpeg'></img>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/profile">
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
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class='container-fluid'>
          <h1 class='text-center poppins black-text'>Settings</h1>

          <!-- Content Row-->
          <div class='row mt-3 openSans'>

            <!-- Navigation Column -->
            <div class='col-sm-3 align-middle'>
              <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-public-profile-list" data-toggle="list" href="#list-public-profile" role="tab" aria-controls="public-profile">Public Profile</a>
                <a class="list-group-item list-group-item-action" id="list-account-list" data-toggle="list" href="#list-account" role="tab" aria-controls="account">Account</a>
                <a class="list-group-item list-group-item-action" id="list-location-settings-list" data-toggle="list" href="#list-location-settings" role="tab" aria-controls="location-settings">Location Settings</a>
              </div>
            </div>
            <!-- End of Navigation Column -->

            <!-- Settings content -->
            <div class="col-sm-9">
              <div class="tab-content" id="nav-tabContent">

                <!-- Public Profile Tab -->
                <div class="tab-pane fade show active" id="list-public-profile" role="tabpanel" aria-labelledby="list-public-profile-list">
                  <p class='text-left font-weight-bold h4' style='color:#40abf3;'>Public Profile</p>
                  <hr class='my-4'>
                  <div class='row no-gutters mb-5'>

                    <div class="col-md-9 openSans">
                      <form action='updateProfile.php' method='post'>

                        <div class='form-group'>
                          <label for='username' class="text-14 black-text">Username</label>
                          <input type='text' id='username' class='form-control' name='username' value='<?php echo $_SESSION['name']; ?>'>
                        </div>

                        <div class="form-group">
                          <label for='fav_books' class="black-text text-14">Favourite Book(s)</label>
                          <input type='text' id='fav_books' class='form-control' name='fav_books' value='<?php if(isset($_SESSION['fav_book'])){echo $_SESSION['fav_book'];} ?>'>
                        </div>

                        <div class="form-group">
                          <label for="bio" class="text-14 black-text">Bio</label>
                          <textarea rows='3' id='bio' class='form-control' name='bio' id='bio'><?php if (isset($_SESSION['bio'])){echo $_SESSION['bio'];}?></textarea>
                        </div>

                        <div class='from-group row'>
                          <div class='col-sm-auto mr-auto'></div>
                          <div class="col-sm-auto">
                            <button id='update_profile_button' type='submit' class='btn btn-success'>Save Changes</button>
                          </div>
                        </div>

                      </form>
                    </div>

                    <div class="col-md-3">
                      <div class="container" id='profile-container'>
                        <input class='img-thumbnail rounded-circle' type="image" src='/media/avatar1.jpeg' required />
                        <input type="file" id="profile_pic" style="display: none;" />
                      </div>
                    </div>

                  </div>
                </div>
                <!-- End Public Profile Tab -->

                <!-- Account Settings Tab -->
                <div class="tab-pane fade" id="list-account" role="tabpanel" aria-labelledby="list-account-list">
                  <p class='text-left font-weight-bold h4' style='color:#40abf3;'>Your Account</p>
                  <hr>
                  <p class='mt-4 text-left font-weight-bold h5'>Update Your Email</p>
                  <form class='mt-4' method="post" action='updateEmail.php'>

                    <div class='form-group row'>
                      <label for='email' class='text-14 black-text col-sm-2 col-form-label'>Change Email</label>
                      <div class='col-sm-6'>
                        <input class='form-control' type='email' name='email' id='email' value='<?php echo $_SESSION['email']; ?>'>
                        <small class='form-text text-muted'>You'll may have to re-enter your password to verify it's you.</small>
                      </div>
                    </div>

                    <div class='from-group row'>
                      <div class='col-sm-2'></div>
                      <div class='col-sm-10'>
                        <button type='submit' class='btn btn-success'>Update Email</button>
                      </div>
                    </div>

                  </form>
                  <hr class='my-4 mr-5'>
                  <p class='mt-4 text-left font-weight-bold h5'>Change Your Password</p>
                  <form id='updatePassword' class='mt-4' method="post" action='updatePassword.php'>
                    <div class='form-group row'>
                      <label for='old_password' class='text-14 black-text col-sm-2 col-form-label'>Old Password</label>
                      <div class='col-sm-6'>
                        <input class='form-control' name='old_password' type='password' id='old_password' placeholder=''>
                        <small class='form-text text-muted'>Your old password goes here.</small>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <label for='new_password' class='text-14 black-text col-sm-2 col-form-label'>New Password</label>
                      <div class='col-sm-6'>
                        <input class='form-control' name='new_password' type='password' id='new_password' placeholder=''>
                        <small class='form-text text-muted'>Make it long!</small>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <label for='confirm_password' class='text-14 black-text col-sm-2 col-form-label'>Confirm New Password</label>
                      <div class='col-sm-6'>
                        <input class='form-control' name='confirm_password' type='password' id='confirm_password' placeholder=''>
                        <small id='passwordsMustMatch' class='text-danger'></small>
                      </div>
                    </div>
                    <div class='form-group row'>
                      <div class='col-sm-2'></div>
                      <div class='col-sm-10'>
                        <button type='submit' class='btn btn-success'>Change Password</button>
                        <span class='text-muted text-14'> Or <a href='/auth/logIn/passwordReset/'>Forgot Your Password</a>?</span>
                      </div>
                    </div>
                  </form>
                  <hr class='my-4 mr-5'>
                  <p class='my-5 text-center font-weight-bold h5'>Delete Your Account</p>
                  <div class='row mb-5'>
                    <div class='col text-center'>
                      <button class='btn btn-danger' data-toggle='modal' data-target='#deleteAccount'>Delete Account</button>
                    </div>
                  </div>
                </div>
                <!-- End of Account Settings Tab -->

                <div class="tab-pane fade" id="list-location-settings" role="tabpanel" aria-labelledby="list-location-settings-list">
                  <p class='text-left font-weight-bold h4' style='color:#40abf3;'>Your Location</p>
                  <hr>
                  <div class='text-center my-5'>
                    <p class='h3 font-weight-bold mb-5'><img class='pr-2' src='/media/tool.svg'>Under Development!</p>
                    <p class='text-center h4'>
                      Location Settings is still under development...
                      <br>
                      But we're working on it!
                    </p>
                  </div>
                  <div class='p-5'></div>
                </div>
              </div>

            </div>
            <!-- End Settings content -->
          </div>
          <!-- End Content Row -->

        </div>
        <!-- End Page Content -->

      </div>
      <!-- End of Main Content -->

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
          <a class="btn btn-primary" href='/auth/logout' style = 'color: #fff;'>Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Account Modal -->
  <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="Delete Account" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Your Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting your account cannot be undone and will permanently delete all your data.
        <br>
        If you still want to delete your WorldBook account. Click the red button below.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="button" id='deleteAccountButton' class="btn btn-danger">I understand</button>
      </div>
    </div>
  </div>
</div>

  <script>

    //Display number of notifications in Alerts Center.
    var notificationNumber='';
    $('a', '#alertsMenu').each(function () {
      ++notificationNumber;

    });
    if (notificationNumber -1 == 0){
      $('#alertsBadge').text('');
    }else{
      $('#alertsBadge').text(notificationNumber -1);
    }

    //Upload new profile img on click.
    $("input[type='image']").click(function() {
      $("input[id='profile_pic']").click();
    });

    //Check whether the password and confirm password fields match.
    $('#updatePassword').on('submit', function(e){

      //Submit if they match.
      if ($('#new_password').val() == $('#confirm_password').val()){
        return true;

      //Error if they don't.
      } else {
        e.preventDefault();
        passwordsDontMatch();
      }
    });

    //Redirect to deleteAccount.php when user click the corresponding button.
    $('#deleteAccountButton').click(function(){
      window.location = '/home/settings/deleteAccount.php';
    });

    function passwordsDontMatch(){
      $('#passwordsMustMatch').text('Password and confirm password fields must match');
    }
  </script>
  <script>

  //Get the $_GET object.
  var get = <?php echo json_encode($_GET); ?>;

  //Switch to the tab where the error/success message has been generated.
  if (get.success == 'email_updated' || get.success== 'updated_password' || get.error == 'email_already_registered' || get.error == 'incorrect_password'){
    $('#list-tab a[href="#list-account"]').tab('show');
  }
  </script>
  <script>

  $(document).ready(function(){

    getNotifications();
    getAlerts();
    setInterval(function(){getAlerts()}, 5000);
    setInterval(function(){getNotifications();}, 5000);

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
                                            '<div class="openSans400">'+
                                                decode(r_obj[i].from)+
                                              '<span class="text-14 text-success poppins">'+
                                              '(<span class="messageCounter">1</span>)</span>'+ ' '+
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

  </script>
</body>

</html>
<?php

  function display_errors(){

    //Display an error message id username error.
    if (isset($_GET['error']) && $_GET['error'] == 'username_already_exists'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error: Username is already taken. Unluky!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';
    }

    //Display an success message when updated.
    if (isset($_GET['update']) && $_GET['update'] == 'successful'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Profile updated successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';
    }

    if (isset($_GET['success']) && $_GET['success'] == 'email_updated'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Email updated successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';

    }

    if (isset($_GET['error']) && $_GET['error'] == 'email_already_registered'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error: This email is already in use.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';

    }

    if (isset($_GET['error']) && $_GET['error'] == 'incorrect_password'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Error: The old password is incorrect.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';

    }

    if (isset($_GET['success']) && $_GET['success'] == 'updated_password'){

      echo '<div style="position:absolute; right: 1rem; top: 5rem; z-index: 1000">
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Password updated successfully.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            </div>';

    }
  }
?>
