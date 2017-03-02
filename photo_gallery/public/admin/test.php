<?php 
require_once('../../includes/initialize.php');





?>

<?php 
$user = new User();
$user->username = "raamsaf";
$user->password = "ABCD123";
$user->first_name = "Jogn";
$user->last_name = "SMITH";
$user->create();
?>
