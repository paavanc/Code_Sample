
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
	public function login ($USName, $PWord){

		$this->mysqlconnect();




//if databse found continue to check if name in table



	$query = "SELECT * FROM user_table WHERE username = '$USName' AND password ='$PWord'";


	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());
	$answer= "";




	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{



		$usernamez = stripslashes($row["username"]);
		$passwordez = stripslashes($row["password"]);
		

		if ($usernamez==$USName && $passwordez==$PWord){

			$answer= "Login Succesful!";

}
else{

$answer= "Login Error!";

}






	}
	return $answer;
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
}
//unit tests

	/*
	$model = new APIModel();

	$return=$model->login ("pavbagel", "bigpapa");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->login ("cdog", "123");

	echo "$return";
	echo"<br>";

	$return=$model->login ("qweewq", "bigpapa");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->login ("pavbagel", "qwereqw");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->login ("qwer", "qwerewerewqw");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->getID ("pavbagel");

	echo "$return";
	echo "<br>";
	echo "<br>";
   $return=$model->getID ("safdsda");

	echo "$return";
	echo "<br>";
	echo "<br>";
	
	*/
	
	


	?>