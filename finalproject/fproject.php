<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pardg-db","riwkG4jt8PzpROoN","pardg-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	else
	{
		echo "You're good";
	}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<title>Final Project - CS 340</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
<body style="background-image: url('quickCook.jpg');">



<!-- INSERT BOOTSTRAP JUMBOTRON DIV -->
<div class="container">
  <div class="jumbotron">
<!-- ADD FOOD TYPE -->
<h1>Database Interface
</h1>
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        FOOD TYPES</a>
      </h4>
    </div>
	<div id="collapse1" class="panel-collapse collapse">
	
<div class="panel-body" >
	<table>
		<tr>
			<td>FOOD TYPE</td>
		</tr>
		<tr>
			<th>Name</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT food_type.name FROM food_type"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addfood.php"> 

		<fieldset>
			<legend>Food Type Name</legend>
			<p>Name: <input type="text" name="foodTypeName" /></p>
		</fieldset>
		<p>
			<input type="submit" name="add" value="add" />
			<input type="submit" name="delete" value="delete" />
		</p>
	</form>
</div>
</div>

<!-- CUISINE TYPE -->

  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        CUISINE TYPES</a>
      </h4>
    </div>
	<div id="collapse2" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>CUISINE TYPE</td>
		</tr>
		<tr>
			<th>Name</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT cuisine_type.name FROM cuisine_type"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name2 . "\n</td>\n<td>\n";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addcuisine.php"> 

		<fieldset>
			<legend>Cuisine Type Name</legend>
			<p>Name: <input type="text" name="cuisineTypeName" /></p>
		</fieldset>
		<p>
			<input type="submit" name="add" value="add" />
			<input type="submit" name="delete" value="delete" />
		</p>
	</form>
</div>
</div>
</div>

<!-- FOOD INVENTORY -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        FOOD INVENTORY</a>
      </h4>
    </div>
	<div id="collapse3" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>FOOD INVENTORY</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Food Type</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT food_inventory.name, food_type.name FROM food_inventory INNER JOIN food_type ON food_inventory.ftype = food_type.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name3, $foodType)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $name3 . "\n</td>\n<td>\n" . $foodType . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addinventory.php"> 

		<fieldset>
			<legend>Name</legend>
			<p>Name: <input type="text" name="foodName" /></p>
		</fieldset>

		<fieldset>
			<legend>Food Type</legend>
			<select name="selectFoodType">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM food_type"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id, $typeName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id . ' "> ' . $typeName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p>
			<input type="submit" name="add" value="add" />
			<input type="submit" name="delete" value="delete" />
		</p>
	</form>
</div>
</div>
</div>
</div>
<!-- ADD OR DELETE RECIPE -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        ADD RECIPE</a>
      </h4>
    </div>
	<div id="collapse4" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>ADD RECIPE</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Cost</th>
			<th>Cuisine Type</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT recipes.name, recipes.cost, cuisine_type.name FROM recipes INNER JOIN cuisine_type ON recipes.ctype = cuisine_type.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name4, $cost, $cuisineType)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
  echo "<tr>\n<td>\n" . $name4 . "\n</td>\n<td>\n" . $cost . "\n</td>\n<td>\n" . $cuisineType . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="addrecipe.php"> 

		<fieldset>
			<legend>Recipe Name</legend>
			<p>Name: <input type="text" name="recipeName" /></p>
		</fieldset>
		
		<fieldset>
			<legend>Recipe Cost</legend>
			<p>Price: <input type="text" name="cost" /></p>
		</fieldset>

		<fieldset>
			<legend>Cuisine Type</legend>
			<select name="selectCuisineType">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM cuisine_type"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id2, $ctypeName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id2 . ' "> ' . $ctypeName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p>
			<input type="submit" name="add" value="add" />
			<!-- <input type="submit" name="delete" value="delete" /> -->
		</p>
	</form>
</div>
</div>
</div>
</div>

<!-- CREATE RECIPE ADD INGREDIENTS -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        CREATE RECIPE</a>
      </h4>
    </div>
	<div id="collapse5" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>CREATE RECIPE - ADD INGREDIENTS</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Cost</th>
			<th>Cuisine Type</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT recipes.name, recipes.cost, cuisine_type.name FROM recipes INNER JOIN cuisine_type ON recipes.ctype = cuisine_type.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($name4, $cost, $cuisineType)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
  echo "<tr>\n<td>\n" . $name4 . "\n</td>\n<td>\n" . $cost . "\n</td>\n<td>\n" . $cuisineType . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="createrecipe.php"> 

		<fieldset>
			<legend>Recipe Name</legend>
			<p>Name: <input type="text" name="recipeName5" /></p>
		</fieldset>
	
<!-- First Ingredient -->
		<fieldset>
			<legend>Ingredient Name</legend>
			<select name="selectIngredientName1">
