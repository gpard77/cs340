<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pardg-db","riwkG4jt8PzpROoN","pardg-db");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	
if (isset( $_POST['add'] ) ) { 	
	if(!($stmt = $mysqli->prepare("INSERT into recipe_ingredients (recipeID, itemID) values
	((select id FROM recipes WHERE name = ?), ?)"))){
		echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
	}
	
	/*FOR TESTING
	foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }*/
	
	if(!($stmt->bind_param("ss",$_POST['recipeName5'],$_POST['selectIngredientName1']))){
		echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
	} else {
		echo "Added " . $stmt->affected_rows . " rows to recipe_ingredients.";
	}
}


?>