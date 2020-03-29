<?php 
	    require_once "functions.php";

	    if(confirmLogin()){
	    	   $salt = $_SESSION['id']; 

	    	   $name = ucwords(user($salt, 'name'));
	    	   $username = ucwords(user($salt, 'username')); 
	    	   $gender = user($salt, 'username');
	    	   $profile1 = user($salt,'profile');

	    	    if($profile1 == "" && $gender =="Male"){
    				$profilImage1 = "male.jpg";
    			} else if($profile1 == "" && $gender =="Female") {
    				$profilImage1 = "female.jpg";
    			} else {
    				$profilImage1 = $profile1; 
    			}
	    	?> 
<!DOCTYPE html> 
<html>
<head>
	<title>Welcome to chat room</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="main.css" />
	<link rel="stylesheet" type="text/css" href="style.css" />
	<!-- include our jQuery file --> 
	<script src="jquery.js"></script> 
	
	<script src="chat.js"></script> 
	<script>
	    //custom scroll bars for some dive elements this
	    // script is optional 
		
	</script> 
</head>
<body style="position: relative;">
	<audio id="audio" controls style="display:none ;">
    <source src="FacebookChatSound.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
  </audio>
	<div class="overlay"></div> 
	<div class="overlay-data">
		<h2>Please Wait ....</h2>
	</div> 

	<div class="container content-holder">
		<div class="page-header">
			<div class="pull-left" style="margin-left: 50px;"><strong><?php echo $profilImage1." ".$username; ?></strong></div> 
		     <h3>Hi <?php echo $username; ?> Welcome to Chat Room</h3> 
		</div>
		<div class='net' style="background: #FF4500; padding: 10px; color: white; text-align: center; font-size: 18px; display: none;">
		      We are having trouble connecting to the server. Please wait while we reconnect you 
		      <div class="pull-right"><img src="small-loading.gif" /></div> 
		</div> 
		<div class="page-header show-simples" style="opacity:0.8; display: none; font-size: 20px; padding: 10px; text-align: center; background:url(ic_next.png) left center no-repeat green; color: white;">
			     <span>Nothing to show right now</span>
		</div> 
		<div class="content"> 
			<div class="row"> 
				<div class="col-md-3" style="padding: 10px; height: 50px; overflow: hidden; border-right:1px solid #e1e1e1; border-bottom:1px solid #e1e1e1;"> 
					<div class="messages"><strong>Inbox </strong>   <span class="show-messages"><span class="icon-envelope "></span> <span class="badge"></span></span></div>
				    <div class="pull-right"><a href="logout.php">Logout</a></div>
				</div>
				<div class="col-md-6" style="height: 50px; overflow: hidden; text-align: center; padding: 10px; border-right:1px solid #e1e1e1; border-bottom:1px solid #e1e1e1;"> 
					<div class="pull-left loading" style="display: none; font-weight: bolder;"><img style="padding: 0; margin: 0;"  src="smart-ajax-loader.gif" alt="Loadin Please Wait" /></div> <strong class="active-chat">No active Chat</strong>
				</div> 
				<div class="col-md-3" style="height: 50px; overflow: hidden; text-align: center; padding: 10px; border-bottom:1px solid #e1e1e1;"> 
					<strong>System Members</strong>
				</div>  
			</div> 

			<!-- end of the chat toolBar -->

			<div class="row"> 
				<div class="col-md-3 chat-messages" style="padding: 10px;">
					<?php 
					    getreadyMesages(); 
					    MessagesGetMesages();
					?>
				</div> 
				<div class="col-md-6 messages-on"> 
					<div class="messages-reading" style="position: relative"> 
						<input type="hidden" name="hidden-token" id="hidden-token" class="form-control" value="<?php getToken(); ?>" />
						<div class="loading-mesos" style="position: absolute; top: -50px; left: 80%; display: none; z-index: 9999999999999;">
							<center>
								<img src="loading.gif"  />
								<div><h4>Loading your messages ... </h4></div>
							</center>
						</div> 
						<div class="display-message" style="position: absolute; width: 100%; padding: 10px; background: inherit; bottom: 0;"> 
						</div> 
					</div> 
					<div class="text-area"> 
						<textarea class="textarea-message form-control" placeholder="Enter message here..."></textarea>
					    <div class="button-send" align="right">
					    	<div  style="display: inline-block; margin-right: 30px; color:  green; font-weight: bolder;  "><span class="typing" style="display: none;">Benson is typing...</span></div>
					    	<div class="toggle-holder"> <label>Press Enter to send</label> <input type="checkbox" id="toggle-btn" checked /></div>
					    	<button  style="display: none;" class="btn btn-primary" id="send-message-click">Send Message</button> 
					    </div> 
					</div> 
				</div> 
				<div class="col-md-3 memembers" style="padding: 10px;"> 
					<?php getUsers(); ?>
				</div> 
			</div>

		</div> 
	</div>  
</body>
</html>
	    	<?php
	    	exit();
	    } 
?>

<!DOCTYPE html> 
<html>
<head>
	<title>Welcome to chat room</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.css">
	<link rel="stylesheet" type="text/css" href="main.css" />
	<!-- include our jQuery file --> 
	<script src="jquery.js"></script> 
	<script src="chat.js"></script> 
</head>
<body>
	<div class="container content-holder">
		<div class="page-header">
		     <h3>Welcome to Chat Room</h3> 
		</div>

		<div class="content">
		    <div class="row">
			    <div class="col-md-6"> 
			    	<center><h3>Welcome to Best QSystems Chat Room</h3></center>

			    	 <img src="live-chat.jpg"  class="img-responsive pull-right" alt="chat-home" />
			    </div> 
			    <div class="col-md-5 form-login">
			    	<?php require_once "accounts.inc.php"; ?> 
			    </div> 
			    <div class="col-md-1"></div> 
		    </div><!-- closing div class row --> 
		</div> 
	</div>  
</body>
</html>