# I loaded the data into my tables using MSQL Workbench

LOAD DATA
    LOCAL INFILE "data/tag.dat"
    REPLACE INTO TABLE tag
    FIELDS TERMINATED BY '|'
    (tagID, tagName);

# GROUP RELATIONS

LOAD DATA
    LOCAL INFILE "data/grouplist.dat"
    REPLACE INTO TABLE grouplist
    FIELDS TERMINATED BY '|'
    (moderatorID, groupName, groupID);

LOAD DATA
    LOCAL INFILE "data/grouplistLikes.dat"
    REPLACE INTO TABLE grouplistLikes
    FIELDS TERMINATED BY '|'
    (likerID, groupID);

LOAD DATA
    LOCAL INFILE "data/grouplistFollows.dat"
    REPLACE INTO TABLE grouplistFollows
    FIELDS TERMINATED BY '|'
    (followerID, grouplistID);

#PERSON RELATIONS

LOAD DATA
    LOCAL INFILE "data/person.dat"
    REPLACE INTO TABLE person
    FIELDS TERMINATED BY '|'
    (personID, likeNum, proStatus, personName, username, password);

LOAD DATA 
    LOCAL INFILE "data/personFollows.dat"
    REPLACE INTO TABLE personFollows 
    FIELDS TERMINATED BY '|'
    (leaderID, followerID);

#TRACK RELATIONS

LOAD DATA
    LOCAL INFILE "data/track.dat"
    REPLACE INTO TABLE track
    FIELDS TERMINATED BY '|'
    (trackID, numLikes, tagID, shares, trackName, datestamp, trackPosterID);

LOAD DATA
    LOCAL INFILE "data/playlist.dat"
    REPLACE INTO TABLE playlist
    FIELDS TERMINATED BY '|'
    (playlistID, playlistName, numLikes, numReposts, tagID, playlistownerID);

LOAD DATA 
    LOCAL INFILE "data/playlistFollows.dat"
    REPLACE INTO TABLE playlistFollows
    FIELDS TERMINATED BY '|'
    (playlistID, followerID);

LOAD DATA
    LOCAL INFILE "data/isInPlaylist.dat"
    REPLACE INTO TABLE isInPlaylist
    FIELDS TERMINATED BY '|'
    (trackID, playlistID);

## OTHER 

LOAD DATA
    LOCAL INFILE "data/message.dat"
    REPLACE INTO TABLE message
    FIELDS TERMINATED BY '|'
    (messageID, senderID, recipientID, datestamp, messageContent);