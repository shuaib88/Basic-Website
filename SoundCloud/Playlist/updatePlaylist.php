<?php

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'ahmed1';
$password = '1660Mvemjbu9';
$database = $username . 'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Assign input variable

$username = $_REQUEST["username"];
$password = $_REQUEST["password"];
$playlistName = $_REQUEST["playlistName"];
$newPlaylistName = $_REQUEST["newPlaylistName"];

// check the password

$passwordCheckQuery = "SELECT username 
FROM person
WHERE password = '$password' and username = '$username' ";

$checkedUsername = mysqli_query($dbcon, $passwordCheckQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$tuple = mysqli_fetch_row($checkedUsername);


// get the personID

$personIDquery = "SELECT personID FROM person WHERE username = '$tuple[0]' ";

$personID = mysqli_query($dbcon, $personIDquery)
  or die('Query failed: ' . mysqli_error($dbcon));

$personIDTuple = mysqli_fetch_row($personID);


// get the playlistID

$playlistIDquery = "SELECT playlistID, playlistownerID 
					FROM playlist 
					WHERE playlistName = '$playlistName' and playlistownerID = '$personIDTuple[0]' ";

$playlistID = mysqli_query($dbcon, $playlistIDquery)
  or die('Query failed: ' . mysqli_error($dbcon));

$playlistIDTuple = mysqli_fetch_row($playlistID);


// get the playlist poster Name

$posterNameQuery = "SELECT B.username 
					FROM person B
					JOIN playlist A
					ON A.playlistownerID = B.personID
					WHERE playlistName = '$playlistName' and A.playlistownerID = '$playlistIDTuple[1]' ";

$posterName = mysqli_query($dbcon, $posterNameQuery)
  or die('Query failed: ' . mysqli_error($dbcon));

$posterNameTuple = mysqli_fetch_row($posterName);


// update the database if username and password agree

if ($username = $tuple[0] = $posterNameTuple[0]){
	$query = " UPDATE playlist
				SET playlistName = '$newPlaylistName'
				WHERE playlistID = $playlistIDTuple[0] ";

	mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	echo "<br> Your playlist has been updated,
			it is now called '$newPlaylistName' ";

	echo" <hr><b> back to playlist page: </b> <a href=https://mpcs53001.cs.uchicago.edu/~ahmed1/SoundCloud/Playlist/Playlist.html> Playlist Page </a>" ; 
}

else {
	echo "<br> Sorry you might have entered the wrong password, username or playlist name";

	echo" <hr><b> try Again: </b> <a href=https://mpcs53001.cs.uchicago.edu/~ahmed1/SoundCloud/Playlist/Playlist.html> Playlist Page </a>" ;
}

// Free result
mysqli_free_result($personID);
mysqli_free_result($checkedUsername);
mysqli_free_result($playlistID);
mysqli_free_result($posterName);


// Closing connection
mysqli_close($dbcon);

?> 