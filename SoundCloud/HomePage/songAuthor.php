<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameter (tweet):
$trackName = $_REQUEST["trackName"];

// Get the the names of all users
$query = "SELECT B.trackPosterID, A.personName 
FROM track B
JOIN person A
ON A.personID = B.trackPosterID
WHERE B.trackName = '$trackName' " ;

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing user attributes in HTML

if($result->num_rows === 0) {
	echo 'No results';
}

else {

	print '<ul>';  
	print "<li><b><u> userID" . ", " . "personName</b></u>";
	while ($tuple = mysqli_fetch_row($result)) {
	   print "<li>$tuple[0]" . ", " . "$tuple[1]";
	}
	print '</ul>';
}
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 