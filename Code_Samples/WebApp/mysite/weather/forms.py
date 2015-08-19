from django import forms

#from .models import Subscriber

#form for weather page
class SubscriberForm(forms.Form):
	emailAddress = forms.CharField(label='Email Address', max_length=200)
	location = forms.CharField(label='Location', max_length=200)
	
	#send string of all form objects
	def __str__(self):              # __unicode__ on Python 2
            return self.emailAddress + " " + self.location
		