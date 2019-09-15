<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	//read argument
	 $index=$_GET['index'];

	// Create connection
	$conn = new mysqli($servername, $username, $password, "hw5DB");
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	//select a row from table location whose id is 10
	$sql = "SELECT id, lat, lng FROM location WHERE id= $index";
	if ($result = $conn->query($sql)) {
	    // fetch associative array 
    	while ($row = $result->fetch_assoc()) {
        	$arr = array('id'=>$row['id'], 'lat'=>$row['lat'], 'lng'=>$row['lng']);
        	echo json_encode($arr);
    	}
	    // free result set 
    	$result->free();
	}
	$conn->close();
?>