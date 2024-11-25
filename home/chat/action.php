<?php
require( '../../server-config/error-handler.php');
require("../../server-config/connect.php");
require("../../auth/checkSession.php");

//Start the session.
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
  }

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

    //Get the user's current date.
    $dt = new \DateTime("now", new \DateTimeZone("UTC"));
    $hours = $_POST['timeOffset'];

    //Adding (or substracting) to the db's timestamp the previously gotten time difference will give us the user's local time at which the message was sent.
    $localdt = $dt->add(new DateInterval("PT{$hours}H"));

    //Then echo the result.
    $arr_response[] = array("message" => $_POST['message'],
                            "sent_at" => $localdt->format('M j g:i A')
                          );
    echo json_encode($arr_response);
    break;

  //Case: Fetch conversation with other user.
  case 'fetchChatMessages':

    //Write the query that gets the conversation messages.
    $query='SELECT message, sent_at, receiver, sender FROM chat WHERE (receiver = ? AND sender= ?) OR (receiver=? AND sender=?) ORDER BY sent_at ASC';

    //For added security, prepare() the query. Then, finally execute it.
    $stmt = $pdo->prepare($query);
    $stmt->execute([$currentUser, base64_decode($_POST['sender']), base64_decode($_POST['sender']), $currentUser]);

    //Write the data to an array for each row we get in return. If we get none, echo "No messages";
    if ($stmt->rowCount() > 0){

      while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

        //$dt is the time at which the message was sent in UTC time. $hours is the difference between user's local time and UTC time (in hours).
        $dt = new DateTime($row['sent_at']);
        $hours = $_POST['timeOffset'];

        //Adding (or substracting) to the db's timestamp the previously gotten time difference will give us the user's local time at which the message was sent.
        $localdt = $dt->add(new DateInterval("PT{$hours}H"));

        $arr_response[] = array("message" => $row['message'],
                          "sent_at" => $localdt->format('M j g:i A'),
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

    if (isset($_POST['sender'])){
      $query= 'SELECT message, sent_at, sender, receiver FROM chat WHERE receiver = ? AND sender= ? AND m_read= 0 ORDER BY sent_at ASC';

      $stmt = $pdo->prepare($query);
      $stmt->execute([$currentUser, base64_decode($_POST['sender'])]);

      //Write the data to an array for each row we get in return. If we don't get any, echo "No messages";
      if ($stmt->rowCount() > 0){

        $return_arr = array();
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

          //$dt is the time at which the message was sent in UTC time. $hours is the difference between user's local time and UTC time (in hours).
          $dt = new DateTime($row['sent_at']);
          $hours = $_POST['timeOffset'];
          $localdt = $dt->add(new DateInterval("PT{$hours}H"));

          $return_arr[] = array("message" => $row['message'],
                            "sent_at" => $localdt->format('M j g:i A'),
                            "from" => $row['sender'],
                            "to" => $row['receiver']
                          );
        }

        //And now, JSON_encode() the array so we can get it from AJAX requests.
        echo json_encode($return_arr);

      } else {
        echo "No New Messages";
      }

    } else{
      $query ='SELECT message, sent_at, sender FROM chat WHERE receiver = ? AND m_read= 0 ORDER BY sent_at DESC';
      $stmt = $pdo->prepare($query);
      $stmt->execute([$currentUser]);

      //Write the data to an array for each row we get in return. If we don't get any, echo "No messages";
      if ($stmt->rowCount() > 0){

        $return_arr = array();
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

          //$dt is the time at which the message was sent in UTC time. $hours is the difference between user's local time and UTC time (in hours).
          $dt = new DateTime($row['sent_at']);
          $hours = $_POST['timeOffset'];
          $localdt = $dt->add(new DateInterval("PT{$hours}H"));

          $return_arr[] = array("message" => $row['message'],
                            "sent_at" => $localdt->format('M j g:i A'),
                            "from" => base64_encode($row['sender'])
                          );
        }

        //And now, JSON_encode() the array so we can get it from AJAX requests.
        echo json_encode($return_arr);

      } else {
        echo "No New Messages";
      }
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

    $_SESSION['ChatUserReceiver'] = $_POST['user'];

    break;

  //If no action is specificied, redirect to chat.
  default:
    header('Location: /home/chat');
    break;
}
 ?>
