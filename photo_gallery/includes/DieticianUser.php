<?php
//require_once('database.php');
require_once('initialize.php');

class DieticianUser extends Database_Object{
	public $DieticianId;
	public $ClientId;
	protected static $table_name = "DieticianUser";
	protected static $db_fields = array('DieticianId','ContactStartTimeMonday','$ContactEndTimeMonday');
	
}



?>