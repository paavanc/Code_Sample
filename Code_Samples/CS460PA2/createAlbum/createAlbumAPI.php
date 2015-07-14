
<?php


class APIModel{

	var $msqli;
	 var $databaseUsername; 
  var $password;
  var $databaseName;
  var $mySQLServerName;
  var $ALBUMS= array();
  var $ALBUMSID= array();


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
	public function createAlbum ($UserID, $albumName){




		$this->mysqlconnect();



//Check for duplications in the table
	$query = "SELECT * FROM albums WHERE userid = '$UserID'";

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		$albumez = stripslashes($row["nameOfAlbum"]);
	   
		

		if ($albumez==$albumName){
			//echo("<br>");
			//echo("<br>              Same username foo</br>");
			return ("Album name  has already been used.");
			exit;
		}

		

}

		$this->mysqlconnect();

	$userID = $UserID;
	$AlbumNAme = $albumName;
	$date = date("m.d.y");


	$query = "INSERT INTO albums SET userid='$userID', nameOfAlbum='$AlbumNAme' , dateCreated ='$date';";

	$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);







		return ("Creation successful.");



	}


     public function AlbumList($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums WHERE userid ='$UserID'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$this->ALBUMS[$id]=("$name");

	$id++;


	}
  return $this->ALBUMS;
	}
	     public function AlbumIDList($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums WHERE userid ='$UserID'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["albumid"]);

		if($name!="NA")

		$this->ALBUMSID[$id]=("$name");

	$id++;


	}
  return $this->ALBUMSID;
	}

     public function deleteAlbum($AlbumName, $UserID){
		     $this->mysqlconnect();
		     $albumID= $this->getAlbumID($UserID, $AlbumName );
		    
			$query = "DELETE FROM albums WHERE albumid ='$albumID'";
			$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);
			

			



			$query = "DELETE FROM photos WHERE albumid ='$albumID'";
			$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);


			


	
  return 1;
	}

		public function getAlbumID($USerID, $name){

		$this->mysqlconnect();



  $query = "SELECT * FROM albums WHERE userid = '$USerID' AND nameOfAlbum = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$useridez = stripslashes($row["userid"]);

		$nameALbumez = stripslashes($row["nameOfAlbum"]);
		$abumID = stripslashes($row["albumid"]);


		if ($useridez==$USerID && $nameALbumez==$name ){

			return $abumID;
		}
	}

	return "Get ID Fail";





	}








}
//unit tests
	/*
	$model = new APIModel();

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