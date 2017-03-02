<?php
//require_once('database.php');
require_once('initialize.php');

class Contact_information extends Credential{
	public $Id;
	public $title;
	public $FirstName;
	public $LastName;
	public $PhoneNumber;
	public $Email;
	public $Street;
	public $City;
	public $PostalCode;
	protected static $table_name = "ContactInformation";
	protected static $db_fields = array('Id','title','FirstName', 'LastName', 'PhoneNumber', 'Email', 'Street', 'City', 'PostalCode');

	public function full_name(){
		if(isset($this->FirstName) && isset($this->LastName)) {
			return $this->FirstName . " " . $this->LastName;
		}else{
			return "";
		 }
		}

	public function create(){
		global $database;
		// $sql = "Insert into users (";
		// $sql .= "username, password, first_name, last_name";
		// $sql .= ") VALUES ('";
		// $sql .= $this->username ."', '";
		// $sql .= $this->password ."', '";
		// $sql .= $this->first_name ."', '";
		// $sql .= $this->last_name ."')";
		$attributes = $this->sanitized_attributes();
		if (array_key_exists("Id", $attributes))
			unset($attributes['Id']);
	  	$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	 	$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		$file = 'sql_ramanan.txt';
		file_put_contents($file, $sql."\r\n", FILE_APPEND);
		if($database->query($sql)){
			$this->Id = $database->insert_id();
			return true;
		}
		else 
			return false;
	}

	
	
}



?>