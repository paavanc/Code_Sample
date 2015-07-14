
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


// Function to check login
// Function to check login
	public function addLike ($photoID, $name, $UserID){
		$this->mysqlconnect();


		//Check for duplications in the table
	$query = "SELECT * FROM likes WHERE photoid = '$photoID' AND userid = '$UserID'";

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		$captionez = stripslashes($row["text"]);
	   
		

		if ($name==$captionez){
			//echo("<br>");
			//echo("<br>              Same username foo</br>");
			return ("Your already liked this picture.");
			exit;
		}

		

}

		$this->mysqlconnect();

		$date = date("m.d.y");


		$query = "INSERT INTO likes VALUES ('$UserID','$photoID', '$name',  '$date')";

	$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);

		
		return "Creation successful.";




	}

	public function verifyAlbum($USerID, $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM albums WHERE userid = '$USerID' AND nameOfAlbum = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$nameALbumez = stripslashes($row["nameOfAlbum"]);
		

		if ($nameALbumez==$name){

			$answer= "Album Exists";

}
else{

$answer= "Album does not exits.";

}






	}

	return $answer;


	}

		public function verifyPicture($albumID, $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM photos WHERE albumid = '$albumID' AND caption = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$captionz = stripslashes($row["caption"]);
		

		if ($captionz==$name){

			$answer= "Picture Exists";

}
else{

$answer= "Picture does not exits.";

}






	}

	return $answer;


	}
		public function verifyPerson( $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM user_table WHERE username = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$nameez = stripslashes($row["username"]);
		

		if ($nameez==$name){

			$answer= "Person Exists";

}
else{

$answer= "Person does not exits.";

}






	}

	return $answer;


	}



	     public function AlbumList($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid ";
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
		     public function likeZList($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["text"]);

		if($name!="NA")

		$this->TAGS[$id]=("$name");

	$id++;


	}
  return $this->TAGS;
	}


			     public function ownerLIst($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P, user_table L WHERE P.userid ='$UserID' AND P.userid = L.userid AND S.albumid = N.albumid AND P.photoid = N.photoid ";
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
		     public function pictureTitles($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid";
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
			     public function datesOfPics($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid";
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
				     public function photoID($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid";
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


	    public function getImages($UserID){
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, likes P WHERE P.userid ='$UserID'AND S.albumid = N.albumid AND P.photoid = N.photoid";
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



public function deleteLike($photoID, $name){
$this->mysqlconnect();

$query = "DELETE FROM likes WHERE photoid ='$photoID' AND `text`= '$name'";
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

		public function getPhotoID($albumID, $name){

		$this->mysqlconnect();



  $query = "SELECT * FROM photos WHERE albumid = '$albumID' AND caption = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$photoez = stripslashes($row["photoid"]);

		$namePicturez = stripslashes($row["caption"]);
		$abumIDez = stripslashes($row["albumid"]);


		if ($abumIDez==$albumID && $namePicturez==$name ){

			return $photoez;
		}
	}

	return "Get ID Fail";





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