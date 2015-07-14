
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





	     public function AlbumList(){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";
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
		     public function likeZList(){
		     $this->mysqlconnect();
		     $photoid;
		     $photoid = $this->allPhotoIDs();
		     $arrlength=count($photoid);
		     $numberOfPhotos;

		     	 for($x=0;$x<$arrlength;$x++) {
			     	 	
			     	 	$numberOfPhotos[$x] = $this->countPhoto($photoid[$x]);
			     	 	

			     	 }



  return $numberOfPhotos;
	}


			     public function ownerLIst(){
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$this->PEOPLE[$id]=("$name");

	$id++;


	}
  return $this->PEOPLE;
	}
		     public function pictureTitles(){
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$this->CAPTIONS[$id]=("$name");

	$id++;


	}
  return $this->CAPTIONS;
	}
			     public function datesOfPics(){
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$this->DATES[$id]=("$name");

	$id++;


	}
  return $this->DATES;
	}
				     public function photoID(){
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$this->photoids[$id]=("$name");

	$id++;


	}
  return $this->photoids;
	}


	    public function getImages(){
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$this->PHOTOS[$id]=("$name");

	$id++;


	}
  return $this->PHOTOS;
	}


		     public function allPhotoIDs(){
	     	 $photos= array();
		     $this->mysqlconnect();
$query = "SELECT * FROM albums S, photos N, likes P, user_table D WHERE P.userid = D.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$photos[$id]=("$name");

	$id++;


	}
  return $photos;
	}
					public function countPhoto($photoid){
					

	     	 $photos= array();
		     $this->mysqlconnect();
$query = "SELECT * FROM likes WHERE photoid = '$photoid' ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		


	$id++;


	}
	
  return $id;

				}





}
//unit tests
	/*
	$model = new APIModel();

	$return=$model->getAlbumID(2, "YOLO");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->getAlbumID(2, "Pineapple");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->verifyAlbum(4, "qwereqw");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->verifyAlbum(4, "YOLO");

	echo "$return";
	echo "<br>";
	echo "<br>";
	*/
	


	?>