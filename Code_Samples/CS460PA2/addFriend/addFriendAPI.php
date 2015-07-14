
<?php


class APIModel{

	var $msqli;
	 var $databaseUsername; 
  var $password;
  var $databaseName;
  var $mySQLServerName;
  var $FRIENDS= array();
   var $USERLIST= array();


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


// Function to check login
// Function to check login
	public function createFriend ($UserID, $friendName){

		$friendID = $this->getID($friendName);
		//echo $friendName;
		//echo $friendID;


		if ($friendID == "Get ID Fail" ){

			return "This friend does not exist";



		}

		if ($UserID == $friendID){

			return "YOU CANT FRIEND YOURSELF!!";



		}


		







		$this->mysqlconnect();



//Check for duplications in the table
	$query = "SELECT * FROM friends WHERE userid = '$UserID'";

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		$friendidez = stripslashes($row["friendid"]);
	   
		

		if ($friendidez==$friendID){
			//echo("<br>");
			//echo("<br>              Same username foo</br>");
			return ("Friend has already been added.");
			exit;
		}

		

}

		$this->mysqlconnect();

	$userID = $UserID;
	$Friendid = $friendID;
	


	$query = "INSERT INTO friends VALUES ('$userID', '$Friendid')";


	$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);







		return ("Creation successful.");



	}

	public function notFriendList($UserID){

		$temp= array();

		$temp =$this->FriendList($UserID);

			$this->mysqlconnect();

			$query = "SELECT * FROM  user_table WHERE userid != '$UserID' ";

		$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$this->USERLIST[$id]=("$name");

	$id++;


	}
	

$fullDiff = array_merge(array_diff($temp, $this->USERLIST), array_diff($this->USERLIST, $temp));



  return $fullDiff;



	}

		public function getID($USName){

		$this->mysqlconnect();



  $query = "SELECT * FROM user_table WHERE username = '$USName'";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());


	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{



		$usernamez = stripslashes($row["username"]);
		$ID = stripslashes($row["userid"]);

		if ($usernamez==$USName){

			return $ID;
		}
	}

	return "Get ID Fail";





	}


     public function FriendList($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM friends S, user_table N WHERE S.userid ='$UserID' AND N.userid = S.friendid";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$this->FRIENDS[$id]=("$name");

	$id++;


	}
  return $this->FRIENDS;
	}


     public function deleteFriend($FriendName, $UserID){

     	$friendID = $this->getID($FriendName);

		     $this->mysqlconnect();
		    
			$query = "DELETE FROM friends WHERE userid ='$UserID' AND friendid ='$friendID'";
			$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);
			
return 1;
	}








}
//unit tests
	
	$model = new APIModel();
/*
	$return=$model->createAlbum (2, "Pineapple");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->createAlbum (4, "YOLO");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->createAlbum (4, "YOLO");

	echo "$return";
	echo "<br>";
	echo "<br>";

	$return=$model->deleteAlbum ("YOLO", 2);

	echo "$return";
	echo "<br>";
	echo "<br>";
	*/
	



	


	?>