#!/usr/local/bin/php
<?php
ob_start();
@session_name('demo');
@session_start();

//Variables: if correctly loggedin, 
//array to hold all the usernames in the system
//array to hold all the names in the system
//array to hold all the passwords in the system
//counter to keep track of how many inputs are in the database
$_SESSION['loggedin'] = false;
$_SESSION['usernameArray'] = [];
$_SESSION['nameArray'] = [];
$_SESSION['passwordArray'] = [];
$_SESSION['counter'];

//function to update the password, username and name array from the txt flat file
passwordList();
userList();
nameList();

/**
This function checks to see if the inputted username is valid (found in the registered username file)

@param [String] inputted username
@param [String] inputted password
@param [Integer] number that's passed by reference, which will hold the array position number, if the username is found in the array
**/
function validate($user, $pass, &$response) {
	//gets the number of username in the username array
	$userAmount = count($_SESSION['usernameArray']);
	$counter = 0;

	//checks to see if the username is in the database (flatfile)
	if(checkUser($user, $counter, $userAmount) === true) {

		//checks to see if the inputted password corresponds to the password matched with the username
		if (checkPassword($pass, $counter)===true) {
			//if true, will be set as logged in and the inputted username value and the name connected to that username will be saved
			//will take them to the welcome page
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $user;
			$_SESSION['name'] = $_SESSION['nameArray'][$counter];
			
			@header('Location: home.php');
		}

		//if the password doesn't match up, will give an error message
		else {
			$response ="passwordError";
		}
	}

	//if the username isn't in the database, will give an error message
	else {
		$response ="userError";
	}
}

//if the user clicks the 'login' button, will call the validate function
if (isset($_POST['login'])) {
	validate($_POST['username'],$_POST['pass'], $response);
}

//if the user clicks the 'register' button, no error message will be shown will take the user to the register page
if (isset($_POST['register'])) {
	$_SESSION['response'] = "none";
	@header('Location: register.php');
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
This function will check to see if the inputted password is found in the database

@param [String] password that the user inputted 
@param [Integer] number that'll indicate where in the array the password could be found

@return [Boolean] will return true if the password was found in the array (as in, it's a valid password)
**/
function checkPassword($pass, &$counter) {
	if ($pass === $_SESSION['passwordArray'][$counter]) {
		return true;
	}

	else{
		return false;
	}
}

/**
This function will open the username text file and add the usernames in an array
**/
function userList() {
	$userFile = trim(file_get_contents('username.txt'));
	$_SESSION['usernameArray'] = explode("\n", $userFile);
}

/**
This function will open the password text file and add the passwords in an array
**/
function passwordList() {
	$passwordFile = trim(file_get_contents('password.txt'));
	$_SESSION['passwordArray'] = explode("\n", $passwordFile);
}

/**
This function will open the name text file and add the names in an array
**/
function nameList(){
	$nameList = trim(file_get_contents('name.txt'));
	$_SESSION['nameArray'] = explode("\n", $nameList);
}
?>

<!DOCTYPE html>
<html lang = "en">	
<head>
	<script src ="index.js" defer></script>
	<link rel="stylesheet" type="text/css" href="login.css"/>
	<title>Scheduler: Login</title>
</head>
<body>
	<section>
		<!-- Welcome message-->
		<h1>Welcome to Scheduler!</h1>

		<!-- Scrolling message -->
		<marquee behavior="scroll" direction="left"> 
			<!-- Message if the user inputted an invalid username -->
			<?php 
			if($response === "userError") { ?>
				<span id="error">No such username. Please register. </span><?php 
			}

			// Message if the user inputted an invalid password
			else if($response === "passwordError") { ?>
				<span id="error">Your password is invalid.<?php
			} 

			// Standard message
			else{?>
				Please Login <?php
			}?>
		</marquee>

		<!-- Form to input their username and password -->
		<form name="form" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>" >
			<input type= "text" id="username" name="username" placeholder="Username" pattern="[A-Za-z0-9\-]+" required/>
			<input type= "password" name="pass" placeholder="Password" pattern="[A-Za-z0-9\-]+" required/>
			<input type="submit" value="Log in" name="login"/>
		</form>
		<br>

		<!-- Takes user to the register page -->
		<a href = "register.php">Register</a>
	</section>
</body>
</html>























