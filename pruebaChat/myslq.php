<?php 

      $connect = @mysql_connect("localhost","root","");
      $selectDb = mysql_select_db("chat",$connect); 

      if($selectDb == false){
      	die(mysql_error()); 
      } 

      function getUser($salt , $f){
      	$query = mysql_query("SELECT $f FROM users WHERE salt='$salt' ");
      	if($query == false){
      		die(mysql_error()."Error from getuser ");
      	} 

      	$row = mysql_fetch_row($query); 
        return $row[0]; 
      }
?>