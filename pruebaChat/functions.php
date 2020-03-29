<?php
   // functions to confirm that one is logged in please

    // connect to the database ;
    ob_start();
    session_start();

    function connect(){
    	try{
    		$db = new PDO("mysql:host=localhost;dbname=chat;charset=utf8","root","vialactea");
    		//echo "connected";
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	}catch(PDOException $e){
    		die($e->getMessage());
    	}
    	return $db;
    }

    function login($username, $password){

    	if(empty($username) || empty($password)){
    		echo "<div class='errors'>You must fill in all the form data</div>";
    		return;
    	}

    	$user = preg_replace('/\s+/', '', htmlentities($username));
    	$pas = preg_replace('/\s+/', '', htmlentities($password));

    	$db = connect(); // this one is returning the pdo object;
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	try{
            $query = $db->prepare("SELECT id, username, password FROM users WHERE username=? AND password=? ");
            $query->bindParam(1,$user);
            $query->bindParam(2, $pas);
            $query->execute();
        } catch(PDOException $e){
            die($e->getMessage());
        }

    	$foundData = $query->fetch(PDO::FETCH_NUM);
    	$dataId = $foundData[0];
    	$dataUsername = $foundData[1];
    	$dataPassword = $foundData[2];
        echo $query->rowCount();

    	if($user != $dataUsername &&  $pas != $dataPassword){
    		echo "<div class='errors'>Either your username or password is incorrect</div> ";
    	}  else {
    		$salt = md5($dataId);
    		$queryCheckSalt = $db->prepare("SELECT * FROM users WHERE (username=:username AND password=:password ) AND salt=:salt ");
    		$queryCheckSalt->bindParam(':username',$user);
    		$queryCheckSalt->bindParam(':password',$pas);
    		$queryCheckSalt->bindparam(':salt',$salt);
    		$queryCheckSalt->execute();

    		$found = $queryCheckSalt->rowCount();
    		if($found == 0){
    			$queryUpdateSalt = $db->prepare("UPDATE users SET salt=:salt WHERE username=:username and password=:password");
    			$queryUpdateSalt->bindParam(':username', $user);
    			$queryUpdateSalt->bindParam(':password', $pas);
    			$queryUpdateSalt->bindParam(':salt', $salt);
    			$queryUpdateSalt->execute();
    		}

    		$_SESSION['id'] = $salt;
    		header("Location:index.php");

    	}

    }

    function register($username, $name, $password, $gender){
    	$user = preg_replace('/\s+/', '', htmlentities($username));
    	$pas = preg_replace('/\s+/', '', htmlentities($password));
    	$nm = preg_replace('/\s+/', '', htmlentities($name));
    	$gd  = htmlentities($gender);



    	if(!empty($username) && !empty($password) && !empty($name)&& !empty($gender)){
    		// check if username is already available in the database;
    	   $db = connect();
    	   $query = $db->prepare("SELECT * FROM users WHERE username=? ");
    	   $query->bindParam(1,$user);
    	   $query->execute();
    	   $foundUser = $query->rowCount();

    	    if($foundUser > 0){
    	    	echo "<div class='errors'><strong>$user</strong> is already taken!!</div>";
    	    	return;
    	    }

    	    $queryIns = $db->prepare("INSERT INTO users(username, name, password, gender) VALUES(?, ?, ?, ?) ");
    	    $queryIns->bindParam(1,$user);
    	    $queryIns->bindParam(2,$nm);
    	    $queryIns->bindParam(3,$pas);
    	    $queryIns->bindParam(4,$gd);
    	    $queryIns->execute();
    	    echo "<div class='nice'>Thanks $username for registering with us. Please login to  view your account</div> ";

    	} else{
    		echo "<div class='errors'>You must fill in all the form data</div> ";
    	}
    }

    function user($id, $field){
    	$db = connect();

        try{
            $query = $db->prepare("SELECT $field FROM users WHERE salt=? ");
            $query->bindParam(1, $id);
            $query->execute();
        } catch(PDOException $e){
            die("Eror due to <strong>".$e->getMessage()."</strong>");
        }


    	$returnedRow = $query->fetch(PDO::FETCH_NUM);

    	return $returnedRow[0];
    }

    function getUsers(){
    	$db = connect(); // now we have our pdo object;
    	$query = $db->query("SELECT * FROM users ");
    	$found = $query->rowCount();
    	if($found){
    		while($rows = $query->fetch(PDO::FETCH_ASSOC)){
    			$salt = $rows['salt'];
    			$username = ucwords($rows['username']);
    			$profile = $rows['profile'];
    			$gender = $rows['gender'];

    			if($profile == "" && $gender =="Male"){
    				$profilImage = "male.jpg";
    			} else if($profile == "" && $gender =="Female") {
    				$profilImage = "female.jpg";
    			} else {
    				$profilImage = $profile;
    			}

    			echo "<div class='row row-sidbar'>
    			            <div class='sidebar-members' data-token='$salt' data-user='$username' >
		    			        <div class='col-md-4'>
		    			            <img src='$profilImage' alt='$username' />
		    			        </div>
		    			        <div class='col-md-7'>
		    			           <span class='username'>$username</span> $gender
		    			        </div>
		    			        <div class='col-md-1'></div>
    			            </div>
    			       </div>
    			      ";
    		}
    	}
    }

    function loadMessages($token){
        // this function is going to load all the messages from the datbase;
        $db = connect();
        $me = $_SESSION['id'];

        $query = $db->prepare("SELECT * FROM messages WHERE (fromm=:fromm1 AND too=:too1 ) OR (fromm=:too2 AND too=:fromm2 ) ");
        $query->bindParam(':fromm1',$me);
        $query->bindParam(':too1',$token);
        $query->bindParam(':too2',$token);
        $query->bindParam(':fromm2',$me);
        $query->execute();
        $found = $query->rowCount();
        if($found){
            while($row = $query->fetch(PDO::FETCH_ASSOC)){

                $from = $row['fromm'];
                $to = $row['fromm'];
                $message = $row['message'];


                if($from == $me){
                    $realMessage = "<div class='me'> $message <br /><br /></div>";
                } else {
                    $realMessage = "<div><div class='you'>$message <br /><br /></div></div>";
                }

                echo $realMessage;

            }

        }  else {
            echo "<strong>No messages yet</strong>";
        }

        try{

        }catch(PDOException $e){

        }
    }


    function getToken(){
        $db = connect();
        try{
            $me = $_SESSION['id'];

            $query = $db->prepare("SELECT too FROM current_token WHERE fromm=? ");
            $query->bindParam(1, $me);
            $query->execute();
            $found = $query->rowCount();
            if($found){
                $row = $query->fetch(PDO::FETCH_NUM);
                echo $row[0];
            }

        } catch(PDOException $e){
            echo ($e->getMessage());
        }

    }

    function getreadyMesages(){
        require_once "myslq.php";
        $me = $_SESSION['id'];
        $query = mysql_query("SELECT fromm, message FROM ready_pending WHERE too='$me' ORDER BY id desc ");
        if($query == false){
            die(mysql_error());
        }

        $found = mysql_num_rows($query);
        if($found){
            while($messages = mysql_fetch_assoc($query)){
                $from = $messages['fromm'];
                $message = $messages['message'];

                $username = getUser($from,'username');
                $profile = getUser($from,'profile');
                $gender = getUser($from, 'gender');

                if($profile == "" && $gender == "Male") {
                    $profileImage = "male.jpg";
                } else if($profile == "" && $gender == "Female") {
                    $profileImage = "female.jpg";
                } else {
                    $profileImage = $profile;
                }

                echo "
                   <div class='row'>
                       <div class='col-md-12' style='padding: 5px;' >
                           <div class='row sidebar-members ready_pending'  data-token='$from'  data-user='$username' >
                               <div class='col-md-2'>
                                   <img src='$profileImage' height='30' />
                               </div>
                               <div class='col-md-9'>
                                   <div class='pull-right badge'>NEW</div>
                                   You have new message from $username. click here to open

                               </div>
                               <div class='col-md-1'></div>
                           </div>
                       </div>
                   </div>
                ";
            }
        }
    }



    function MessagesGetMesages(){
        require_once "myslq.php";
        $me = $_SESSION['id'];
        $query = mysql_query("SELECT fromm, message FROM messages WHERE too='$me' ORDER BY id DESC ");
        if($query == false){
            die(mysql_error());
        }

        $found = mysql_num_rows($query);
        if($found){
            while($messages = mysql_fetch_assoc($query)){
                $from = $messages['fromm'];
                $message = $messages['message'];

                $username = getUser($from,'username');
                $profile = getUser($from,'profile');
                $gender = getUser($from, 'gender');

                if($profile == "" && $gender == "Male") {
                    $profileImage = "male.jpg";
                } else if($profile == "" && $gender == "Female") {
                    $profileImage = "female.jpg";
                } else {
                    $profileImage = $profile;
                }

                echo "
                   <div class='row'>
                       <div class='col-md-12' style='padding: 5px;' >
                           <div class='row sidebar-members messages_messages'  data-token='$from'  data-user='$username' >
                               <div class='col-md-2'>
                                   <img src='$profileImage' height='30' />
                               </div>
                               <div class='col-md-9'>
                                   $username sent you a message. click here to open
                               </div>
                               <div class='colmd-1'>
                               </div>
                           </div>
                       </div>
                   </div>
                ";
            }
        }
    }


    function confirmLogin(){
    	if(isset($_SESSION['id']) && $_SESSION['id'] != ""){
    		return true;
    	} else {
    		return false;
    	}

    }



?>
