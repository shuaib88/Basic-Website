<?php

//referencing connection parameters
require('config.php');


// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';


// Get the the top ten tracks
$query = "SELECT person.personName, F.playlistName, F.numLikes
FROM person
JOIN (SELECT playlistName, numLikes, playlistownerID
FROM playlist
ORDER By numLikes desc limit 10) as F
ON person.personID = F.playlistownerID" ;

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

// Printing user attributes in HTML

print '<ul>';  
print "<li><b><u> Publisher Name, Playlist Name, Number of Likes </b></u>";
while ($tuple = mysqli_fetch_row($result)) {
   print "<li>$tuple[0]" . ", " . "$tuple[1]" . ", " . "$tuple[2]";
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 