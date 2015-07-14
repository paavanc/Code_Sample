//
//  FirstViewController.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/7/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

/*
This view is the one that is initially loaded.
Ths is map view and it loads all our data points and display it on the map.

This view also sends data to the menu page

*/

//the different libraries that we import
import UIKit
import MapKit
import CoreLocation
import SwiftHTTP
import SwiftyJSON



class MapViewController: UIViewController, MKMapViewDelegate, CLLocationManagerDelegate {
    
    //class variabls
    let locationManager = CLLocationManager()
    var locationSet = Bool()
    var lastLocation: CLLocation = CLLocation()
    
    var getData = NSData ()

    

    @IBOutlet weak var theMapView: MKMapView!
    override func viewDidLoad() {
        super.viewDidLoad()
        
        
        //To create a pop up alert message
        var alertMessage = UIAlertView(title: "Welcome!", message: "Please wait a few seconds for the map to load.", delegate: nil, cancelButtonTitle: "Thank You!")
        alertMessage.show()

        
        //set up map -loads first no matter what
        self.locationManager.delegate = self
        self.locationManager.desiredAccuracy = kCLLocationAccuracyBest
        self.locationManager.requestWhenInUseAuthorization()
        self.locationManager.startUpdatingLocation()
        
        locationSet = false
        
        theMapView.showsUserLocation = true
        
        theMapView.delegate  = self
        
        
        
        // Do any additional setup after loading the view, typically from a nib.
        

        
        
    }

//send memory warning -don't worry about it too much
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    
    //function that loads the map
    func locationManager(manager: CLLocationManager!, didUpdateLocations locations: [AnyObject]!) {

        
        
        //lat and long position of user
        var lat:String = "\(manager.location.coordinate.latitude )"
        var lon: String = "\(manager.location.coordinate.longitude )"


        

       

        
        
        //creat user marker- pulsating dot with this code
        var userLocation:CLLocation = locations[0] as CLLocation
       
        
        locationManager.stopUpdatingLocation()
        
        let location = CLLocationCoordinate2D(latitude: userLocation.coordinate.latitude, longitude: userLocation.coordinate.longitude)
        
        var currentLocation: CLLocationCoordinate2D = CLLocationCoordinate2DMake(userLocation.coordinate.latitude, userLocation.coordinate.longitude)
        
        
        let span = MKCoordinateSpanMake(0.05, 0.05)
        
        let region = MKCoordinateRegionMake(manager.location.coordinate, MKCoordinateSpanMake(0.05, 0.05))
        
        theMapView.setRegion(region, animated: true)
        
        var marker = MKPointAnnotation ()
        marker.coordinate = currentLocation
        marker.title = "Your are here!"
        marker.subtitle = "Add me?"

        

        
        
        //use swiftHttp library to get data
        var request = HTTPTask()
        
        request.GET("http://dropinapp.org/apiv2/?api=7yEgyaKqGTEyX7wqtGHwX&action=get&lat="+lat+"&lng="+lon+"&radius=20", parameters: nil, success: {(response: HTTPResponse) in
            if let data = response.responseObject as? NSData {
                self.getData = data
                let json = JSON(data: data) //create a json object of data using swiftyjson
                let name = json["10"]["id"].stringValue
                
                
                println("response: \(json)") //prints the HTML of the page
                
                
                //for loop that generates all the markers on the map
                
                for (index: String, subJson: JSON) in json {
                    //Do something you want
                    
                    
                    //if the marker is a public fountain
                    if (json[index]["category"].stringValue=="Public Fountain" && json[index]["visible"].stringValue=="1"){
                        
                        //pull from location name, otherwise use regular name
                        var dropLocation: CLLocationCoordinate2D = CLLocationCoordinate2DMake(json[index]["lat"].doubleValue, json[index]["lng"].doubleValue)
                        
                        if(json[index]["locationName"].stringValue==""){
                        var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["name"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "bubbler.png")
                            self.theMapView.addAnnotation(customMaker)
                            
                            
         
                            
                            
                            
                            
                            
                            
                        }
                        else{
                            var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["locationName"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "bubbler.png")
                            self.theMapView.addAnnotation(customMaker)
                            
                            
              
                           
                            
                            
                            
                            
                        }

                        
                    }
                    //if location is a store
                    if (json[index]["category"].stringValue=="Drop In" && json[index]["visible"].stringValue=="1"){
                        var dropLocation: CLLocationCoordinate2D = CLLocationCoordinate2DMake(json[index]["lat"].doubleValue, json[index]["lng"].doubleValue)
               
                        if(json[index]["locationName"].stringValue==""){
                            var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["name"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "drop-in.png")
                            self.theMapView.addAnnotation(customMaker)
                            
           

                            
                            
                            
                            
                            
                        }
                        else{
                            var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["locationName"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "drop-in.png")
                            self.theMapView.addAnnotation(customMaker)
                            
                            
              
                           
                            
                            
                        }
                        
                    }
                    //if locaiton is user submitted
                    if (json[index]["category"].stringValue=="User Submitted" && json[index]["visible"].stringValue=="99"){
                      
                        var dropLocation: CLLocationCoordinate2D = CLLocationCoordinate2DMake(json[index]["lat"].doubleValue, json[index]["lng"].doubleValue)
                        
                        if(json[index]["locationName"].stringValue==""){
                            var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["name"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "users_addDrop.png")
                            self.theMapView.addAnnotation(customMaker)
                            
                
                            
                            
                            
                        }
                        else{
                            var customMaker = CustomAnnotation(coordinate: dropLocation, title: json[index]["locationName"].stringValue, subtitle: json[index]["details"].stringValue, imageName: "users_addDrop.png")
                            self.theMapView.addAnnotation(customMaker)
                            
                            
                            
                            
                        }
                        
                    }
                    
                    
                }
                
                
            }
            },failure: {(error: NSError, response: HTTPResponse?) in
                println("error: \(error)")
        })
        
        
        

    }
    
    
    
    //function that allows to customize annotations for markers
    //aka add custom pictures
    
    func mapView(mapView: MKMapView!, viewForAnnotation annotation: MKAnnotation!) -> MKAnnotationView! {
        if !(annotation is CustomAnnotation) {
            return nil
        }
        
        let reuseId = "test"
        
        var anView = mapView.dequeueReusableAnnotationViewWithIdentifier(reuseId)
        if anView == nil {
            anView = MKAnnotationView(annotation: annotation, reuseIdentifier: reuseId)
            anView.canShowCallout = true
        }
        else {
            anView.annotation = annotation
        }
        
        //Set annotation-specific properties **AFTER**
        //the view is dequeued or created...
        
        let cpa = annotation as CustomAnnotation
        anView.image = UIImage(named:cpa.imageName)
        
        return anView
    }
    

    //prints error message to console if map is not working
    func locationManager(manager: CLLocationManager!, didFailWithError error: NSError!) {
        println("Error: " + error.localizedDescription)
    }
    
    //functions that convert radians to degrees and vice versa
    func degreesToRadians(degrees: Double) -> Double { return degrees * M_PI / 180.0 }
    func radiansToDegrees(radians: Double) -> Double { return radians * 180.0 / M_PI }

    
    //function that sends data to menu page
     override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        var DestViewController: MenuViewController = segue.destinationViewController as MenuViewController
       // println(self.getData)
       DestViewController.dataM = self.getData
       
        
        
    }


}

