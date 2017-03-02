<?php
//require_once('database.php');
require_once('initialize.php');

class User2 extends database_object{
	public $Id;
	public $height;
	public $weight;
	public $age;
	protected static $table_name = "user2";
	protected static $db_fields = array('Id','username','password', 'first_name', 'last_name');
	public function UserCreate(){
		global $database;
		$contact_information = new contact_information();
		$contact_information->FirstName = $this->FirstName;
		$contact_information->LastName = $this->LastName;
		$contact_information->title = $this->gender;
		$contact_information->create();		
		$credentials = new Credential();			
		$credentials->Username= $this->Username;
		$credentials->UserPassword =$this->UserPassword;
		$credentials->Id = $contact_information->Id;
		$credentials->TypeofUser = "U";
		$credentials->create();	
		$this->Id = $contact_information->Id;
		$this->create();
	}
	// public static function find_all(){
	// 	return self::find_by_sql("select * from users");
	// }

	// public static function find_by_id($id=0){
	// 	global $database;
	// 	$result_array = self::find_by_sql("SELECT * FROM users WHERE id={$id} LIMIT 1");
	// 	return !empty($result_array) ? array_shift($result_array) : false;
	// }

	// public static function find_by_sql($sql=""){
	// 	global $database;
	// 	$result_set = $database->query($sql);
	// 	$object_array = array();
	// 	while($row = $database->fetch_array($result_set)){
	// 		$object_array[] = self::instantiate($row);
	// 	}
	// 	return $object_array;
	// }

	public static function authenticate($username="", $password=""){
		global $database;
		$username = $database->mysql_prep($username);
		$password = $database->mysql_prep($password);

		$sql = "Select * from users where username = '{$username}' AND password = '{$password}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function exist_authenticate($username=""){
		global $database;
		$username = $database->mysql_prep($username);
		$sql = "Select * from user2 where username = '{$username}' LIMIT 1";
		$result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_id($id=0){
		global $database;
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}



	// private static function instantiate($record){
	// 	$object = new self;
	// 	// $object->id = $record['id'];
	// 	// $object->username = $record['username'];
	// 	// $object->password = $record['password'];
	// 	// $object->first_name = $record['first_name'];
	// 	// $object->last_name = $record['last_name'];

	// 	//better approach for above object 
	// 	foreach($record as $attribute=>$value){
	// 		if($object->has_attribute($attribute)){
	// 			$object->$attribute = $value;
	// 		}
	// 	}
	// 	return $object;
	// }

	// private function has_attribute($attribute){
	// 	$object_vars = get_object_vars($this);
	// 	return array_key_exists($attribute, $object_vars);
	// }

	// public function full_name(){
	// 	if(isset($this->first_name) && isset($this->last_name)) {
	// 		return $this->first_name . " " . $this->last_name;
	// 	}else{
	// 		return "";
	// 	 }
	// 	}


	// protected function has_attribute($attribute) {
	//   // We don't care about the value, we just want to know if the key exists
	//   // Will return true or false
	//   return array_key_exists($attribute, $this->attributes());
	// }

	// protected function attributes() { 
	// 	// return an array of attribute names and their values
	//   $attributes = array();
	//   foreach(self::$db_fields as $field) {
	//     if(property_exists($this, $field)) {
	//       $attributes[$field] = $this->$field;
	//     }
	//   }
	//   return $attributes;
	// }
	
	// protected function sanitized_attributes() {
	//   global $database;
	//   $clean_attributes = array();
	//   // sanitize the values before submitting
	//   // Note: does not alter the actual value of each attribute
	//   foreach($this->attributes() as $key => $value){
	//     $clean_attributes[$key] = $database->mysql_prep($value);
	//   }
	//   return $clean_attributes;
	// }

}



?>