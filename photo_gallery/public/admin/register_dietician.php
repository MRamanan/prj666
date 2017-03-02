<?php
require_once("../../includes/initialize.php");
$message = "";
  $username = "";
  $password = "";
  $f_name = "";
  $l_name = "";

// if($session->is_logged_in()){
// 	redirect_to("index.php");
// }
if(isset($_POST['submit'])){
  $new_dietician = new Dietician();
	$new_dietician->Username = trim($_POST['username']);
	$new_dietician->UserPassword = trim($_POST['password']);
  $new_dietician->LastName = trim($_POST['l_name']);
  $new_dietician->FirstName = trim($_POST['f_name']);
  $new_dietician->gender = trim($_POST['gender']);
  $new_dietician->createDietician();
  $message = "dietician created";

// 	// Check database to see if username/password exists
// 	$found_user = User::authenticate($username, $password);
// 	$existing_user = User::exist_authenticate($username);
// 	if(!$existing_user){
// 		$message = "Username does not exist";
// 	}

// 	elseif($found_user){
		$session->login($new_dietician);
		redirect_to("index2.php");
// 	} else{
// 		$message = "Username/ password combination incorrect";
// 	}

 } else { // Form has not been submitted 
 	$username = "";
 	$password = "";
  $f_name = "";
  $l_name = "";

 }



?>
<!DOCTYPE html>
<html>
<head>
	<title>Dietican registration Page</title>
	<link rel="stylesheet" type="text/css" href="../stylesheets/main.css" media="all">
</head>
<body>
  <div id="header">
  	<h1> Dietican Login </h1>
  </div>
  <div id="main">
  	<h2> Dietician Registraion</h2>
  	<?php echo output_message($message); ?>
  	<form action="register_dietician.php" method="post">
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
            <td>First Name: </td>
          <td> <input type="text" name="f_name" maxlength="30" value="<?php echo htmlentities($f_name); ?>"/>
          </td>
          </tr>
              <td>Last Name: </td>
          <td> <input type="text" name="l_name" maxlength="30" value="<?php echo htmlentities($l_name); ?>"/>
          </td>
          </tr>
          <tr>
            <td>Prefix: </td>
          <td> <select name="gender" maxlength="30">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
          </td>
          </tr>
  				<td colspan="2">
  				<input type="submit" name="submit" value="register" />
          <td colspan="2"><a href="login.php">Login</a></td>
  				 </td>
  			</tr>
  		</table>

  </div>
</body>
</html>
<?php if(isset($database)) {$database->close_connection();} ?>