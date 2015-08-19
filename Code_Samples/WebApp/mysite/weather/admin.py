from django.contrib import admin
from .models import Subscriber

#class for custom admin site
class SubscriberAdmin(admin.ModelAdmin):
     fieldsets = [
        (None,               {'fields': ['email']}),
        ('Subscriber information', {'fields': ['city']}),
    ]
     list_display = ('email', 'city')
     list_filter = ['city']
     search_fields = ['email']
     #filter by city and search by email
admin.site.register(Subscriber, SubscriberAdmin)


# Register your models here.
