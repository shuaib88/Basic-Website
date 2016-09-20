<?php

//referencing connection parameters
require('config.php');

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameter (tweet):
$tagName = $_REQUEST["tagName"];

// Get the playlists with the tag
$query1 = "SELECT A.tagName, B.playlistName
FROM tag A
JOIN playlist B
ON A.tagID = B.tagID
WHERE A.tagName = '$tagName' " ;

$result1 = mysqli_query($dbcon, $query1)
  or die('Query failed: ' . mysqli_error($dbcon));


// Get the tracks with the tag
$query2 = "SELECT A.tagName, B.trackName
FROM tag A
JOIN track B
ON A.tagID = B.tagID
WHERE A.tagName = '$tagName' " ;

$result2 = mysqli_query($dbcon, $query2)
  or die('Query failed: ' . mysqli_error($dbcon));


// Printing user attributes in HTML
if($result1->num_rows === 0 and $result2->num_rows === 0) {
	echo 'No results';
}

else {

	print '<ul>';  
	print "<li><b><u> tagName" . ", " . "playlistName</b></u>";
	while ($tuple = mysqli_fetch_row($result1)) {
	   print "<li>$tuple[0]" . ", " . "$tuple[1]";
	}
	print '</ul>';

	print '<ul>';  
	print "<li><b><u> tagName" . ", " . "trackName</b></u>";
	while ($tuple2 = mysqli_fetch_row($result2)) {
	   print "<li>$tuple2[0]" . ", " . "$tuple2[1]";
	}
	print '</ul>';

}

// Free result
mysqli_free_result($result1);
mysqli_free_result($result2);

// Closing connection
mysqli_close($dbcon);
?> 