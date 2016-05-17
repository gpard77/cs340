<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pardg-db","riwkG4jt8PzpROoN","pardg-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
if (isset( $_POST['add'] ) ) { 	
	if(!($stmt = $mysqli->prepare("INSERT INTO food_type(name) VALUES (?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("s",$_POST['foodTypeName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to food_type.";
	}
}

if (isset( $_POST['delete'] ) ) { 
	if(!($stmt = $mysqli->prepare("DELETE FROM food_type WHERE food_type.name = ?"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}

	if(!($stmt->bind_param("s",$_POST['foodTypeName']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Deleted " . $stmt->affected_rows . " rows from food_type.";
	}
}



?>