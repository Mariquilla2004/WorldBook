<?php
//Start the session.
  session_start();
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
  }

//Require the connection to the database and the error handler.
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");

 ?>
 <!DOCTYPE html>
 <html lang="en" class='h-100'>

 <head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">

   <title>WorldBook | Home</title>

   <!-- Custom fonts, js and css for this template-->
   <script src="https://kit.fontawesome.com/6838ece04b.js" crossorigin="anonymous"></script>
   <link href="https://fonts.googleapis.com/css?family=Poppins:500|Open+Sans:300,300,400&display=swap" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   <link href='chat.css' rel='stylesheet'>
   <link href= '/home/css/sb-admin-2.css' rel= 'stylesheet'>

</head>
<body class='h-100'>

  <nav class="navbar navbar-expand navbar-light bg-white topbar static-top shadow mb-3">

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
          <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
        </div>
      </li>

      <!-- Nav Item - Messages -->
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-envelope fa-fw"></i>
          <!-- Counter - Messages -->
          <span class="badge badge-danger badge-counter"></span>
        </a>
        <!-- Dropdown - Messages -->
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">
            Message Center
          </h6>
          <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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
          <a class="dropdown-item" href="profile.html">
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

  <div class='container-fluid'>
    <div class='row'>
      <div class='col-md-3'>
        <ul class='list-group list-group-flush mt-5' id='usersList'>

        </ul>
      </div>
      <div class='col-md black-text'>
        <p id='chatUser' class='h4 text-bold'><?php echo $_SESSION['ChatUserReceiver']; ?></p>
        <div id='chatMessagesWrapper' class='scrollable'>
        </div>
        <div id='sendMessage'>
            <input type='text' class='form-control' name='message' id='message'>
        </div>
      </div>
      <div class='col-md-1'>
    </div>
  </div>

  <script>

  $(document).ready(function(){

    //Fetch all users.
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'getUsers'},
      success: function(r){

        if(r != 'No Users'){
          var r_obj= JSON.parse(r);
          var i=0;
          while(r_obj.length > i){
            $('#usersList').append("<li class='list-group-item black-text h5'><a class='chatUser' href='#'>"+r_obj[i].name+"</a></li>");
            i++;
          }
        } else {
          $('#usersList').append("<b>No users...</b>");
        }
      }
    });


    //Fetch all messages in the conversation.
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'fetchChatMessages', sender: $('#chatUser').text()},
      success: function(r){

        if (r != "No Messages"){
          displayMessages(r);

        } else {
          $('#chatMessagesWrapper').html('<p class="text-center">No Messages Yet.</p>');
        }
      }
    });

    //Fetch latest messages on real time.
    setInterval(function(){loadUnreadMessages()}, 1000);

    //On message submit, send an AJAX request to the script that saves the message into the db.
    $('#message').keyup(function(e){
      if (e.which == 13){
        var message= $('#message').val();
        $('#message').val('');
        $.ajax({
          type: 'POST',
          url: 'action.php',
          data: {action: 'postMessage', message: message, receiver: $('#chatUser').text()},
          success: function(response){
            r_obj= JSON.parse(response);
            $('#chatMessagesWrapper').append("<div class='m-1 message'><p class='text-right pr-1'>" + r_obj[0].message + "</p><small class='text-muted'>"+r_obj[0].sent_at+"</small></div>");
          }
        });
      }

    });

});

  //Get unread messages.
  function loadUnreadMessages(){
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'unread', sender: $('#chatUser').text()},
      success: function(response){

        if (response != "No New Messages"){
          displayMessages(response);
          setMessagesAsRead();

        }
      }
    });
  }

  //Display messages to the user.
  function displayMessages(response){

    responseObj = JSON.parse(response);
    var i=0;
    while(i < Object.keys(responseObj).length){

      if (responseObj[i].to == '<?php echo $_SESSION['name']; ?>'){
        $('#chatMessagesWrapper').append("<div class=' m-1 message'><span class='text-left pl-1'>" + responseObj[i].message + "</span><p class='text-right text-muted'><small>"+responseObj[i].sent_at+"</small></p></div>");

      } else {
        $('#chatMessagesWrapper').append("<div class='m-1 message'><p class='text-right pr-1'>" + responseObj[i].message + "</p><small class='text-muted'>"+responseObj[i].sent_at+"</small></div>");

      }
      i++;
    }
  }

  //Set all messages as read.
  function setMessagesAsRead(){
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'setAsRead', sender: $('#chatUser').text()},
      success: function(){}
    });
  }

  //Change chat conversations when the user clicks any of the usernames in the side.
  $('#usersList').on('click', '.chatUser', function(){

    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'changeUser', user: $(this).text()},
      success: function(){
        location.reload();
      }
    });
  });
  </script>
</body>
