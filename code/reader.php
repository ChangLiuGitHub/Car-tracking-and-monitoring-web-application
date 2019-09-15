<?php
	$lines = file("location.txt");
	foreach($lines as $line_num => $line){
		echo "$line <br>";
	}
?>