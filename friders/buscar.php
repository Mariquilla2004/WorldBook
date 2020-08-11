<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "prueba";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT * FROM forums WHERE forum_name NOT LIKE '' ORDER By forum_id LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM forums WHERE forum_name LIKE '%$q%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	while ($fila = $resultado->fetch_assoc()) {
			$salida.="



			<div class='card-deck'>
			<div class='row'>
			<div class='col-10'>
			<div class='card'>
			  <img class='card-img-top' src='...' alt='Card image cap'>
			  <div class='card-body'>
				<h5 class='card-title'>" . $fila['forum_name'] . "</h5>
				<p class='card-text'>" . $fila['forum_bio'] . "</p>
				
			  </div>
			</div>
			</div>
			</div>";
    	}
    	$salida.="</div>";
    }else{
    	$salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>