from django.db import models
#model class for database

# Create your models here.

#model for a subscriber - email + city
class Subscriber(models.Model):
    email = models.CharField(max_length=200)
    city = models.CharField(max_length=200)

    def __str__(self):              # __unicode__ on Python 2
        return self.email + " " + self.city


