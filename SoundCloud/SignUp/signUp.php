<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Assign input variables

$username = $_REQUEST["username"];
$passwordAttempt = $_REQUEST["password"];
$personName = $_REQUEST["fullName"];

// check the username

$usernameCheckQuery = "SELECT username 
FROM person
WHERE username = '$username' ";

$checkedUsername = mysqli_query($dbcon, $usernameCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);

// update the database if username has not been taken

if ( $tuple[0] != $username ){
	$query = "INSERT INTO person(likeNum, proStatus, username, password, personName)
		VALUES (0, 'false', '$username', '$passwordAttempt', '$personName

			') ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Welcome to SoundCloud!, your userName is: '$username' ";

	echo" <hr><b> back to home: </b> <a href=https://mpcs53001.cs.uchicago.edu/~ahmed1/SoundCloud/HomePage/Final.html> Home Page </a>" ; 
}

else {
	echo "<br> Sorry someone may have that username, try again";

	echo" <hr><b> try again </b> <a href=https://mpcs53001.cs.uchicago.edu/~ahmed1/SoundCloud/SignUp/signUp.html> Sign Up Page </a>" ;
}

// Free result
mysqli_free_result($checkedUsername);

// Closing connection
mysqli_close($dbcon);
?> 