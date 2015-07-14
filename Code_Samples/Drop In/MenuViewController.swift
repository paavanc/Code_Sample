//
//  MenuViewController.swift
//  Drop In
//
//  Created by Paavan Chopra on 3/29/15.
//  Copyright (c) 2015 BecauseWater. All rights reserved.
//

import Foundation
import UIKit
import MapKit
import CoreLocation
import SwiftHTTP
import SwiftyJSON

class MenuViewController: UIViewController, UITableViewDelegate, UITableViewDataSource {
    
    //class variables
    @IBOutlet var tableView: UITableView!
    
    var tableData: [String] = ["Hello", "My", "Table"]
    var dataM = NSData()
    
    var name:[String] = []

    
    
 

    //once the view loads
    //parse the json data using swifty json and stick in the table view
    override func viewDidLoad() {
        super.viewDidLoad()
        
        let json = JSON(data: self.dataM)
        var _names:[String] = []
     
         for (index: String, subJson: JSON) in json {
            
            //make cell text dependednt on wether or not location name exists
            

                if(json[index]["locationName"].stringValue==""){
                    let name: NSString = "Name: " + json[index]["name"].stringValue + "\nType: "  + json[index]["category"].stringValue + "\nAddress: \n"+json[index]["address"].stringValue + "\nDistance: " + json[index]["distance"].stringValue + " miles\nDeals: \n" + json[index]["details"].stringValue
                    _names.append(name)
                  
                }
                else{
                    let name: NSString = "Name: " + json[index]["locationName"].stringValue + "\nType: "  + json[index]["category"].stringValue + "\nAddress: \n"+json[index]["address"].stringValue + "\nDistance: " + json[index]["distance"].stringValue + " miles\nDeals: \n" + json[index]["details"].stringValue
                    _names.append(name)
           
                }
        
            
        }
        
        self.name = _names
     
        
        //printJson()
        
        
        //  expandable cells by height
        self.tableView.registerClass(UITableViewCell.self, forCellReuseIdentifier: "cell")
        self.tableView.estimatedRowHeight = 89
        self.tableView.rowHeight = UITableViewAutomaticDimension

        
        //nameM.append("Seemu")
        //self.name.reloadData()
        
    }
    //print our json method
    func printJson(){
        let json = JSON(data: self.dataM)
       
        println(json)
    }
    
    //returns number of cells
    func tableView(tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        return self.name.count
    }
    
    //creats our tables
    func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell 	{
        
        var cell: UITableViewCell = self.tableView.dequeueReusableCellWithIdentifier("cell") as UITableViewCell
        
        
        cell.textLabel?.text = self.name[indexPath.row]
        cell.textLabel?.numberOfLines = 0;
        
        return cell
    }
    
    //lets u know what cell u hve selected and whats in it in console
    func tableView(tableView: UITableView!, didSelectRowAtIndexPath indexPath: NSIndexPath!) {
        println("You selected cell \(self.name[indexPath.row])!")
    }
    
    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }
    //number of sections
    func numberOfSectionsInTableView(tableView: UITableView!) -> Int
    {
        return 1
    }
    
    //This function handles the height of each cell
    func tableView(tableView: UITableView, heightForRowAtIndexPath indexPath: NSIndexPath) -> CGFloat
    {
        
        if(indexPath.row == 0)
        {
            return 270
        }
        else
        {
            return UITableViewAutomaticDimension
        }
        
    }


    //goes back to the map page
    @IBAction func backToMap(sender: AnyObject) {
        
        self.dismissViewControllerAnimated(true, completion: nil)
    }
    //reloads table every appearnace
    override func viewDidAppear(animated: Bool) {
        
        self.tableView.reloadData()
        
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