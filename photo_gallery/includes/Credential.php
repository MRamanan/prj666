<?php
//require_once('database.php');
require_once('initialize.php');

class Credential extends Database_Object{
	public $UserId;
	public $Id;
	public $Username;
	public $UserPassword;
	public $TypeofUser;
	protected static $table_name = "Credential";
	protected static $db_fields = array('Id','Username','UserPassword','TypeofUser');
	

	public static function authenticate($username="", $password=""){
		global $database;
		$username = $database->mysql_prep($username);
		$password = $database->mysql_prep($password);

		$sql = "Select * from Credential where username = '{$username}' AND UserPassword = '{$password}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function exist_authenticate($username=""){
		global $database;
		$username = $database->mysql_prep($username);
		$sql = "Select * from Credential where Username = '{$username}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
}



?>