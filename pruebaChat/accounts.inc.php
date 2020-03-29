<?php 
   if(!isset($_GET['register'])){
   	?> 
   	   <h3>Already have an account? Login</h3>
   	   <?php
   	        
   	        if(isset($_POST['username']) && isset($_POST['password'])){
   	        	$username = $_POST['username']; 
   	        	$password = $_POST['password'];
   	        	login($username, $password);
   	        }
   	    ?> 


   	   <form class="form-horizontal" method="post" actio="">
   	   	   <div class="form-group">
   	   	   	    <label for="username" class="col-md-2">Username</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input type="text"  autocomplete="off" id="username" name="username" class="form-control">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <label for="password" class="col-md-2">password</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input type="password" id="password" name="password" class="form-control">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <div class="col-md-2"></div>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input class="btn btn-primary" type="submit" name="submit" value="login">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <div class="col-md-2"></div>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<a href="index.php?register=regsiter">Register</a>
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 
   	   </form> 
   	<?php
   } else {
   	 if($_GET['register'] == ""){
   	 	header("location:index.php");
   	  }
   	?> 
   	<h3>Register to Join the Chat Room</h3>
   	<?php
   	        $username = ""; 
   	        $name = ""; 
   	        $password = ""; 
   	        
		   	if(isset($_POST['user']) && isset($_POST['name'])){
		    	$username = $_POST['user']; 
		    	$name = $_POST['name'];
		    	$password = $_POST['pas'];
		    	$gender = $_POST['gender'];
		    	register($username, $name, $password, $gender);
		    }
   	?> 
   	<form class="form-horizontal" method="post" actio="">
   	   	   <div class="form-group">
   	   	   	    <label for="user" class="col-md-2">Username</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input type="text" value="<?php echo $username; ?> " autocomplete="off" id="user" name="user" class="form-control">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <label for="name" class="col-md-2">Name</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input id="name" value="<?php echo $name; ?>" type="text" id="name" name="name" class="form-control">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <label for="pas" class="col-md-2">password</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input type="password" id="pas" name="pas" class="form-control">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div>

   	   	   <div class="form-group">
   	   	   	    <label for="gender" class="col-md-2">Gender</label>
   	   	   	    <div class="col-md-8"> 
   	   	   	        <select name="gender" id="gender">
   	   	   	        	<option value="">--Please select your gender--</option> 
   	   	   	        	<option value="Male">Male</option> 
   	   	   	        	<option value="Female">Female</option> 
   	   	   	        </select> 
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <div class="col-md-2"></div>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<input class="btn btn-primary" type="submit" name="regisgter" value="Register">
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 

   	   	   <div class="form-group">
   	   	   	    <div class="col-md-2"></div>
   	   	   	    <div class="col-md-8"> 
   	   	   	    	<a href="index.php?register=">Login here</a>
   	   	   	    </div> 
   	   	   	    <div class="col-md-2"></div> 
   	   	   </div> 
   	   </form> 
   	<?php 
   }
?>