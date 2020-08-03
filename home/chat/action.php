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
    $stmt->execute([$_POST['message'], $currentUser, base64_decode($_POST['receiver'])]);

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
    $stmt->execute([$currentUser, base64_decode($_POST['sender']), base64_decode($_POST['sender']), $currentUser]);

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
    $stmt->execute([$currentUser, base64_decode($_POST['sender'])]);

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
    $stmt->execute([$currentUser, base64_decode($_POST['sender'])]);

    echo "success";
    break;

  //Case: Get only the users to which the current user have talked to.
  case 'getUsers':

    //Bear in mind that this query can return repeated values, for sender and receiver, if the users have sent multiple messages.
    $query='SELECT sender, receiver FROM chat WHERE sender = ? OR receiver= ?';
    $stmt= $pdo->prepare($query);
    $stmt->execute([$currentUser, $currentUser]);

    if ($stmt->rowCount() > 0){
      $return_arr = array();
      while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

        //Select the sender if it isn't the current user.
        if ($row['sender'] != $currentUser){
            $return_arr[] = array($row['sender']);

          //Otherwise, if the sender IS the current user, select the receiver.
        } elseif ($row['receiver'] != $currentUser){
            $return_arr[]= array($row['receiver']);
        }
      }

      //To fix the "repeated names" problem, remove any repeated value in the return array.
      $return_array = array_values(array_unique($return_arr, SORT_REGULAR));
      echo json_encode($return_array);

    } else {
      echo "No Users";
    }

    break;

  case 'changeUser':

    $_SESSION['ChatUserReceiver'] = base64_encode($_POST['user']);

    break;

  //If no action is specificied, redirect to chat.
  default:
    header('Location: /home/chat');
    break;
}
 ?>
