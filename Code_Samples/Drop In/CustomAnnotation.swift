//
//  CustomAnnotation.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/28/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

import UIKit
import MapKit

//Custom annotation class that lets us create a custom object for a custom marker
class CustomAnnotation: NSObject, MKAnnotation {
    
    //our variables
    var coordinate: CLLocationCoordinate2D
    var title: NSString!
    var subtitle: NSString!
    var imageName: NSString!
    
    //initialize class
    init(coordinate:CLLocationCoordinate2D, title: NSString!, subtitle: NSString!, imageName: NSString!){
        
        self.coordinate =  coordinate
        
        self.title = title
        
        self.subtitle = subtitle
        self.imageName = imageName
    }
    
    
    
}
