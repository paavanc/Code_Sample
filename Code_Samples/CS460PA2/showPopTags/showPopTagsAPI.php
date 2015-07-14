
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
			     	
			     

			     	$temp = $this->allTags();
			     	//print_r($temp);
			     	//echo "<br>";
			     	$temp2 =array_count_values($temp);
			     	//print_r($temp2);
			     	//echo "<br>";
			     	
			     
			     
		
			     	 
			     	 
			     	  arsort($temp2);
			     	  $names;
			     	  $values;
			     	  $counter = 0;
			     	 
			     	 

	foreach($temp as $x=>$x_value)
    {

    	$names[$counter] =$x;
    	$values[$counter] =$x_value;
    	$counter=$counter +1;

    }
   // print_r($temp2);
    	//echo "<br>";


 

    return $temp2;



 					
				}

			  	
		     public function allTags(){
	     	 $photos= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM tags_table  ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["tag"]);

		if($name!="NA")

		$photos[$id]=("$name");

	$id++;


	}
  return $photos;
	}














}
//unit tests

	
	$model = new APIModel();

	$return=$model->ownerLIst();
	
	


	
	


	?>