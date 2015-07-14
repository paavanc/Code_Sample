
<?php


class APIModel{

	var $msqli;
	 var $databaseUsername; 
  var $password;
  var $databaseName;
  var $mySQLServerName;
  






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


	public function verifyYourTag($USerID, $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM tags_table WHERE userid = '$USerID' AND tag = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$nameALbumez = stripslashes($row["tag"]);
		

		if ($nameALbumez==$name){

			$answer= "Tag Exists";

}
else{

$answer= "Tag does not exits.";

}






	}

	return $answer;


	}

		public function verifyAllTag( $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM tags_table WHERE tag = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$captionz = stripslashes($row["tag"]);
		

		if ($captionz==$name){

			$answer= "Tag Exists";

}
else{

$answer= "Tag does not exits.";

}






	}

	return $answer;


	}
		     public function allPhotoIDList(){
	     	 $photos= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid ";
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



	     public function allAlbumList(){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function allOwnerList(){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function allCaptionsList(){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid ";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function allDateOfAlbums(){

			     	   $DATES= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function allgetImages($UserID){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, user_table P WHERE S.albumid = N.albumid AND P.userid = S.userid";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
	}



			     public function yourTagtagZList($UserID, $name){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["tag"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}
				     public function yourPhotoList($UserID, $name){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function yourTagAlbumList($UserID, $name){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function yourTagOwnerList($UserID, $name){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function yourTagCaptionsList($UserID, $name){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function yourTagDateOfAlbums($UserID, $name){

			     	   $DATES= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function yourTaggetImages($UserID, $name){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
		$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE S.userid ='$UserID'AND L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
	}














			     public function allTagtagZList( $name){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["tag"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}
				     public function allPhotoList( $name){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function allTagAlbumList($name){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function allTagOwnerList( $name){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
		$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function allTagCaptionsList( $name){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
				$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function allTagDateOfAlbums( $name){

			     	   $DATES= array();
		     $this->mysqlconnect();
			$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function allTaggetImages( $name){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
		$query = "SELECT * FROM albums S, photos N, tags_table P, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND P.photoid = N.photoid AND P.tag = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
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














					     public function yourAlbumsPhotoList( $id){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function yourAlbumsAlbumList($id){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";			

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function yourAlbumsOwnerList( $id){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function yourAlbumsCaptionsList( $id){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function yourAlbumsDateOfAlbums( $id){

			     	   $DATES= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function yourAlbumsgetImages( $id){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.albumid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
	}



















		public function verifyAllAlbum( $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM albums WHERE nameOfAlbum = '$name' ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";





	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$captionz = stripslashes($row["nameOfAlbum"]);
		
		

		if (strtoupper($captionz)==strtoupper($name)){

			$answer= "Album Exists";

}
else{

$answer= "Album does not exits.";

}






	}

	return $answer;


	}


















					     public function allAlbumsPhotoList( $name){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$name'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function allAlbumsAlbumList($id){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$id'";			

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function allAlbumsOwnerList( $id){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function allAlbumsCaptionsList( $id){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function allAlbumsDateOfAlbums( $id){

			     	   $DATES= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function allAlbumsgetImages( $id){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND S.nameOfAlbum = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
	}




















	public function verifyYourPics($USerID, $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM albums N, photos L WHERE N.userid = '$USerID' AND L.caption = '$name' AND N.albumid = L.albumid ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$nameALbumez = stripslashes($row["caption"]);
		

		if ($nameALbumez==$name){

			$answer= "Picture Exists";

}
else{

$answer= "Picture does not exits.";

}






	}

	return $answer;


	}

			public function getPhotoID($USerID, $name){

		$this->mysqlconnect();



  $query = "SELECT * FROM photos L, albums N WHERE N.userid = '$USerID' AND L.caption = '$name' AND N.albumid = L.albumid ";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());



	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{




		$photoez = stripslashes($row["photoid"]);

		$namePicturez = stripslashes($row["caption"]);
		$abumIDez = stripslashes($row["albumid"]);


		if ( $namePicturez==$name ){

			return $photoez;
		}
	}

	return "Get ID Fail";





	}











						     public function yourPicsPhotoList($id){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid = '$id'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function yourPicsAlbumList($id){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid = '$id'";			

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function yourPicsOwnerList( $id){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function yourPicsCaptionsList( $id){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid  = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function yourPicsDateOfAlbums( $id){

			     	   $DATES= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid  = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function yourPicsgetImages( $id){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.photoid = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
	}


























			public function verifyAllPics( $name){


		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM photos WHERE caption = '$name' ";


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





						     public function allBrowsePhotoList($id){
		     $this->mysqlconnect();
		     $TAGS= array();
			$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption = '$id'";
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["photoid"]);

		if($name!="NA")

		$TAGS[$id]=("$name");

	$id++;


	}
  return $TAGS;
	}





		     public function allBrowsePicturesAlbumList($id){
	     	 $ALBUMS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption = '$id'";			

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["nameOfAlbum"]);

		if($name!="NA")

		$ALBUMS[$id]=("$name");

	$id++;


	}
  return $ALBUMS;
	}
		     public function allBrowseOwnerList( $id){
		     	   $PEOPLE= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["username"]);

		if($name!="NA")

		$PEOPLE[$id]=("$name");

	$id++;


	}
  return $PEOPLE;
	}

		     public function allBrowsePicturesCaptionsList( $id){
		     	  $CAPTIONS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption  = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["caption"]);

		if($name!="NA")

		$CAPTIONS[$id]=("$name");

	$id++;


	}
  return $CAPTIONS;
	}
			     public function allBrowsePicturesDateOfAlbums( $id){

			     	   $DATES= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption  = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["dateCreated"]);

		if($name!="NA")

		$DATES[$id]=("$name");

	$id++;


	}
  return $DATES;
	}



	    public function allBrowsePicturesgetImages( $id){
	    	 $PHOTOS= array();
		     $this->mysqlconnect();
	$query = "SELECT * FROM albums S, photos N, user_table L WHERE L.userid = S.userid AND S.albumid = N.albumid AND N.caption = '$id'";			
			$id=0;

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{


		$name = stripslashes($row["binary"]);

		if($name!="NA")

		$PHOTOS[$id]=("$name");

	$id++;


	}
  return $PHOTOS;
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