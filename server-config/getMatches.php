<?php
require("connect.php");
session_start();
  function getMatches(){

    //Get the PDO connection.
    $pdo= getConn();

    //Now, get the books!
    $query='SELECT title, owner, requester, found_at FROM matches WHERE owner = ? OR requester= ? ORDER BY found_at DESC';
    $stmt= $pdo->prepare($query);
    $stmt->execute([$_SESSION['name'], $_SESSION['name']]);

    while($result= $stmt->fetch(PDO::FETCH_ASSOC)){

      $dt= new DateTime($result['found_at']);

      //Display different notification messages for user's owned books vs requested books.
      if ($result['requester'] == $_SESSION['name']){

        echo '<a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle" style="background-color: #40abf3;">
                    <i style="color: #ffff;"class="fas fa-book-medical"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500 text-left">'. $dt->format('M j g:i A') .'</div>
                  <span class="font-weight-bold">'. $result['owner'] .'</span> has got <span class="font-weight-bold">'. $result['title'] .'!</span>
                </div>
              </a>';

      }elseif ($result['owner'] == $_SESSION['name']) {

        echo '<a class="dropdown-item d-flex align-items-center" href="#">
                <div class="mr-3">
                  <div class="icon-circle" style="background-color: #40abf3;">
                    <i style="color: #ffff;"class="fas fa-book-medical"></i>
                  </div>
                </div>
                <div>
                  <div class="small text-gray-500">'. $dt->format('M j g:i A') .'</div>
                  <span class="font-weight-bold">'. $result['requester'] .'</span> wants to read <span class="font-weight-bold">'. $result['title'] .'!</span>
                </div>
              </a>';
      }
    }
  }

  getMatches();
?>
