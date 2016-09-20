DROP TABLE IF EXISTS tag;
CREATE TABLE tag (
	tagID int PRIMARY KEY,
	tagName varchar(45)
);

# GROUP RELATIONS

DROP TABLE IF EXISTS grouplist;
CREATE TABLE grouplist (
	moderatorID int PRIMARY KEY AUTO_INCREMENT,
	groupName varchar(45),
	groupID int
);

DROP TABLE IF EXISTS grouplistLikes;
CREATE TABLE grouplistLikes (
	likerID int REFERENCES person(personID),
	groupID int REFERENCES grouplist(groupID),
	PRIMARY KEY (likerID, groupID)
);

DROP TABLE IF EXISTS grouplistFollows;
CREATE TABLE grouplistFollows (
	followerID int REFERENCES person(personID),
	grouplistID int REFERENCES grouplist(groupID),
	PRIMARY KEY (followerID, grouplistID)
);

#PERSON RELATIONS

DROP TABLE IF EXISTS person;
CREATE TABLE person (
	personID int PRIMARY KEY AUTO_INCREMENT,
	likeNum int,
	proStatus varchar(45),
	personName varchar(45),
	userName varchar(45),
	password varchar(45)
);

DROP TABLE IF EXISTS personFollows;
CREATE TABLE personFollows (
	leaderID int REFERENCES person(personID),
	followerID int REFERENCES person(personID),
	PRIMARY KEY (leaderID, followerID)
);

#TRACK RELATIONS

DROP TABLE IF EXISTS track;
CREATE TABLE track (
	trackID int PRIMARY KEY AUTO_INCREMENT,
	numLikes int,
	tagID int REFERENCES tag(tagID),
	shares int,
	trackName varchar(45),
	datestamp date,
	trackPosterID int REFERENCES person(personID)
);

DROP TABLE IF EXISTS playlist;
CREATE TABLE playlist (
	playlistID int PRIMARY KEY AUTO_INCREMENT,
	playlistName varchar(45),
	numLikes int,
	numReposts int,
	tagID int REFERENCES tag(tagID),
	playlistownerID int
);

DROP TABLE IF EXISTS playlistFollows;
CREATE TABLE playlistFollows (
	playlistID int REFERENCES playlist(playlistID),
	followerID int REFERENCES person(personID),
	PRIMARY KEY (playlistID, followerID)
);

DROP TABLE IF EXISTS playlistTags;

DROP TABLE IF EXISTS isInPlaylist;
CREATE TABLE isInPlaylist (
	trackID int REFERENCES track(trackID),
	playlistID int REFERENCES playlist(playlistID),
	PRIMARY KEY (trackID, playlistID)
);


DROP TABLE IF EXISTS trackTags;

## OTHER

DROP TABLE IF EXISTS message;
CREATE TABLE message (
	messageID int PRIMARY KEY AUTO_INCREMENT,
	senderID int REFERENCES person(personID),
	recipientID int REFERENCES person(personID),
	datestamp date,
	messageContent text (500)
);