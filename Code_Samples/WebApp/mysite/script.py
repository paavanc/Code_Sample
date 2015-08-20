from weather.models import Subscriber #subscriber module
import urllib2 #make api call
import json #parse json
import cStringIO #read image url
from django.core.mail import send_mail #send email
from PIL import Image #process image
#libraries for processign data


#function to get data and send email
def getData():
	#array that stores all infromation from database -Subscriber
	subscriberArray = Subscriber.objects.all()
	#for loop to get json data for all subscriber objects
	for i in range(len(subscriberArray)):
		cityState = subscriberArray[i].city.split() # split city/state string into seprate iterms in an array

		#bodyArray gets all the json information
		bodyArray = getJson(str(cityState[0]), str(cityState[1]))
		#gets the subject for the email on a series of inputs
		subject = getSubject(int(bodyArray[3]),(int(int(bodyArray[1]) + int(bodyArray[4]))/2))
		#sends the email
		send_mail(subject, bodyArray[0], 'Weather@app.com',
    [str(subscriberArray[i].email)], fail_silently=False)

#gets the json data based on the city and the state
def getJson(city, state):
	#url for api call
	url = 'http://api.wunderground.com/api/N?A/forecast/q/'+state+'/'+city+'.json'
	#get information
	serialized_data = urllib2.urlopen(url).read()
        
        #array to store json data
        answer = ["" for x in range(5)]
#loads the json data into readable array/string structure
	data = json.loads(serialized_data)
        
        answer [0] = str(data["forecast"]["txt_forecast"]["forecastday"][0]["fcttext"])
        answer [1] = str(data["forecast"]["simpleforecast"]["forecastday"][0]["high"]["fahrenheit"])
        answer [2] = str(data["forecast"]["txt_forecast"]["forecastday"][0]["icon_url"])
        answer [3] = str(data["forecast"]["txt_forecast"]["forecastday"][0]["pop"])
        answer [4] = str(data["forecast"]["simpleforecast"]["forecastday"][0]["low"]["fahrenheit"])
        #return array
        return answer

#returns subject based on the average of the low and high degree forcast for that day
#as well as the probability of percipitation
#if the average is within a certian range send the subject
#if the percipitation is above a certain chance, send a bad subject
def getSubject(pop, degree):
	if (pop > 50):
		return "Not so nice out? That's okay, enjoy a discount on us."
	if (degree <90 and degree > 60):
		return "It's nice out! Enjoy a discount on us."
	if (degree >90 or degree < 40):
		return "Not so nice out? That's okay, enjoy a discount on us."
	if (degree >40 and degree < 60):
		return "Enjoy a discount on us."

#start the process
getData()



