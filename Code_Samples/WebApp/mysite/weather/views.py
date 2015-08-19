#imported libraries

from django.shortcuts import render_to_response #renders page


from.models import Subscriber #subscriber class to store info

from.forms import SubscriberForm #form to get POST variables


from django.template.context_processors import csrf # permission variable
from validate_email_address import validate_email #library to check email format
from django.core.mail import send_mail #Library to send email





#function that renders the website based on POST parameters
def index(request):
    	c = {}

	c.update(csrf(request)) #gets permission for post


		    # if this is a POST request we need to process the form data
        if request.method == 'POST':
        # create a form instance and populate it with data from the request:
                form = SubscriberForm(request.POST)
        # check whether it's valid:
                if form.is_valid():
                    #check if the email is in the correct format
                	is_valid = validate_email(form.cleaned_data['emailAddress'])
                    #is_valid = validate_email('example@example.com',verify=True)
                        if (is_valid==True):
                            #check if the email is in the database
                            flag = Subscriber.objects.filter(email=form.cleaned_data['emailAddress']).exists()
                            if (flag == False):
                                #declare subscriber object and save it
                                sub = Subscriber(email=form.cleaned_data['emailAddress'], city=form.cleaned_data['location'])
                                sub.save()

                                #send to confirmation page once done

                                return render_to_response('weather/confirmation.html', c)




#render this page if correct informaiton is not sent
	return render_to_response('weather/signup.html', c)






# Create your views here.