<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	// Create database named "hw5DB"
	$sql = "CREATE DATABASE hw5DB";
	if ($conn->query($sql) === TRUE) {
    	echo "Database created successfully <br>";
    	$conn = new mysqli($servername, $username, $password, "hw5DB");
    	echo "successfully connect hw5DB. <br>";
	} else {
		//if hw5DB already exists, connect to it
    	$conn = new mysqli($servername, $username, $password, "hw5DB");
    	echo "successfully connect hw5DB. <br>";
	}
	
	//Delete all existing tables
	$conn->query('SET foreign_key_checks = 0');
	if ($result = $conn->query("SHOW TABLES")){
    	while($row = $result->fetch_array(MYSQLI_NUM)){
        	$conn->query('DROP TABLE IF EXISTS '.$row[0]);
    	}
    	echo "<br> hw5DB is empty now <br>";
    	$result->close();
	}else{
		echo "<br> hw5DB is already empty <br>";
	}
	$conn->query('SET foreign_key_checks = 1');	
	
	//create new table named "location"
	$sql = "CREATE TABLE location (
		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
		lat DOUBLE(10,6) NOT NULL,
		lng DOUBLE(10,6) NOT NULL
		)";

	if ($conn->query($sql) === TRUE) {
    	echo "<br> Table location created successfully <br><br>";
	} else {
    	echo "<br> Error creating table: " . $conn->error;
	}

	//read information from loction.txt, and insert data to hw5DB
	$lines = file("location.txt");
	foreach($lines as $line_num => $line){
		echo $line_num.": ".$line."<br>";
		//parse a line into two integers
		$parse = explode(" ", $line);
		$lat = $parse[0];
		$lng = $parse[1];

		$sql = "INSERT INTO location (id, lat, lng)
			VALUES ('', $lat, $lng)";
		if ($conn->query($sql) === TRUE) {
		    echo $sql."<br>";
		} else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}	

	$conn->close();
?>