import collections #library that lets me count the characters in a string/colleciton
import string #library that helps get rid of punctuation marks and other string funcitons
import sys #library that helps me pring to the terminal

#function that returns the first word in a sentence that has the most instances of a character
def returnWord(fileLocation):
    File = open(fileLocation) #get the file
    Sentence = File.readline() #read the first line
    Sentence = Sentence.translate(string.maketrans("",""), string.punctuation) #clear out puntuation
    wordArray = Sentence.split() #split sentence into array of words
    maxCount = 0 #counter for the word with biggest number of a instances for a specified character
    index = -1 #index for the word with 

    #for loop to go through the array
    for i in range(len(wordArray)):
        #temp gets the the number of instances the most common character appears in a word
        #we use the collections counter method as well as the most_common method assosiated with counter
        #counter returns an array of tupules, so we pic the specified index
        temp = collections.Counter(wordArray[i]).most_common(1)[0][1]
        if (temp > maxCount): #update maxCount if a bigger number arrises
            maxCount= temp
            index = i
    print wordArray[index] #return the word with most instances of a specified character

FileLoc2 = '/Users/paavanchopra/Documents/DATTO/testSentence2.txt'  #test files of sentences
FileLoc1 = '/Users/paavanchopra/Documents/DATTO/testSentence1.txt'

#unit tests
returnWord(FileLoc2)
returnWord(FileLoc1)
#print to console
sys.stdout.flush()