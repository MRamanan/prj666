<?php
require_once("../../includes/initialize.php");
$message = "";
if($session->is_logged_in()){
	redirect_to("index.php");
}
if(isset($_POST['submit'])){

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	// Check database to see if username/password exists
	
	$existing_user = Credential::exist_authenticate($username);
	$found_user = Credential::authenticate($username, $password);
  if(!$existing_user){
		$message = "Username does not exist";
	}
	else if($found_user){
		$session->login($found_user);
    if($found_user->TypeofUser == 'D')
      redirect_to("index2.php");
    else  
		  redirect_to("index.php");
	} 
  else{
		$message = "Username/ password combination incorrect";
	}

} else { // Form has not been submitted 
	$username = "";
	$password = "";
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Dietican Login Page</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/main.css" media="all">
</head>
<body>
  <div id="header">
  	<h1> Dietican Login </h1>
  </div>
  <div id="main">
  	<h2> Staff Login</h2>
  	<?php echo output_message($message); ?>
  	<form action="login.php" method="post">
  		<table>
  			<tr>
  				<td>Username: </td>
  				<td> <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"/>
  				</td>
  				</tr>
  				<td>Password: </td>
  				<td> <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"/>
  				</td>
  			</tr>
  			<tr>
  				<td colspan="2">
  				<input type="submit" name="submit" value="login" />
  				 </td>
           <td colspan=""><a href="register.php">Register</a></td>
           <td>"              "</td>
           <td colspan=""><a href="register_dietician.php">DieticianRegister</a></td>
  			</tr>
  		</table>

  </div>
</body>
</html>
<?php if(isset($database)) {$database->close_connection();} ?>