#!/usr/local/bin/php
<?php
ob_start();
@session_name('demo');
@session_start();

//saves the name and the username of the user
$name = $_SESSION['name'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>

<!-- If the user is loggedin correctly, will show them the content, if not, a message will be shown to login properly. -->
<?php
if(isset($_SESSION['loggedin']) or $_SESSION['loggedin']) {?>

<html lang = "en">	
<head>
	<link rel="stylesheet" type="text/css" href="home.css"/>
	<script src ="home.js" defer></script>
	<title>Scheduler: Homepage</title>
</head>
<body>
	<section>
		<!-- Welcome message -->
		<h1>Welcome <span id="welcomeName"><?php echo"$name"?></span> to your Scheduler!</h1>

		<!-- Scrolling message -->
		<marquee behavior="scroll" direction="left">You don't have to worry about remembering all your tasks anymore! Store all of your tasks using Scheduler!</marquee>

		<!-- 4 option buttons -->
		<input type="button" value="View Events" onclick="viewEvent()"/>
		<input type="button" value="Create Events" onclick="addEvent()"/>
		<input type="button" value="Remove Events" onclick="editEvent()"/>
		<a href = "logout.php"><input id="logout" type="submit" value="Logout" name="logout" /></a>
		
		<!-- View Events section, contains an iframe that'll load the data.php, which creates the table -->
		<article id="view">
			<br>
			<fieldset id="tableView">
				<legend>View Events</legend>

				<iframe name="example" src="data.php"></iframe>
			</fieldset>
		</article>

		<!-- Create Events section -->
		<article id="create">
			<br>
			<form action="data.php" method="post" target="example">
				<fieldset>
					<legend>Create Event</legend>	
					
					<p>Submit the Event information you would like to put into your schedule.<br><span id="error">NOTE: Please input only letters and numbers unless otherwise noted.</span></p>
					<hr>
					<br>

					<!-- Text inputs-->
					<input type="text" id="event_title" name="event_title"  pattern = "[0-9A-Za-z\s]+" placeholder="Event Title" required />
					<input type="text" id="event_date" name="event_date" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="Event Date - YYYY-MM-DD (e.g. 2015-12-25)" required/>
					<input type="text" id="event_time" name="event_time" pattern="[0-9]{2}:[0-9]{2}[A-Za-z]{2}" placeholder="Event Time - HH:MMAM/PM (e.g. 04:00PM)" required />
					
					<br>
					
					<!-- Submit button -->
					<input type="submit" value="Create event" name = "create"/>
					
					<br>
					<br>
					
					<!-- Instructions on what to do after pressing the submit button -->
					<small>After submission, check "View Events" to see if the request was processed. <br> Then clear the textbox in this form using the "Clear Text" button below.</small>
				</fieldset>
			</form>		

			<!-- Clear Text button -->		
			<input type="submit" id = "clear" value="Clear Text" name = "clear" onclick="eventClear();"/>
		</article>
		

		<!-- Remove Events section -->
		<article id="edit">	
			<br>
			<form action="data.php" method="post" target="example">
				<fieldset>
					<legend>Remove Event</legend>
					
					<p>Submit the Event ID of the event you want to remove.<br><span id="error">NOTE: Please input only letters and numbers unless otherwise noted.</span></p>
					<hr>
					<br>
					
					<!-- Text inputs-->
					<input type="text" id="event_code" name="event_code" pattern="[A-Za-z]{3}[0-9]+" placeholder="Event ID - Found on the first column on 'View Events' (e.g. jgk100)" required/>
					
					<br>
					
					<!-- Submit button -->
					<input type="submit" value="Delete event" name = "delete"/>
					
					<br>
					<br>

					<!-- Instructions on what to do after pressing the submit button -->
					<small>After submission, check "View Events" to see if the request was processed. <br> Then clear the textbox in this form using the "Clear Text" button below.</small>
				</fieldset>
			</form>	

			<!-- Clear Text button -->			
			<input type="submit" id = "clear" value="Clear Text" name = "clear" onclick="eraseClear();"/>		
		</article>

	</section>

</body>
</html> <?php
}

else{ ?>

<!-- Page that'll be shown if you don't login correctly -->	
<html lang = "en">	
<head>
	<title>Login</title>
</head>
<body>
	<p>Please enter a valid username and password</p>
</body>
</html><?php
}?>