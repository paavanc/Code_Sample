<?php
include 'modelStubLogin.php';
include 'loginAPI.php';
class LoginActivity
{
	private $username;
	private $password;
	public $context;
	private $guestVar;
	
	function __construct(){
		$this->getInput();
	}
	
	private function showHead(){
		?>
		<head>
	
		</head><?php
	}
	
	private function showForm(){
		print("<body bgcolor='#EEEEEE'>");
		?>
		<html>
		<head>


			
		</head>
		<body>
			<div id="containerActivity">
		   		<div id="contentActivity">
		   			<form action='' method='post'>
						<fieldset>
							<legend>Login</legend>
							<p class="name"><label for="name">Username:</label> <input type="text" id="name" name="username"/></br>
							<p class="password"><label>Password:</label>
							<input type='password' name='password'/></br>
							Guest: -Please type in anything in this text field, leave all other fields blank and press login.
							<input type="text" id="name" name="guest"/>

							<p class="submit"><input type='submit' value=' Login '/>
							</form>
							<form action='../Login/login.php'>
							<p class="reset"><input type='submit' value='Reset'/>
							<br>
							
							</form>
							<a href="../Registration/registration.php" class="register">Create a new account</a><br>

						</fieldset>
					</form>
					
		    	 </div>
			</div>
		</body>		
	</html>
	<?php }
	
	private function showBody(){
		print("<body>");
		$this->showForm();
		print("</body>");
	}
	
	
	private function showHTML(){
		print("<html>");
		$this->showHead();
		$this->showBody();
		print("</html>");
	}
	
	private function getInput(){
		
		if(isset($_POST["username"])){
			$this->username = ($_POST["username"]);
			$this->password = ($_POST["password"]);

			
		
		if($this->username!="" &&$this->password!="" && $this->guestVar=="" ){
		
			$this->context = "Data was submitted";
			
		}
			
	

		}


		 if ( isset($_POST["guest"])){
			

			$this->guestVar = ($_POST["guest"]);
			
			$this->username = ($_POST["username"]);
			$this->password = ($_POST["password"]);
					if($this->username=="" &&$this->password=="" && $this->guestVar!="" ){
		
			$this->context = "guest";
			
		}



	}
		


	}
	
	private function PrintError($err_num){
		if($err_num == 0){
			echo "<script>
			alert('Something is missing from the form');
			</script>";
		}
	}
	
	private function verifyForm(){
		if((!isset($this->username) || $this->username == '') || (!isset($this->password) || $this->password == '')){
			//something's missing
			$this->PrintError(0);
			
			return false;
		}
		else{
			return true;
		}
	}
	
	private function processData(){
		if($this->context == "Data was submitted" ){

			$model = new APIModel();
			if($this->verifyForm()){
					$result = $model->login($this->username, $this->password);
					if($result == "Login Succesful!"){
						//session_register($this->username);

						$userID=$model->getID($this->username);
						//echo $userID;


						if ($userID!="Get ID Fail"){

							$_SESSION['userid']=$userID;


						?>
						<!--<form method="get" action="../createAlbum/createAlbum.php">
    				<input type="hidden" name="userid" value='<?php //echo $userID; ?>'>
    				<input type="submit">
						</form>-->

						<meta http-equiv="refresh" content="0; url=http://localhost:8888/CS460PA2/Newsfeed/newsFeed.php" />

						<?php
					}
		

					} 
					else{
						
						print($result);
					}
				
			}
		}

		if ($this->context == "guest"){
			$_SESSION['userid']=-99;
				?>
						

						<meta http-equiv="refresh" content="0; url=http://localhost:8888/CS460PA2/Newsfeed/newsFeed.php" />

						<?php




		}




	}
	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}	
	
	