<?php
require_once("../../includes/initialize.php");
 $username = "";
 $message = "Defualt";
 $userContact = Contact_information::find_by_id($_SESSION['user_id']);
if (!$session->is_logged_in()){ redirect_to("login.php");}

if(isset($_POST['submit2'])){
	$message = "started";
  	$this_dietician = new Dietician();
  	$this_dietician->Id = $userContact->Id;
	$AddUser = trim($_POST['username']);
  	$UserCredential = Credential::find_by_field("UserName",$AddUser);
  	$this_dietician->addUser($UserCredential->Id);
  	$message = "user added";


 } else { // Form has not been submitted 
 	$username = "Troll";
 	$message = "not addedd";
 }


?>
<html>
	<head>
	<title>Dietican Homepage</title>
	<link href= "../stylesheets/main.css" media-"all" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="header">
		  <h1>Dietican Homepage</h1>
		  </div>
		  <div id="main">

		  <a href="logout.php">Logout</a>
		  <?php 
		  //$user = User2::find_by_id($_SESSION['user_id']);
		  
		  echo "<h2>Welcome Dietician " . $userContact->full_name() . "</h2>";
		   ?>
		   <ul>

		   <li><a href="logout.php">Logout</a></li>
		   </ul>
<form action="index2.php" method="post">
  		<table>
  			<tr>
  				<td>Whod u like to add: </td>
  				<td> <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"/>
  				</td>
  				</tr>
  				<td colspan="2">
  				<input type="submit" name="submit2" value="add" />
		  <?php echo $message ?>
		  </div>

	

	</body>
</html><!-- 
if(isset($database)) {echo "true";} else {echo "false";}
echo "<br />";
echo "Is this working";
echo "<br />";
$user = User::find_by_id(3);
echo $user->full_name();
// echo $found_user['username'];
// echo "<br />";
// echo $found_user['last_name'];
echo "<hr />";

$users = User::find_all();
foreach($users as $user){
	echo "UserID: ". $user->username . "<br />";
	echo "Full_name: ". $user->full_name() . "<br /><br />";
}

?> -->