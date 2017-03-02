<?php
require_once("../../includes/initialize.php");

if(isset($_POST['json'])){
	$obj = jsonString2Obj($_POST['json']);
//print_r($_POST['json']);
//echo ($_POST['json'][0]['item_name']);
	echo "********";
//print_r($obj);
	foreach ($obj as  $objy){
		echo "\nAbout to insert\n";
		$DailyLogInsert = new Daily_intake();
		echo "Created class sucessfully\n";
		if(isset($objy->item_name)){
			$DailyLogInsert->Id = $obj->Session_id;
			$DailyLogInsert->DATE = date("Y-m-d");
			$DailyLogInsert->MEAL_TIME = $objy->mealTime;
			$DailyLogInsert->FOOD_NAME = $objy->item_name;
			$DailyLogInsert->FOOD_BRAND = $objy->brand_name;
			$DailyLogInsert->FAT = $objy->nf_total_fat;
			$DailyLogInsert->CALORIES = $objy->nf_calories;
			$DailyLogInsert->SODIUM = $objy->nf_sodium; 
			
			$DailyLogInsert->create();
			
		}
	}
	echo "\nFinished 2insert\n";
	echo "********\n";
	echo $obj->Session_id;

}
else $obj = 'none';



// echo $_POST['json'];

function jsonString2Obj($str){
	
	return json_decode(stripslashes($str));
}









?>