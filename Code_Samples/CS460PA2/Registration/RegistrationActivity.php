<?php
include 'RegisrationAPI.php';
include 'RegistrationModelStub.php';
class RegistrationActivity
{
	private $newUsername;
	private $newPassword;
	private $newEmail;
	private $firstName;
	private $lastName;
	private $birthday;
	private $hometown;
	private $currentAddress;
	private $education;
	private $newPassword2;
	private $newEmail2;
	public $context;
	
	function __construct(){
		$this->getInput();
	}
	
	private function showHead(){
				print("<head>");
		?>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="Registration.css">
		<meta charset=utf-8 />	
		
		<?php
		
		print("</head>");
	}
	
	private function showFooter(){

	}
	
	private function showForm(){

		?>
		<form method="POST" action="Registration.php">
                    <table border="0" style="position:absolute; top:59px; left:51px; font-family:Tahoma; font-size: 11px; height: 276px;">
						
						<tbody><tr>
                            <td>Username: </td>
                            <td><input type="text" name="username" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your desired username.                                    
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail: </td>
                            <td><input type="text" name="email" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your email address eg. john@bu.edu.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm e-mail: </td>
                            <td><input type="text" name="email2" value="" size="40">
                                <br>
                                <div class="regsubt">Confirm your email address.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Password: </td>
                            <td><input type="password" name="password" value="" size="40">
                                <br>
                                <div class="regsubt">Your password should have atleast 2 special characters.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm password: </td>
                            <td><input type="password" name="password2" value="" size="40">
                                <br>
                                <div class="regsubt">Re-type your password.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>First Name: </td>
                            <td><input type="text" name="Fname" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your first name e.g. John.
                                </div>
                            </td>
                        </tr>
                         <tr>
                            <td>Last Name: </td>
                            <td><input type="text" name="Lname" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your last name e.g. Doe.
                                </div>
                            </td>
                        </tr>
                          <tr>
                            <td>Date of Birth: </td>
                            <td><input type="text" name="bday" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter date of birth.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Hometown: </td>
                            <td><input type="text" name="htown" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your hometown address.
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Current Address: </td>
                            <td><input type="text" name="address" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your current address.
                                </div>
                            </td>
                        </tr>
                          <tr>
                            <td>Highest Level of Education: </td>
                            <td><input type="text" name="edu" value="" size="40">
                                <br>
                                <div class="regsubt">Please enter your highest level of education earned.
                                </div>
                            </td>
                        </tr>

                        <tr> <td></td>
                            <td>
                                <br>
                                <div style="font-size:11px; color:red; top:2px">
                                </div>
                            </td>
                        </tr>
                    </tbody></table>
                    <div style="position:absolute; bottom:30px; right:35px;">
                        <input type="reset" value="Reset" name="reset"> &nbsp;
                        <input type="submit" value="Submit" name="submit">
                    </div>
                    </form><?php
	}
	
	private function showBody(){
		print("<body bgcolor='#EEEEEE'>");
		?><center><div style="position: relative; top:-15px; width: 945px; height: 520px; background: url('../pics/Body.jpg');">
                <div style="position: relative; top: 50px; background: url('../pics/Register.jpg'); width: 701px; height: 413px;">
                    <div style="font-size:20; font-family:Tahoma; position:absolute; top:25px; left:30px; color:white;"> </div><?php
					$this->showForm();
					?>
                   
                </div>
            </div></center>
		<?php
		$this->showFooter();
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
			$this->context = "Data was submitted";
			$this->newUsername = ($_POST["username"]);
			$this->newPassword = ($_POST["password"]);
			$this->newEmail = ($_POST["email"]);
			$this->firstName = ($_POST["Fname"]);
			$this->lastName = ($_POST["Lname"]);
			$this->birthday = ($_POST["bday"]);
			$this->hometown = ($_POST["htown"]);
			$this->currentAddress = ($_POST["address"]);
			$this->education = ($_POST["edu"]);
			$this->newPassword2 = ($_POST["password2"]);
			$this->newEmail2 = ($_POST["email2"]);
		}
		else{
			$this->context = "No data was submitted";
			
		}
	}
	
	private function PrintError($err_num){ //[RA.S.003]
		if($err_num == 0){
			echo "<script type='text/javascript'>alert('Something is missing from the form');history.back();</script>";
			//print("<div id='error_msg'>Something is missing from the form</div>");
		}
		if($err_num == 1){
			echo "<script type='text/javascript'>alert('E-mails do not match');history.back();</script>";
			//print("<div id='error_msg'>E-mails don't match</div>");
		}
		if($err_num == 2){
			echo "<script type='text/javascript'>alert('Passwords do not match');history.back();</script>";		
			//print("<div id='error_msg'>Passwords don't match</div>");
		}

	}
	
	private function verifyForm(){
				if((!isset($this->newEmail) || $this->newEmail == '') || (!isset($this->newEmail2) || $this->newEmail2 == '') || (!isset($this->newUsername) || $this->newUsername == '') || (!isset($this->newPassword) || $this->newPassword == '') || (!isset($this->newPassword2) || $this->newPassword2 == '') ){ //[RA.S.001]
			//something's missing 
			$this->PrintError(0);
			return false;
		}
		if($this->newEmail != $this->newEmail2){ //[RA.S.002]
			//emails don't match
			$this->PrintError(1);
			return false;
		}
		if($this->newPassword != $this->newPassword2){ //[RA.S.002]
			//password don't match
			$this->PrintError(2);
			return false;
		}
		return true;

	}
	
	private function processData(){
		
		if($this->context == "Data was submitted"){
			
			$data_model = new APIModel();
			
			if($this->verifyForm()==true){
				
				$result = $data_model->addPerson($this->newUsername, $this->newPassword, $this->newEmail, $this->firstName, $this->lastName, $this->birthday,$this->hometown, $this->currentAddress, $this->education ); 
				
				if($result == "Registration successful."){
					
					$_SESSION['userid']=$data_model->getID($this->newUsername);
					?>

					<meta http-equiv="refresh" content="0; url=http://localhost:8888/CS460PA2/Newsfeed/newsFeed.php" />

					<!--<meta http-equiv="refresh" content="0; url=http://localhost:8888/Quartz4/Registration/welcome.php" />-->

					<?php					
				}
				else{
					print($result);
				}
			}
		}
	}
	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}