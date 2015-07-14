//
//  PrivacyPolicyViewController.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/29/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

import UIKit

//i got nothing :)

class PrivacyPolicyViewController: UIViewController {
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        // Do any additional setup after loading the view.
    }
    
    @IBAction func BackToAbout(sender: AnyObject) {
        
        self.dismissViewControllerAnimated(true, completion: nil)
    }
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
}
}