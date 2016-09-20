<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameter (tweet):
$groupName = $_REQUEST["groupName"];

// Get the the names of all users
$query = "SELECT B.personName
FROM grouplist A
JOIN person B
ON A.moderatorID = B.personID
WHERE A.groupName = '$groupName' " ;

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing user attributes in HTML
if($result->num_rows === 0) {
	echo 'No results';
}

else {
	print '<ul>';  
	print "<li><b><u> Moderator Name </b></u>";
	while ($tuple = mysqli_fetch_row($result)) {
	   print "<li>$tuple[0]";
	}
	print '</ul>';
}
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 