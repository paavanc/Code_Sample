
<?php


class APIModel{

	var $msqli;
	 var $databaseUsername; 
  var $password;
  var $databaseName;
  var $mySQLServerName;
  var $ALBUMS= array();
  var $CAPTIONS= array();
  var $PHOTOS= array();
  var $DATES= array();
    var $PEOPLE= array();

  var $photoids= array();
var $TAGS= array();

	//connect to my database
	public function mysqlconnect(){





//login to people table
	$this->databaseUsername = "root";
	$this->password = "root";
	$this->databaseName = "cs460";
	$this->mySQLServerName = "localhost";

	$this->mysqli = new mysqli($this->mySQLServerName, $this->databaseUsername,
		$this->password, $this->databaseName);

	if ($this->mysqli->connect_error)
	{
	    print("PHP unable to connect to MySQL server; error (" . $this->mysqli->connect_errno . "): "
		    . $this->mysqli->connect_error);

		exit();
	}


	}




			     public function ownerLIst(){
			     	$userids = array();
			     

			     	$userids = $this->allUserIDs();
			     	
			     	$usernames = $this->allUserNames();
			     
			     	 $arrlength=count($userids);
			     	
			     	 $numberOfPhotos;
			     	  $numberOfComments;
			     	  $numberOfContributions;
			     	 // echo $arrlength;

			     	 for($x=0;$x<$arrlength;$x++) {
			     	 	
			     	 	$numberOfPhotos[$x] = $this->countPhoto($userids[$x]);
			     	 	$numberOfComments[$x] = $this->countComments($userids[$x]);

			     	 }
			     	 
			     	

			     	 	 for($x=0;$x<$arrlength;$x++) {
			     	 	$numberOfContributions[$x] = $numberOfPhotos[$x] + $numberOfComments[$x];
			     	 

			     	 }
			     	 
			     	 $temp = array_combine( $usernames, $numberOfContributions);
			     	  arsort($temp);
			     	  $names;
			     	  $values;
			     	  $counter = 0;
			     	 
			     	 

	foreach($temp as $x=>$x_value)
    {

    	$names[$counter] =$x;
    	$values[$counter] =$x_value;
    	$counter=$counter +1;

    }


 

    return $temp;



 					
				}






				public function countPhoto($USErID){
					

	     	 $photos= array();
		     $this->mysqlconnect();
$query = "SELECT * FROM photos D,  albums P WHERE P.userid = '$USErID' AND D.albumid =P.albumid ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		


	$id++;


	}
	
  return $id;

				}


							public function countComments($USErID){

	     	 $photos= array();
		     $this->mysqlconnect();
$query = "SELECT * FROM photos D,  albums P, comments X WHERE X.userid = '$USErID' AND X.photoid =D.photoid AND P.albumid = D.albumid AND P.userid !='$USErID' ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


$id++;
	}
  return $id;

				}









				  	
		     public function allUserIDs(){
	     	 $photos= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM user_table  ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["userid"]);

		if($name!="NA")

		$photos[$id]=("$name");

	$id++;


	}
  return $photos;
	}








			     public function allUserNames(){
	     	 $photos= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM user_table ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")
			if ($name==""){
				$photos[$id]=("anonymous");

	$id++;
			}
else{
		$photos[$id]=("$name");

	$id++;
}


	}
  return $photos;
	}







}
//unit tests
/*
	
	$model = new APIModel();

	$return=$model->ownerLIst();
	*/
	


	
	


	?>