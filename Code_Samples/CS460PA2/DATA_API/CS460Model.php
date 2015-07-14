

<?php


class APIModel{

	
	  var $link;




	public function createTables(){





	$link = mysql_connect('localhost', 'root', 'root');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
else{

	echo"Loged in successfully!";
	echo"<br>";
	echo"<br>";
}

$sql = 'CREATE DATABASE cs460';
if (mysql_query($sql, $link)) {
    echo "Database cs460 created successfully\n";
    echo"<br>";
	echo"<br>";
} else {
    echo 'Error creating database: ' . mysql_error() . "\n";
    echo"<br>";
	echo"<br>";
}



		//login to people table
	$databaseUsername = "root";
	$password = "root";
	$databaseName = "cs460";
	$mySQLServerName = "localhost";

	$mysqli = new mysqli($mySQLServerName, $databaseUsername,
		$password, $databaseName);

//Create Table if none exists
	$query = "CREATE TABLE `user_table`
		(`userid` int NOT NULL auto_increment,
		`username` text NOT NULL,
		`email` text NOT NULL,
		`password` text NOT NULL,
		`firstName` text NOT NULL,
		`lastName` text NOT NULL,
		`birthDay` text NOT NULL,
		`birthAddress` text NOT NULL,
		`currentAddress` text NOT NULL,
		`levelOfEdu` text NOT NULL,
		PRIMARY KEY (`userid`)
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "Table user_table created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}


		//login to people table
	$databaseUsername = "root";
	$password = "root";
	$databaseName = "cs460";
	$mySQLServerName = "localhost";

	$mysqli = new mysqli($mySQLServerName, $databaseUsername,
		$password, $databaseName);

//Create Table if none exists
	$query = "CREATE TABLE `friends`
		(`userid` int NOT NULL,
		`friendid` int NOT NULL
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "Table friends created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}


		//login to people table
	$databaseUsername = "root";
	$password = "root";
	$databaseName = "cs460";
	$mySQLServerName = "localhost";

	$mysqli = new mysqli($mySQLServerName, $databaseUsername,
		$password, $databaseName);

//Create Table if none exists
	$query = "CREATE TABLE `albums`
		(`userid` int NOT NULL,
		`albumid` int NOT NULL auto_increment,
		`nameOfAlbum` text NOT NULL,
		`dateCreated` text NOT NULL,
		PRIMARY KEY (`albumid`),
		 FOREIGN KEY(`userid`) REFERENCES user_table(`userid`)
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "Table albums created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}

//Create Table if none exists
	$query = "CREATE TABLE `photos`
		(`albumid` int NOT NULL,
		`photoid` int NOT NULL auto_increment,
		`caption` text NOT NULL,
		`binary` longblob NOT NULL,
		PRIMARY KEY (`photoid`),
		 FOREIGN KEY(`albumid`) REFERENCES albums(`albumid`)
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "Table photos created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}


//Create Table if none exists
	$query = "CREATE TABLE `tags_table`
		(`photoid` int NOT NULL,
		`tag` text NOT NULL
		
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "tags_table photos created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}

//Create Table if none exists
	$query = "CREATE TABLE `comments`
		(`userid` int NOT NULL,
		`photoid` int NOT NULL,
		`text` text NOT NULL,
		`dateOfCreation` text NOT NULL
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "comments photos created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}
//Create Table if none exists
	$query = "CREATE TABLE `likes`
		(`userid` int NOT NULL,
		`photoid` int NOT NULL,
		`text` text NOT NULL,
		`dateOfCreation` text NOT NULL
		) ENGINE=MyISAM;";

if ($mysqli->query($query)){
 echo "likes  created successfully\n";
 echo"<br>";
	echo"<br>";

} 
else {
echo 'Query failed: ' . $mysqli->error;
echo"<br>";
	echo"<br>";
}








	}
}


	$model = new APIModel();

	$return=$model->printName("Joe");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$model->createTables();




?>