<?php
if(!($stmt = $mysqli->prepare("SELECT foodID, name FROM food_inventory"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id99, $ingName99)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id99 . ' "> ' . $ingName99 . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		
		<p>
			<input type="submit" name="add" value="add" />
		</p>
	</form>

</div>
</div>
</div>
</div>


<!-- CUSTOMERS -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
        CUSTOMER ACCOUNTS</a>
      </h4>
    </div>
	<div id="collapse6" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>CUSTOMERS</td>
		</tr>
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Selections</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT customers.fname, customers.lname, customers.selections FROM customers INNER JOIN recipes ON recipes.id = customers.selections"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($fname, $lname, $selections)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $fname . "\n</td>\n<td>\n" . $lname . "\n</td>\n<td>\n" . $selections . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="customers.php"> 

		<fieldset>
			<legend>First Name</legend>
			<p>Enter First Name: <input type="text" name="fName" /></p>
		</fieldset>
		
		<fieldset>
			<legend>Last Name</legend>
			<p>Enter Last Name: <input type="text" name="lName" /></p>
		</fieldset>
		
		<fieldset>
			<legend>Selections</legend>
			<select name="selectRecipeName1">
<?php
if(!($stmt = $mysqli->prepare("SELECT recipes.id, recipes.name FROM recipes"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id15, $selection1)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id15 . ' "> ' . $selection1 . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

		<p>
			<input type="submit" name="add" value="add customer" />
		</p>
	</form>
</div>
</div>
</div>
</div>

<!-- ORDERS -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
        VIEW ORDERS</a>
      </h4>
    </div>
	<div id="collapse7" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>ORDERS TABLE</td>
		</tr>
		<tr>
			<th>Number</th>
			<th>Last Name</th>
			<th>Driver Assignment</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT orders.id, customers.lname, drivers.lname FROM orders INNER JOIN customers ON customers.id = orders.ordered_by INNER JOIN drivers ON drivers.id = orders.delivery_assign"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($ordersID, $custLName, $dLName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $ordersID . "\n</td>\n<td>\n" . $custLName . "\n</td>\n<td>" . $dLName . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="orders.php"> 
		
		<fieldset>
			<legend>Order ID</legend>
			<select name="custID">
<?php
if(!($stmt = $mysqli->prepare("SELECT customers.id, customers.lname FROM customers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id17, $custName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id17 . ' "> ' . $custName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		
		<fieldset>
			<legend>Assign Driver</legend>
			<select name="dassign">
<?php
if(!($stmt = $mysqli->prepare("SELECT drivers.id, drivers.lname FROM drivers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id16, $driverName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id16 . ' "> ' . $driverName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>

		<p>
			<input type="submit" name="add" value="add customer" />
		</p>
	</form>
</div>

</div>
</div>
</div>

<!-- DRIVERS -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
        VIEW DRIVERS</a>
      </h4>
    </div>
	<div id="collapse8" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>DRIVERS</td>
		</tr>
		<tr>
			<th>Employee Number</th>
			<th>First Name</th>
			<th>Last Name</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT drivers.id, drivers.fname, drivers.lname FROM drivers"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($driverID, $driverFirst, $driverLast)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $driverID . "\n</td>\n<td>\n" . $driverFirst . "\n</td>\n<td>\n" . $driverLast . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>

<div>
	<form method="post" action="drivers.php"> 

		<fieldset>
			<legend>First Name</legend>
			<p>Enter First Name: <input type="text" name="driverFirst" /></p>
		</fieldset>
		
		<fieldset>
			<legend>Last Name</legend>
			<p>Enter Last Name: <input type="text" name="driverLast" /></p>
		</fieldset>

		<fieldset>
			<legend>Assignment</legend>
			<select name="selectLocale">
<?php
if(!($stmt = $mysqli->prepare("SELECT id, name FROM geographical_locale"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($id8, $localeName)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
	echo '<option value=" '. $id8 . ' "> ' . $localeName . '</option>\n';
}
$stmt->close();
?>
			</select>
		</fieldset>
		<p>
			<p>*To Delete a driver, Enter his or her Last Name and select delete*</p>
			<input type="submit" name="add" value="add" />
			<input type="submit" name="delete" value="delete" />
		</p>
	</form>
</div>
</div>
</div>
</div>

<!-- GEOGRAPHICAL LOCALES -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
        GEOGRAPHICAL LOCALES</a>
      </h4>
    </div>
	<div id="collapse9" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<table>
		<tr>
			<td>LOCALES TABLE</td>
		</tr>
		<tr>
			<th>Name</th>
			<th>Main Driver</th>
		</tr>

<?php
if(!($stmt = $mysqli->prepare("SELECT geographical_locale.name, drivers.lname FROM geographical_locale INNER JOIN drivers ON drivers.works = geographical_locale.id"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($loc_name, $d_last)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 echo "<tr>\n<td>\n" . $loc_name . "\n</td>\n<td>\n" . $d_last . "\n</td>\n</tr>";
}
$stmt->close();
?>
	</table>
</div>
</div>
</div>
</div>
<!-- Filter by Cuisine Type -->
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
        FILTER BY CUISINE TYPE</a>
      </h4>
    </div>
	<div id="collapse10" class="panel-collapse collapse">
	
<div class="panel-body" >
<div>
	<form method="post" action="filter.php">
		<fieldset>
			<legend>Filter By Cuisine</legend>
				<select name="cuisineFilter">
					<?php
					if(!($stmt = $mysqli->prepare("SELECT id, name FROM cuisine_type"))){
						echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
					}

					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($id10, $ctname)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
					 echo '<option value=" '. $id10 . ' "> ' . $ctname . '</option>\n';
					}
					$stmt->close();
					?>
				</select>
		</fieldset>
		<input type="submit" value="Run Filter" />
	</form>
</div>
</div>
</div>
</div>


<!-- Close out jumbotron -->
</div>
</div>


