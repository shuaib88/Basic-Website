#creating fake data that can allow for joins accross relations

from faker import Factory
import random
import tagArray

fake = Factory.create()


#access the previously created .dat files


tagFile = open('tag.dat', 'w')

personFile = open('person.dat', 'w')
personFollowsFile = open('personFollows.dat', 'w')

grouplistFile = open('grouplist.dat', 'w')
grouplistLikesFile = open('grouplistLikes.dat', 'w')
grouplistFollowsFile = open('grouplistFollows.dat', 'w')

trackFile = open('track.dat','w')
playlistFile = open('playlist.dat', 'w')
playlistFollowsFile = open('playlistFollows.dat', 'w')
isInPlaylistFile = open('isInPlaylist.dat', 'w')

messageFile = open('message.dat', 'w')

##############
#tag
tagID = []
# tagName = []

# person
personID = []
likeNum = []
proStatus = []
personName = []
username = []
password = []

#personFollows

#grouplist
grouplistID = []
grouplistName = []
# moderatordID == personID []

# grouplistLikes
# personID = []
# grouplistID =[]

# grouplistFollows
# personID = []
# grouplistID =[]

# playlist
playlistID = []
playlistName = []
numLikes = []
numReposts = []
# tagID = []
# personID = []

#track
trackID = []
numLikes2 = []
#tagID = [] (foreign random from tag)
shares = []
trackName  = []

#isInPlaylist
#trackID = [] (foreign try to put 4-10 tracks in playlist)
#playlistID = [] (foreign use all existing playlists)

#message
messageID = []
# senderID REFERENCES person(personID),
# recipientID REFERENCES person(personID),
datestamp = []
messageContent = [] #text (limit text length to 300 characters)


##############
uniqueID = 100000
#create lists
for i in range(0,500):

	uniqueID += 1
	tagID.append(uniqueID)

	# no = fake.word()
	# tagName.append(no)

uniqueUsername = 100000



# person Table 
for i in range(0, 2000):

	uniqueID += 1
	personID.append(uniqueID)

	to = fake.random_int(min=0, max=99999)
	likeNum.append(to)

	so = fake.boolean()
	proStatus.append(so)

	no = fake.name()
	personName.append(no)

	uniqueUsername += 1
	username.append(uniqueUsername)

	qq = fake.word()
	password.append(qq)


# groupList

for i in range(0,500):

	uniqueID += 1
	grouplistID.append(uniqueID)

	no = fake.text(max_nb_chars = 50)
	grouplistName.append(no)

	# moderatordID == personID []

# playlist

for i in range(0, 400):
	
	uniqueID += 1
	playlistID.append(uniqueID)

	mo = fake.sentence(nb_words=2, variable_nb_words=True)
	playlistName.append(mo)

	to = fake.random_int(min=0, max=9999)
	numLikes.append(to)

	ro = fake.random_int(min=0, max=999)
	numReposts.append(ro)

	# tagID = []
	# personID = []

# track

for i in range(0, 4000):

	uniqueID += 1
	trackID.append(uniqueID)

	qo = fake.random_int(min=0, max=9999)
	numLikes2.append(qo)

	#tagID = [] (foreign random from tag)

	mo = fake.random_int(min = 0, max =9999)
	shares.append(mo)

	to = fake.sentence(nb_words=5, variable_nb_words=True)
	trackName.append(to)

#isInPlaylist

#trackID = [] (foreign try to put 4-10 tracks in playlist)
#playlistID = [] (foreign use all existing playlists)


#message

for i in range(0,400):

	uniqueID += 1
	messageID.append(uniqueID)

	# senderID REFERENCES person(personID),
	# recipientID REFERENCES person(personID),

	no = fake.date(pattern="%Y-%m-%d")
	datestamp.append(no)

	mo = fake.text(max_nb_chars=300)
	messageContent.append(mo) #(limit text length to 300 characters)


##############
# write tables
# tag

for i in range(1,501):
	tag = str(tagID[i-1]) + "|" + str(tagArray.tagName[i-1]) + "\n" 
	tagFile.write(tag)

# person

for i in range(1,2001):
	person = str(personID[i-1]) + "|" + str(likeNum[i-1]) + "|" + \
			str(proStatus[i-1]) + "|" + str(personName[i-1]) + "|" + \
			str(username[i-1]) + "|" + str(password[i-1]) + "\n"
	personFile.write(person)

