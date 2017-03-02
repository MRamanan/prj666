<?php 
require_once('initialize.php');


class Database_Object{

	public static function find_all(){
		return static::find_by_sql("select * from ".static::$table_name);
	}

	public static function find_by_field($field="",$id=""){
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE {$field} = '{$id}' LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_id($id=0){
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id={$id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
	}

	public static function find_by_sql($sql=""){
		global $database;
		$file="sql_test2.txt";
		file_put_contents($file,$sql."\r\n",FILE_APPEND);
		$result_set = $database->query($sql);
		$object_array = array();
		while($row = $database->fetch_array($result_set)){
			$object_array[] = static::instantiate($row);
		}
		return $object_array;
	}

	private static function instantiate($record){
		$object = new static;
		// $object->id = $record['id'];
		// $object->username = $record['username'];
		// $object->password = $record['password'];
		// $object->first_name = $record['first_name'];
		// $object->last_name = $record['last_name'];

		//better approach for above object 
		foreach($record as $attribute=>$value){
			if($object->has_attribute($attribute)){
				$object->$attribute = $value;
			}
		}
		return $object;
	}

	protected function has_attribute($attribute){
		$object_vars = get_object_vars($this);
		return array_key_exists($attribute, $object_vars);
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(static::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->mysql_prep($value);
	  }
	  return $clean_attributes;
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
	  	$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	 	 $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
		$file = 'sql_ramanan2.txt';
		file_put_contents($file, $sql."\r\n", FILE_APPEND);
		if($database->query($sql)){
			//$this->Id = $database->insert_id();
			return true;
		}
		else 
			return false;
	}

	public static function DieticianAddUser(){

		$sql = "INSERT INTO ".static::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	 	 $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	}






}


?>