
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


	//Function to Add people
  public function addPerson($usr, $pwd, $eml, $fname, $lname, $bday, $htown, $cad, $edu){

$this->mysqlconnect();



//Check for duplications in the table
	$query = "SELECT * FROM user_table";

	$result = $this->mysqli->query ( $query ) or die('SELECT query failed: ' . mysql_error());

	for ( $row = $result->fetch_assoc(); $row != FALSE;
			$row = $result->fetch_assoc() )
	{
		$usernamez = stripslashes($row["username"]);
	    $emailez = stripslashes($row["email"]);
		

		if ($usernamez==$usr){
			//echo("<br>");
			//echo("<br>              Same username foo</br>");
			return ("Username has already been used.");
			exit;
		}

	     if ($emailez==$eml){
			return ("Email has already been used.");
			exit;
		}
		

}



$this->mysqlconnect();

	$usernames = $usr;
	$passwords = $pwd;
	$emails    = $eml;
	$firstName = $fname;
	$lastName = $lname;
	$birthday = $bday;
	$hometown = $htown;
	$currAddress = $cad;
	$education = $edu;
	

	//echo($ID2s);

	// put data into the database

	$query = "INSERT INTO user_table SET username='$usernames', password='$passwords' , email ='$emails',  firstName ='$firstName' ,lastName= '$lastName', birthDay='$birthday', birthAddress='$hometown', currentAddress= '$currAddress' , levelOfEdu='$education';";

	$this->mysqli->query($query) or die("INSERT query failed: ".$this->mysql->error);







		return ("Registration successful.");




	}

		public function getID($USName){

		$this->mysqlconnect();



  $query = "SELECT * FROM user_table";


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

	$return=$model->addPerson("pavbagel", "bigpapa", "pav@yahoo.com", "Paavan", "Chopra", "9/12/1992", "Chicago", "Boston", "PHD");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->addPerson("cdog", "123", "pav@yahoo2.com", "Paavan", "Chopra", "9/12/1992", "Chicago", "Boston", "PHD");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->addPerson("cdog6", "1235", "pav@yahoo2.com", "Paavan", "Chopra", "9/12/1992", "Chicago", "Boston", "PHD");

	echo "$return";
	echo "<br>";
	echo "<br>";
		$return=$model->addPerson("cdog10", "1235", "pav@yahoo.com", "Paavan", "Chopra", "9/12/1992", "Chicago", "Boston", "PHD");

	echo "$return";
	echo "<br>";
	echo "<br>";
	$return=$model->addPerson("cdog10", "1235", "cdog@catdog", "Paavan", "Chopra", "9/12/1992", "Chicago", "Boston", "PHD");

	echo "$return";
	echo "<br>";
	echo "<br>";
	*/
	


	?>