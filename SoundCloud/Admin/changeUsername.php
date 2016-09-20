<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Assign input variables

$username = $_REQUEST["currentUsername"];
$passwordAttempt = $_REQUEST["password"];
$newUserName = $_REQUEST["newUsername"];

// check the password

$passwordCheckQuery = "SELECT username 
FROM person
WHERE password = '$passwordAttempt' and username = '$username' ";

$checkedUsername = mysqli_query($dbcon, $passwordCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);

// get the personID

$personIDquery = "SELECT personID FROM person WHERE username = '$tuple[0]' ";

$personID = mysqli_query($dbcon, $personIDquery)
  or die('Query failed: ' . mysqli_error($dbcon));

$personIDTuple = mysqli_fetch_row($personID);

// update the database if username and password agree

if ($username = $tuple[0]){
	$query = "UPDATE person 
		SET username = '$newUserName'
		WHERE password = '$passwordAttempt' and username = '$username' ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Your username has been updated, your new username is $newUserName";

	echo" <hr><b> back to people page: </b> <a href=http://cgi-cspp.cs.uchicago.edu/~ahmed1/cs53001/Person.html> People Page </a>" ; 
}

else {
	echo "<br> Sorry you might have entered the wrong password or username";

	echo" <hr><b> try Again: </b> <a href=https://mpcs53001.cs.uchicago.edu/~ahmed1/SoundCloud/Admin/Admin.html> Admin Page </a>" ;
}

// Free result
mysqli_free_result($personID);
mysqli_free_result($checkedUsername);

// Closing connection
mysqli_close($dbcon);
