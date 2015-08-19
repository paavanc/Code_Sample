from django.conf.urls import url

from . import views

#url patterns
urlpatterns = [
    url(r'^$', views.index, name='index'),
    
]