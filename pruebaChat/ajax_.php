<?php 
    require_once "functions.php";


    if(isset($_POST['newtwork'])){
        // this part is detecting network
    }

    if(isset($_POST['open1'])){
        require_once "myslq.php"; 

       $from = mysql_real_escape_string($_POST['frm']); 
       $me = mysql_real_escape_string($_SESSION['id']); 

       // remove all the messages from the ready pending 

       $query = mysql_query("DELETE  FROM ready_pending WHERE fromm='$from' AND too='$me'  "); 
       if($query){
            getreadyMesages(); 
            MessagesGetMesages();
       } else {
            die(mysql_query()); 
       }
    }

    if(isset($_POST['open'])){
    	require_once "myslq.php"; 
    	// opening the messages from the database

    	$me = mysql_real_escape_string($_SESSION['id']); 

    	$query = mysql_query("SELECT * FROM pending WHERE too='$me' "); 
    	if($query == false){
    		die(mysql_error()); 
    	}

    	$found = mysql_num_rows($query); 
    	if($found){
    		while ($pending = mysql_fetch_assoc($query)){
    			$message = $pending['message']; 
    			$from    = $pending['fromm'];
    			$to      = $pending['too'];
    			$queryToReady = mysql_query("INSERT INTO ready_pending(fromm, too, message) VALUES('$from','$to','$message') "); 
    			if($queryToReady == false){
    				die(mysql_error()); 
    			}

    			$queryDelPending = mysql_query("DELETE FROM pending WHERE too='$to' "); 
    			if($queryDelPending == false){
    				die(mysql_error()); 
    			}

    		}
    		getreadyMesages(); 
    		MessagesGetMesages(); 
    	} else {
    		echo 2; 
    	}

    } 

    if(isset($_POST['task']) && $_POST['task'] == "alerts"){
    	require_once "myslq.php";
    	$me = mysql_real_escape_string($_SESSION['id']); 
    	$query = mysql_query("SELECT * FROM alerts WHERE too='$me' "); 
    	$found = mysql_num_rows($query); 
    	if($found){
    		$queryDel = mysql_query("DELETE FROM alerts WHERE too='$me' ");
    		echo 1;
    	}
    }


    if(isset($_POST['task']) && $_POST['task'] == "pendings"){
    	require_once "myslq.php";
    	$me = mysql_real_escape_string($_SESSION['id']); 
    	$query = mysql_query("SELECT * FROM pending WHERE too='$me' "); 
    	$found = mysql_num_rows($query); 
    	if($found){
    		echo $found; 
    	}
    }

    if(isset($_POST['task']) && $_POST['task'] == "sending"){
    	require_once "myslq.php"; 
    	$message = mysql_real_escape_string($_POST['message']); 
    	$to = mysql_real_escape_string($_POST['token']); 
    	$from = mysql_real_escape_string($_SESSION['id']); 

    	// insert messages into all the tables now; 
    	// insert into the messages 
    	$query = mysql_query("INSERT INTO messages(fromm, too, message) VALUES('$from','$to','$message') "); 
    	// insert into alerts 
    	$query = mysql_query("INSERT INTO pending(fromm, too, message) VALUES('$from','$to','$message') ");
    	// insert into pending  
    	$query = mysql_query("INSERT INTO alerts(fromm, too, message) VALUES('$from','$to','$message') "); 
    	loadMessages($to); 

     }

    if(isset($_POST['task'])  && $_POST['task'] == "getLastMessages"){
    	$me = $_SESSION['id'];
    	// requring the db connection ; 
    	$db = connect(); 

    	try{
    		$query = $db->prepare("SELECT too FROM current_token WHERE fromm=? ");
    		$query->bindParam(1, $me); 
    		$query->execute(); 
    		$found = $query->rowCount(); 

    		if($found){
    			$returnedRow = $query->fetch(PDO::FETCH_NUM); 
    			$token = $returnedRow[0];
    			loadMessages($token); 
    		}
    		

    	}catch(PDOException $e){
    		die($e->getMessage());
    	}
    }

    if(isset($_POST['task']) && $_POST['task'] == "getName") {
    	$db = connect(); 

    	$me = $_SESSION['id'];

    	try{
    		$query = $db->prepare("SELECT fromm, too FROM current_token WHERE fromm=? LIMIT 1");
    		$query->bindParam(1,$me);
    		$query->execute();
    		$found = $query->rowCount();
    		if($found == 0){
    			echo "No Active Chat";
    		} else {
    			$rows = $query->fetch(PDO::FETCH_NUM); 
    			$to = $rows[1];
    			echo user($to, 'username');
    		} 


    	} catch(PDOException $e){
    		die($e->getMessage());
    	}
    } 

    if(isset($_POST['task']) && $_POST['task'] == "tokening"){
    	$db = connect();
    	$me = $_SESSION['id'];
    	$token = htmlentities($_POST['token']);
    	try{
    		$query = $db->prepare("SELECT * FROM current_token WHERE fromm=? ");
    		$query->bindParam(1,$me);
    		$query->execute(); 
    		$found = $query->rowCount();

    		if($found > 0){
    			try{
    				$queryUpadateToken = $db->prepare("UPDATE current_token SET fromm=:fromm , too=:too WHERE fromm=:frommargs ");
    				$queryUpadateToken->bindParam(':fromm',$me);
    				$queryUpadateToken->bindParam(':too',$token); 
    				$queryUpadateToken->bindParam(':frommargs',$me); 
    				
    				$queryUpadateToken->execute(); 
    				// call the funcation contaning the current messages 
    				loadMessages($token);

    			}catch(PDOException $e){
    				die($e->getMessage()); 
    			}
    		} else  {
    			try{
    				$queryInsToken = $db->prepare("INSERT INTO current_token(fromm, too) VALUES(?,?) ");
    				$queryInsToken->bindParam(1,$me); 
    				$queryInsToken->bindParam(2,$token);
    				$queryInsToken->execute(); 
    				// call the function containing our messages;
    				loadMessages($token);

    			}catch(PDOException $e){
    				die($e->getMessage()); 
    			}
    		}
    	}catch(PDOException $e){
    		die($e->getMessage()); 
    	}
    }
?> 