<?php
require_once("../../includes/initialize.php");

if (!$session->is_logged_in()){ redirect_to("login.php");}
?>
<html>
	<head>
	<title>Dietican Homepage</title>
	<link href= "../stylesheets/main.css" media-"all" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header">
		  <h1>Client Homepage</h1>
		  </div>
		  <div id="main">
		  <h2>Client</h2>
		  <li><a href="logout.php">Logout</a></li>
		  <?php 
		  global $database;
		  
		  $result_set = $database->query("Select * from dailyintake where ID=2 order by Date");
		  $userContact = Contact_information::find_by_id($_SESSION['user_id']);
		  $id = $_SESSION['user_id'];
		  //print_r($userContact);
		  $past_food_items = Daily_intake::find_by_sql("Select * from dailyintake where ID=".$id." order by Date");
		 
		  $new_past_food_items = array();
		  $food_num = 0;
		  foreach($past_food_items as $value){
		  	if(isset($new_past_food_items[$value->DATE][$value->MEAL_TIME])){
		  		$food_num = count($new_past_food_items[$value->DATE][$value->MEAL_TIME]);
		  	}
		  	else 
		  		$food_num = 0;
		  	$new_past_food_items[$value->DATE][$value->MEAL_TIME][$food_num]["Food_name"] = $value->FOOD_NAME;
		  	
		  }
		 
		  echo "<h2>Welcome " . $userContact->full_name() . "</h2>";
		  
		  //format the user daily log by dates and food itesm 
		  foreach(array_keys($new_past_food_items) as $date => $value){
		  	echo $value;
		  	echo "<br />";
		  	foreach(array_keys($new_past_food_items[$value]) as $meal_time => $value2){
		  		echo $value2;
		  		echo "<br />";
		  		for($x = 0; $x < count($new_past_food_items[$value][$value2]); $x++){
		  			echo $new_past_food_items[$value][$value2][$x]["Food_name"];
		  			echo "<br />";
		  		}
		  	}
		  	echo "<br />";
		  }
		   ?>
		   <ul>
		   <li><a href="add_food.php">Add food</a></li>
		   <li><a href="logout.php">Logout</a></li>
		   </ul>
		  </div>
		  <p></p>

	</body>
</html><!-- 
if(isset($database)) {echo "true";} else {echo "false";}
echo "<br />";
echo "Is this working";
echo "<br />";
$user = User::find_by_id(3);
echo $user->full_name();
// echo $found_user['username'];
// echo "<br />";
// echo $found_user['last_name'];
echo "<hr />";

$users = User::find_all();
foreach($users as $user){
	echo "UserID: ". $user->username . "<br />";
	echo "Full_name: ". $user->full_name() . "<br /><br />";
}

?> -->