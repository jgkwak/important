#!/usr/local/bin/php
<?php	
session_name('demo');
session_start();

// Variables: holding the user's name
// If an error message needs to be shown
// Placeholder variable
$_SESSION['name'];
$showMessage = false;
$w =0; 

//Checks to see if the user clicked the "back" button, if user wants to go back to the login page
if(isset($_POST['back'])) {
	header('Location: index.php');
}

//If the user submitted the register form, checks to see if the username is already in the database, if so will show an error message
if((checkUser($_POST['username'], $w, count($_SESSION['usernameArray'])) === true)) {
	$_SESSION['response'] = "alreadyRegistered";
	$showMessage = true;
}
//If the username is not found in the database yet, will add the username, name and password into the flat files. Then will show a successfully registered message
else {
	$usFile = fopen('username.txt','a') or die('cannot open');
	fwrite($usFile, $_POST['username']."\n");
	fclose($usFile);

	$nameFile = fopen('name.txt','a') or die('cannot open');
	fwrite($nameFile, $_POST['name']."\n");
	fclose($nameFile);

	$passFile = fopen('password.txt','a') or die('cannot open');
	fwrite($passFile, $_POST['pass']."\n");
	fclose($passFile);
	$_SESSION['response'] = "successRegister";
	$showMessage = true;
}

/**
This function will check to see if the inputted username is in the database

@param [String] user inputted username value
@param [Integer] number which will holds the array position number, so that we know which username in the array we're referring to
@param [Integer] number of usernames in the array

@return [Boolean] will return true if the username was found in the username validation array 
**/
function checkUser($user, &$counter, $userAmount) {
	for ($counter; $counter < $userAmount; $counter++){
		if(($user === $_SESSION['usernameArray'][$counter]) ){
			return true;
			break;
		}
	}
	return false;
}

/**
This function will open the username text file and add the usernames in an array
**/
function userList() {
	$userFile = trim(file_get_contents('username.txt'));
	$_SESSION['usernameArray'] = explode("\n", $userFile);
}

/**
This function will open the password text file and add the password in an array
**/
function passwordList() {
	$passwordFile = trim(file_get_contents('password.txt'));
	$_SESSION['passwordArray'] = explode("\n", $passwordFile);
}

/**
This function will open the name text file and add the names in an array
**/
function nameList() {
	$nameList = trim(file_get_contents('name.txt'));
	$_SESSION['nameArray'] = explode("\n", $nameList);
}
?>

<!DOCTYPE html>
<html lang = "en">	
<head>
	<title>Scheduler: Register</title>
	<link rel="stylesheet" type="text/css" href="login.css"/>
</head>
<body>
	<section >
		<!-- Welcome message-->
		<h1>Register</h1>

		<!-- Scrolling message -->
		<marquee behavior="scroll" direction="left"> 

			<!-- If the user submitted the register form-->
			<?php if (isset($_POST['register'])) {

				//Message if the inputted username is already in the database
				if($_SESSION['response'] === "alreadyRegistered") { ?>
					<span id="error">Already Registered. Please login.</span><?php
				}

				// Message if successfully registered
				else if($_SESSION['response'] === "successRegister") {?> 
					<span id="success">You are now registered.</span><?php 
				} 

				//Neither options, then no message
				else {}
			}

			//Standard message
			else {?>
				Please Register<?php
			}?>
		</marquee>

		<!-- Form to input their information -->
		<form name="form" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" >
			<input type= "text" id="username" name="username" placeholder="Username - Only Characters and Numbers allowed" pattern="[A-Za-z0-9\-]+" required/>
			<input type= "text" id="name" name="name" placeholder="First and Last Name - Only Characters allowed" pattern="[A-Za-z0-9\-]+" required/>
			<input type= "password" name="pass" placeholder="Password - Only Characters and Numbers allowed" pattern="[A-Za-z0-9\-]+" required/>
			<input type="submit" value="Submit" name="register"/>
		</form>
		<br>

		<!-- Takes user to the login page -->
		<a href = "index.php">Back</a>
	</section>
</body>
</html>

















