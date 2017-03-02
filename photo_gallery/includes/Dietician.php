<?php
//require_once('database.php');
require_once('initialize.php');

class Dietician extends Contact_information{
	public $DieticianId;
	public $Id;
	public $ContactStartTimeMonday;
	public $ContactEndTimeMonday;
	public $ContactStartTimeTuesday;
	public $ContactEndTimeTuesday;
	public $ContactStartTimeWednesday;
	public $ContactEndTimeWednesday;
	public $ContactStartTimeThursday;
	public $ContactEndTimeThursday;
	public $ContactStartTimeFriday;
	public $ContactEndTimeFriday;
	public $ContactStartTimeSaturday;
	public $ContactEndTimeSaturday;
	public $ContactStartTimeSunday;
	public $ContactEndTimeSunday;
	protected static $table_name = "Dietician";
	protected static $db_fields = array('DieticianId','ContactStartTimeMonday','ContactEndTimeMonday');

	
    public function createDietician(){
		global $database;
		// $sql = "Insert into users (";
		// $sql .= "username, password, first_name, last_name";
		// $sql .= ") VALUES ('";
		// $sql .= $this->username ."', '";
		// $sql .= $this->password ."', '";
		// $sql .= $this->first_name ."', '";
		// $sql .= $this->last_name ."')";
		

		$contact_information = new contact_information();
		$contact_information->FirstName = $this->FirstName;
		$contact_information->LastName = $this->LastName;
		$contact_information->title = $this->gender;
		$contact_information->create();		
		$credentials = new Credential();			
		$credentials->Username= $this->Username;
		$credentials->UserPassword =$this->UserPassword;
		$credentials->Id = $contact_information->Id;
		$credentials->TypeofUser = "D";
		$credentials->create();	
		$this->DieticianId = $this->Id = $contact_information->Id;
		$this->create();
	}

	public function addUser($idx=0){
		global $database;
		$sql = "Insert into dieticianuser (DieticianId, ClientId) Values({$this->Id},{$idx})";
		if($database->query($sql)){
			return true;
		}
		else 
			return false;
	}
	
	
}



?>