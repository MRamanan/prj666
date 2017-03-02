<?php
class Daily_intake extends Database_Object{
	public $ID;
	public $DATE;
	public $MEAL_TIME;
	public $FOOD_NAME;
	public $FOOD_BRAND;
	public $FAT;
	public $CALORIES;
	public $SODIUM;
	protected static $table_name = "dailyintake";
	protected static $db_fields = array('Id','DATE','MEAL_TIME', 'FOOD_NAME', 'FOOD_BRAND', 'FAT', 'CALORIES', 'SODIUM');

}


?>