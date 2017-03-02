<?php
require_once("../includes/database.php");
require_once("../includes/user.php");


if(isset($database)) {echo "true";} else {echo "false";}
echo "<br />";
echo "Is this working";
echo "<br />";
$user = User2::find_by_id(9);
echo $user->full_name();
// echo $found_user['username'];
// echo "<br />";
// echo $found_user['last_name'];
echo "<br />";

$users = User2::find_all();
foreach($users as $user){
	echo "UserID: ". $user->username . "<br />";
	echo "Password: ". $user->password . "<br />";
	echo "Full_name: ". $user->full_name() . "<br /><br />";
}

?>