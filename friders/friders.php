<?php
//Start the session.
  session_start();
  if( !isset($_SESSION['loggedin']) ){
    header('Location: /auth/logIn');
    exit();
  }

//Require the connection to the database and the error handler.
require( '../server-config/error-handler.php');
require("../server-config/connect.php");
$pdo= getConn();

//Only proceed if the request is a POST request.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)){

  //Perform different operations depending on the 'action' content.
  switch ($_POST['action']){

    //If the action is 'search', search into the db.
    case 'search':

      if (isset($_POST['q'])){

        $query= 'SELECT name FROM wb_users WHERE name LIKE ?';

        //Prepare the query and execute it. We sanitize the input before executing the query, using validate().
        $q= validate($_POST['q']);
        $stmt = $pdo->prepare($query);
        $stmt->execute(array("%$q%"));

        //Echo the result to an array for each row we get. If we get none (rowCount() == 0), echo "No results".
        if ($stmt->rowCount() > 0){
          while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

            //Set "isFrider" value of the response array using isFrider().
            //Also don't include the current user's name into the results array.
            if (isFrider($row['name'])){
              $response[] = array("name" => base64_encode($row['name']),
                              "pic_url" => '/media/avatar1.jpeg',
                              "isFrider" => true
                            );
            }else if($row['name'] != $_SESSION['name']) {
              $response[] = array("name" => base64_encode($row['name']),
                              "pic_url" => '/media/avatar1.jpeg',
                              "isFrider" => false
                            );
            }
          }

          echo json_encode($response);

        } else {
          echo "No Results";
        }

      }

      break;

    case 'getFriders':

      $stmt = $pdo->prepare('SELECT user1, user2 FROM friders WHERE user1 = ? OR user2 = ?');
      $stmt->execute([$_SESSION['name'], $_SESSION['name']]);

      if ($stmt->rowCount() > 0){
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){

          if ($row['user1'] == $_SESSION['name']){
            $response[] = array("name" => base64_encode($row['user2']),
                            "pic_url" => '/media/avatar1.jpeg',
                            "isFrider" => true
                          );

          } else if ($row['user2'] == $_SESSION['name']){
            $response[] = array("name" => base64_encode($row['user1']),
                            "pic_url" => '/media/avatar1.jpeg',
                            "isFrider" => true
                          );

          }
        }

        echo json_encode($response);

      } else {
        echo "No Results";
      }

      break;

    //Add users to friders.
    case 'addFrider':

    $user2 = base64_decode($_POST['u']);
    $stmt= $pdo->prepare('INSERT INTO friders (user1, user2) VALUES (?, ?)');
    $stmt->execute([$_SESSION['name'], $user2]);

    echo 'success';


      break;
  }
}

//This function is intended to prevent our script from XSS and other attacks, by sanitizing the inputs. Cross your fingers!
function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function isFrider($name){

  if ($name != $_SESSION['name']){
    $pdo= getConn();
    $query='SELECT COUNT(*) FROM friders WHERE user1= ? OR user2= ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$name, $name]);
    $nRows = $stmt->fetchColumn();
  }else if($name == $_SESSION['name']){
    $nRows = 0;
  }


  return $nRows>0 ? true : false;

}


?>
