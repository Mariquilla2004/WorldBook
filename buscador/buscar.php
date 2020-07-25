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
    	$query = "SELECT * FROM forums WHERE forum_id LIKE '%$q%' OR forum_name LIKE '%$q%' OR forum_bio LIKE '%$q%' OR forum_participants LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="<table border=1 class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
    					<td>ID</td>
    					<td>FORO</td>
    					<td>BIOGRAFÍA</td>
    					<td>PARTICIPANTES</td>
    					
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['forum_id']."</td>
    					<td>".$fila['forum_name']."</td>
    					<td>".$fila['forum_bio']."</td>
    					<td>".$fila['forum_participants']."</td>
					</tr>";
					<div class="card" style="width: 18rem;  ">
  						<img src="..." class="card-img-top" alt="...">
  						<div class="card-body">
    						<h5 class="card-title">.$fila['forum_id'].</h5>
    						<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    						<a href="#" class="btn btn-primary">Go somewhere</a>
  						</div>
					</div>

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>