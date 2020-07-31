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
$pdo= getConn();
$currentUser = $_SESSION['name'];

//Do different stuff depending on the action the user has performed.
switch ($_POST['action']) {

  //Case: Send message to other user.
  case 'postMessage':

    //This query inserts the message into the db.
    $query ='INSERT INTO chat (message, sender, receiver) VALUES (?, ?, ?)';

    //After that, prepare() the query for extra security and finally execute it.
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['message'], $currentUser, $_POST['receiver']]);

    //Then echo the result.
    $arr_response[] = array("message" => $_POST['message'],
                            "sent_at" => date('Y-m-d h:i:s a')
                          );
    echo json_encode($arr_response);
    break;

  //Case: Fetch conversation with other user.
  case 'fetchChatMessages':

    //Write the query that gets the conversation messages.
    $query='SELECT message, sent_at, receiver, sender FROM chat WHERE (receiver = ? AND sender= ?) OR (receiver=? AND sender=?)';

    //For added security, prepare() the query. Then, finally execute it.
    $stmt = $pdo->prepare($query);
    $stmt->execute([$currentUser, $_POST['sender'], $_POST['sender'], $currentUser]);

    //Write the data to an array for each row we get in return. If we don't get any, echo "No messages";
    if ($stmt->rowCount() > 0){

      while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        $arr_response[] = array("message" => $row['message'],
                          "sent_at" => $row['sent_at'],
                          "from" => $row['sender'],
                          "to" => $row['receiver']
                        );
      }

      //And now, JSON_encode() the array so we can get it from AJAX requests.
      echo json_encode($arr_response);

    } elseif ($stmt->rowCount() == 0) {
      echo "No Messages";
    }

    break;

  //Case: Fetch all unread messages. This action is performed each second.
  case 'unread':

    $query= 'SELECT message, sent_at, sender, receiver FROM chat WHERE receiver = ? AND sender= ? AND m_read= 0';

    $stmt = $pdo->prepare($query);
    $stmt->execute([$currentUser, $_POST['sender']]);

    //Write the data to an array for each row we get in return. If we don't get any, echo "No messages";
    if ($stmt->rowCount() > 0){

      $return_arr = array();
      while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        $return_arr[] = array("message" => $row['message'],
                          "sent_at" => $row['sent_at'],
                          "from" => $row['sender'],
                          "to" => $row['receiver']
                        );
      }

      //And now, JSON_encode() the array so we can get it from AJAX requests.
      echo json_encode($return_arr);

    } else {
      echo "No New Messages";
    }

    break;

  //Case: Set new messages as read.
  case 'setAsRead':

    //As always, write the query. This one sets m_read field to 1.
    $query='UPDATE chat SET m_read=1 WHERE m_read=0 AND receiver=? AND sender= ?';

    //Prepare() it and execute() it.
    $stmt= $pdo->prepare($query);
    $stmt->execute([$currentUser, $_POST['sender']]);

    echo "success";
    break;

  case 'getUsers':

    $query='SELECT name FROM wb_users WHERE name != ?';
    $stmt= $pdo->prepare($query);
    $stmt->execute([$_SESSION['name']]);

    if ($stmt->rowCount() > 0){
      $return_arr = array();
      while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
        $return_arr[] = array("name" => $row['name']);
      }

      echo json_encode($return_arr);
    }else{
      echo "No Users";
    }

    break;

  case 'changeUser':

    $_SESSION['ChatUserReceiver'] = $_POST['user'];

    break;

  //If no action is specificied, redirect to chat.
  default:
    header('Location: /home/chat');
    break;
}
 ?>
