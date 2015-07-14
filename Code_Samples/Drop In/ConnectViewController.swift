//
//  ConnectViewController.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/7/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

//libraries dont use
import UIKit
import SwiftHTTP
import SwiftyJSON


class ConnectViewController: UIViewController, UITextFieldDelegate {

    //class variables
    @IBOutlet weak var email: UITextField!
    
    //function that runs when view loads
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }

    //memory warning functions
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    
    //next set of function got to facebook, twitter or pinterest
    @IBAction func openTwitter(sender: AnyObject) {
        
        UIApplication.sharedApplication().openURL(NSURL(string: "https://twitter.com/BeCauseWater")!)
    }
    @IBAction func openFacebook(sender: AnyObject) {
        
        UIApplication.sharedApplication().openURL(NSURL(string: "https://www.facebook.com/BeCauseWater")!)
    }
    @IBAction func openPinterest(sender: AnyObject) {
        
        UIApplication.sharedApplication().openURL(NSURL(string: "https://pinterest.com/becausewater")!)
    }
    @IBAction func emailEditingDidEnd(sender: AnyObject) {
        
        (sender as UITextField).resignFirstResponder();
        
    }
//submit email to database---not sure where Matt Thomas wants this to go
    //just prints the email for now lol
    @IBAction func submitEmail(sender: AnyObject) {
       
        
        
        
        
        //check to see if text fields are empty
        if(MyString.blank(email.text)==false){
            
          
            
            
         
           println(email.text)
                
                
    
            var needToReplaceString = " "
            var replaceString = "%20"
            var modifiedNamofEmail = email.text.stringByReplacingOccurrencesOfString(needToReplaceString, withString: replaceString, options: nil, range: nil)
            
            
                
                //this is our url
                var url = "http://becausewater.us6.list-manage.com/subscribe/post?u=fb006231cac7e6efc2f175dad&amp;id=72a946062a&amp;EMAIL="+modifiedNamofEmail
                
                //get method from swifthttp
                var request = HTTPTask()
                request.POST(url, parameters: nil, success: {(response: HTTPResponse) in
                    if let data = response.responseObject as? NSData {
                        let str = NSString(data: data, encoding: NSUTF8StringEncoding)
                        println("response: \(str)") //prints the HTML of the page
                        
                    }
                    },failure: {(error: NSError, response: HTTPResponse?) in
                        println("error: \(error)")
                        //To create a pop up alert message
                        var alertMessage = UIAlertView(title: "Database/PHP/URLSubmission Error!", message: "error: \(error)", delegate: nil, cancelButtonTitle: "Ok")
                        alertMessage.show()
                })
                
                
                self.clearTextFields()
                
                
                //To create a pop up alert message
                var alertMessage = UIAlertView(title: "Success!", message: "Email successfully added!.", delegate: nil, cancelButtonTitle: "Thank You")
                alertMessage.show()
                
                
            
            
        }
        else{
            
            //To create a pop up alert message
            var alertMessage = UIAlertView(title: "ERROR", message: "Please fill in your email before submitting.", delegate: nil, cancelButtonTitle: "Thank You!")
            alertMessage.show()
        }
        
        
        
    }
    
    
    func textFieldShouldReturn(textField: UITextField!) -> Bool // called when 'return' key pressed. return NO to ignore.
    {
      
        textField.resignFirstResponder()
        return true;
    }
    
    override func touchesBegan(touches: NSSet, withEvent event: UIEvent) {
        self.view.endEditing(true)
    }
    //clears the text field once we are done positng
    func clearTextFields() -> Void
    {
        email.text = nil;
     
    }
    //string method to trim spaces
    
    struct MyString {
        static func blank(text: String) -> Bool {
            let trimmed = text.stringByTrimmingCharactersInSet(NSCharacterSet.whitespaceCharacterSet())
            return trimmed.isEmpty
        }
    }
    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        // Get the new view controller using segue.destinationViewController.
        // Pass the selected object to the new view controller.
    }
    */

}