# personfollows

for i in range (1, 501):
	personFollowerIndex = random.randrange(600,700)
	pf = str(personID[i-1]) + "|" + str(personID[personFollowerIndex]) + "\n"
	personFollowsFile.write(pf)

for i in range (1, 501):
	personFollowerIndex = random.randrange(0, 100)
	pf = str(personID[i+150]) + "|" + str(personID[personFollowerIndex]) + "\n"
	personFollowsFile.write(pf)

# groupList

for i in range(1, 501):
	groups = str(random.choice(personID)) + "|" + grouplistName[i-1] + \
			"|" + str(grouplistID[i-1]) + "\n"
	grouplistFile.write(groups)

# grouplistLikes

for i in range(1, 201):
	grouplistLike = str(personID[i-1]) + "|" + str(grouplistID[i-1]) + "\n"
	grouplistLikesFile.write(grouplistLike)

for i in range(1, 201):
	grouplistLike = str(personID[i-1]) + "|" + str(grouplistID[i+50]) + "\n"
	grouplistLikesFile.write(grouplistLike)

for i in range(1, 201):
	grouplistLike = str(personID[i-1]) + "|" + str(grouplistID[i+25]) + "\n"
	grouplistLikesFile.write(grouplistLike)

for i in range(1, 201):
	grouplistLike = str(personID[i-1]) + "|" + str(grouplistID[i+52]) + "\n"
	grouplistLikesFile.write(grouplistLike)

# grouplistFollows
for i in range(1, 201):
	grouplistIndex = random.randrange(0,20)
	grouplistFollow = str(personID[i+150]) + "|" + str(random.choice(grouplistID)) + "\n"
	grouplistFollowsFile.write(grouplistFollow)

# playlist

for i in range(1,401):
	randomTagIndex = random.randrange(0,200)
	randomPersonIndex = random.randrange(100,300)
	playlist = str(playlistID[i-1]) + "|" + str(playlistName[i-1]) + "|" + \
				str(numLikes[i-1]) + "|" + str(numReposts[i-1]) + "|" + \
				str(tagID[randomTagIndex]) + "|" + str(personID[randomPersonIndex]) + "\n" 
	playlistFile.write(playlist)


# playlistFollows

for i in range(1,400):
	followerIndex = random.randrange(500, 560)
	playlistFollows = str(personID[followerIndex]) + "|" + str(playlistID[i-1]) + "\n"
	playlistFollowsFile.write(playlistFollows)

# track
for i in range(1, 4001):
	randomTagIndex = random.randrange(0,300)
	randomUserIndex = random.randrange(1,100)
	track = str(trackID[i-1]) + "|" + str(numLikes2[i-1]) + "|" + str(tagID[randomTagIndex]) + "|" + \
			str(shares[i-1]) + "|" + str(trackName[i-1]) + "|" + str(datestamp[randomTagIndex]) + "|" + \
			str(personID[randomUserIndex]) + "\n"
	trackFile.write(track) 

#isInPlaylist

# build an array that has four sets of all integers from 1-400
#in order to ensure that every playlist in the code block below is accounted
#for 
playlistIndex = []
for i in range(1,6):
	indexCounter = 0
	for i in range (0,400):
		playlistIndex.append(indexCounter)
		indexCounter += 1

#take the first 2000 tracks and distribute them round robin to each of the
#playlists
for i in range(1,2001):
	isInPlaylist = str(trackID[i-1]) + "|" + str(playlistID[playlistIndex[i-1]]) + "\n"
	isInPlaylistFile.write(isInPlaylist)

#message
for i in range (1,401):
	senderIndex = random.randrange(400,500)
	receiverIndex = random.randrange(300,400)
	message = str(messageID[i-1]) + "|" + str(personID[senderIndex]) + "|" + \
				str(personID[receiverIndex]) + "|" + str(datestamp[i-1]) + "|" + \
				str(messageContent[i-1]) + "\n"
	messageFile.write(message)

##############
#close the accessed files

tagFile.close()

grouplistFile.close()
grouplistLikesFile.close()
grouplistFollowsFile.close()


personFile.close()
personFollowsFile.close()

trackFile.close()
playlistFile.close()
playlistFollowsFile.close()
isInPlaylistFile.close()

messageFile.close()