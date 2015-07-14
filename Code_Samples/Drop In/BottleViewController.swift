//
//  SecondViewController.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/7/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

import UIKit

//view that goes to website
class BottleViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view, typically from a nib.
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    //button that initalize website in another window
    @IBAction func openWeb(sender: UIButton) {
        
       UIApplication.sharedApplication().openURL(NSURL(string: "http://becausewater.org/store-2/")!)
    }

}

