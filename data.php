#!/usr/local/bin/php
<?php
ob_start();
@session_name('demo');
@session_start();

/**
This function accesses the SQL database, getting all the schedule information. It then creates the table that contains the user's schedule of events.
**/
function makeTable() {
	try {
		$mydb = new SQLite3('schedule.db');
	}
	catch(Exception $ex) {
		echo $ex->getMessage();
	}
	//Creates the schedule database if it doesn't exist
	$statement = "CREATE TABLE IF NOT EXISTS schedule(username TEXT, title TEXT, day INTEGER, hour INTEGER, value TEXT)";
	$run = $mydb->query($statement);

	//creating a unique Event ID code, combination of the user's username and the #entries in the schedule database
	$codePart1 = substr($_SESSION['username'], 0,3) ; 
	$codePart2 = $_SESSION['counter']."";
	$code = $codePart1.$codePart2;

	//increments the counter, keeping track of number of events in the schedule database
	$_SESSION['counter']++;
	
	//gathering all of the variables that the user inputted in order to put it into the database
	$username = $_SESSION['username'];
	$eventTitle = $_POST['event_title'];
	$eventDate = $_POST['event_date'];
	$eventTime = $_POST['event_time'];

	//inputting info into the database
	$statement = "INSERT INTO schedule(username, title, day, hour, value) VALUES ('$username', '$eventTitle', '$eventDate', '$eventTime', '$code')";
	$run = $mydb->query($statement);
	
	//if the delete button was pressed, will delete the event that matches the event code that was inputted from the user, from the database
	if(isset($_POST['delete'])) {
		$delValue =$_POST['event_code'];
		$mydb->query("DELETE FROM schedule WHERE value='$delValue'");
	}

	//selects the data that's associated with the user from the database, ordering the data by the date then time.
	$statement = "SELECT username, title, day, hour, value FROM schedule WHERE username='$username' AND (title is not null and title <> '') ORDER BY day ASC, hour ASC, title ASC";
	$run = $mydb->query($statement);


	//creates the table, first with the header, then an loop is run to go through all of the data that was selected
	echo "<table>
			<tr>
			<th>Event ID</th> <th>Event Title</th> <th>Event Date</th> <th>Event Time</th>
			</tr>";

		if($run) {
			while($row = $run->fetchArray()){
				echo "<tr><td>", $row['value'],"</td><td>",$row['title'], "</td><td>", $row['day'],  "</td><td>", $row['hour'], "</td></tr>"; 
			}
	echo"</table>";
	}
}
?>

<!DOCTYPE html>
<html lang = "en">	
<head>
	<title>Scheulder: Data</title>
	<link rel="stylesheet" type="text/css" href="data.css"/>
</head>
<body>
	<!-- calls the function to create the schedule table -->
	<?php
		makeTable();
	?>
</body>
</html>





