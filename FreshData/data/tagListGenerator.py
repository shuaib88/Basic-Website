tagArrayFile = open('tagNameArray.dat','w')

with open('tagNameList.dat','r') as f:
    for line in f:
        for word in line.split():
           print(word)
           newWord = "\"" + str(word) + "\"" + "," + " " 
           tagArrayFile.write(newWord)


tagArrayFile.close()
