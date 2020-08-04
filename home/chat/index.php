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

          <div id='alertsContent'>
          </div>

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

  <div class='container-fluid'>
    <div class='row'>
      <div class='col-md-3'>
        <ul class='list-group list-group-flush mt-5' id='usersList'>

        </ul>
      </div>
      <div class='col-md black-text' id='chatColumn'>
        <p id='chatUser' class='h4 text-bold'><?php echo isset($_SESSION['ChatUserReceiver']) ? base64_decode($_SESSION['ChatUserReceiver']) : base64_decode($_SESSION['ChatUserReceiver']=''); ?></p>
        <div id='chatMessagesWrapper' class='scrollable'>
        </div>
        <div id='sendMessage'>
            <input type='text' class='form-control' name='message' id='message'>
        </div>
      </div>
      <div class='col-md-1'>
    </div>
  </div>

  <!--Logout Modal -->
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

  <script>

  $(document).ready(function(){

    //Fetch all users.
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'getUsers'},
      success: function(r){

        if(r != "No Users"){
          var r_obj= JSON.parse(r);
          var i=0;
          while(r_obj.length > i){
            $('#usersList').append("<li class='list-group-item black-text h5'><a class='chatUser' href='#'>"+r_obj[i]+"</a></li>");
            i++;
          }
        } else{
          $('#chatColumn').html('<p class="display-4 mt-5">You haven\' talked to anybody yet.</p><br><a href="/home">Go back</a>');
        }
      }
    });


    //Fetch all messages in the conversation.
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'fetchChatMessages', sender: '<?php echo $_SESSION['ChatUserReceiver'];?>'},
      success: function(r){

        if (r != "No Messages"){
          displayMessages(r);
          setMessagesAsRead();

        } else {
          $('#chatMessagesWrapper').html('<p class="text-center">No Messages Yet.</p>');
        }
      }
    });

    //Fetch latest messages and notifications on real time.
    getNotifications();
    getAlerts();
    setInterval(function(){loadUnreadMessages()}, 1000);
    setInterval(function(){getNotifications()}, 5000);
    setInterval(function(){getAlerts()}, 5000);


    //On message submit, send an AJAX request to the script that saves the message into the db.
    $('#message').keyup(function(e){
      if (e.which == 13){
        var message= $('#message').val();
        $('#message').val('');
        $.ajax({
          type: 'POST',
          url: 'action.php',
          data: {action: 'postMessage', message: message, receiver: '<?php echo $_SESSION['ChatUserReceiver'];?>'},
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
      data: {action: 'unread', sender: '<?php echo $_SESSION['ChatUserReceiver'];?>'},
      success: function(response){

        if (response != "No New Messages"){
          setMessagesAsRead();
          displayMessages(response);
        }
      }
    });
  }

  //Display messages to the user.
  function displayMessages(response){

    responseObj = JSON.parse(response);
    for(var i=0; i < Object.keys(responseObj).length; i++){

      if (encode(responseObj[i].to) == '<?php echo base64_encode($_SESSION['name']); ?>'){
        $('#chatMessagesWrapper').append("<div class=' m-1 message'><span class='text-left pl-1'>" + responseObj[i].message + "</span><p class='text-right text-muted'><small>"+responseObj[i].sent_at+"</small></p></div>");

      } else {
        $('#chatMessagesWrapper').append("<div class='m-1 message'><p class='text-right pr-1'>" + responseObj[i].message + "</p><small class='text-muted'>"+responseObj[i].sent_at+"</small></div>");

      }
    }
  }

  //Set all messages as read.
  function setMessagesAsRead(){
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'setAsRead', sender: '<?php echo $_SESSION['ChatUserReceiver'];?>'},
      success: function(){}
    });
  }

  //Change chat conversations when the user clicks any of the usernames in the side.
  $('#usersList').on('click', '.chatUser', function(){

    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'changeUser', user: encode($(this).text())},
      success: function(){
        window.location='/home/chat';
      }
    });
  });

  $('#messagesContent').on('click', '.m', function(){
    $.ajax({
        type: 'POST',
        url: 'action.php',
        data: {action:'changeUser', user: $(this).attr('id')},
        success: function(){
          window.location='/home/chat';
        }
    });
  });

  //Get notifications from all chats.
  function getNotifications(){
    $.ajax({
      type: 'POST',
      url: 'action.php',
      data: {action: 'unread'},
      success: function(r){

        if(r != 'No New Messages'){
          r_obj = JSON.parse(r);
          $('#messagesContent').text('');
          for (var i=0; i<r_obj.length; i++){

            $('#messagesContent').append('<a class="m dropdown-item d-flex align-items-center" id="'+r_obj[i].from+'" href="#">'+
                                            '<div class="mr-3">'+
                                              '<div class="icon-circle">'+
                                                '<img class="rounded-circle img-fluid img-profile" src="/media/avatar1.jpeg">'+
                                              '</div>'+
                                            '</div>'+
                                            '<div class="small openSans400">'+
                                                decode(r_obj[i].from)+' '+
                                              '<span class="small text-gray-500 text-left">'+
                                                r_obj[i].sent_at+
                                              '</span>'+
                                              '<div class="poppins text-14">'+
                                                r_obj[i].message+
                                              '</div>'+
                                            '</div>'+
                                          '</a>');
          }

          notification('#messagesContent > a', '#messagesBadge');
        } else if(r=='No New Messages'){
          $('#messagesContent').html("<div class='dropdown-item d-flex align-items-center' href='#'><div class='text-gray-500'>No Messages</div></div>");
          notification('#messagesContent > a', '#messagesBadge');

        }
      }
    });
  }

  //Notificate stuff.
  function getAlerts(){
    $.ajax({
      type: 'POST',
      url: '/server-config/getMatches.php',
      data: {},
      success: function(r){
        $('#alertsContent').html(r);
        notification('#alertsContent > a', '#alertsBadge');
      }
    })
  }

  //Encode stuff.
  function encode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
     function toSolidBytes(match, p1) {
       return String.fromCharCode('0x' + p1);
     }));
   }

   //Decode stuff.
   function decode(str) {
     return decodeURIComponent(atob(str).split('').map(function (c) {
       return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
     }).join(''));
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
  </script>
</body>
