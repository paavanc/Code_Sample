<?php
include 'addFriendStub.php';
include 'addFriendAPI.php';
class addFriendActivity
{
	private $friendName;
	public $context;
	var $del;
	var $list;
	var $userlist;
	var $counter=0;
	 var $context2;
	
	function __construct(){
		$this->getInput();
	}
	
	private function showHead(){
		?>
		<head>
		<link rel="stylesheet" type="text/css" href="Login.css">
		</head><?php
	}
	
	private function showForm(){
		print("<body bgcolor='#EEEEEE'>");
		?>
		<html>
		<head>
<script>
function createAlbum() {

	<?php

	if ($_SESSION['userid']!=-99){

	?>

    window.location.href ="http://localhost:8888/CS460PA2/createAlbum/createAlbum.php";
<?php

}
?>
}
function createPhoto() {
		<?php

	if ($_SESSION['userid']!=-99){

	?>
    window.location.href ="http://localhost:8888/CS460PA2/addPicture/createPhoto.php";
    <?php
}
?>
}
function addLike() {
		<?php

	if ($_SESSION['userid']!=-99){

	?>
    window.location.href ="http://localhost:8888/CS460PA2/addLike/addLike.php";
    <?php
}
?>
}
function AddTag() {
		<?php

	if ($_SESSION['userid']!=-99){

	?>
    window.location.href ="http://localhost:8888/CS460PA2/addTag/addTag.php";
    <?php
}
?>
}
function addComment() {
    window.location.href ="http://localhost:8888/CS460PA2/addComment/addComment.php";
}
function newsFeed() {
    window.location.href ="http://localhost:8888/CS460PA2/Newsfeed/newsFeed.php";
}
function addFriend() {
		<?php

	if ($_SESSION['userid']!=-99){

	?>
    window.location.href ="http://localhost:8888/CS460PA2/addFriend/addFriend.php";
    	<?php
}
?>
}
function logout() {
    window.location.href ="http://localhost:8888/CS460PA2/Logout/Logout.php";
}
function showLike() {
    window.location.href ="http://localhost:8888/CS460PA2/showLikes/showLike.php";
}
function showLike() {
    window.location.href ="http://localhost:8888/CS460PA2/showLikes/showLike.php";
}
function UserActivity() {
    window.location.href ="http://localhost:8888/CS460PA2/showContributers/showContributer.php";
}
function PopTag() {
    window.location.href ="http://localhost:8888/CS460PA2/showPopTags/showPopTags.php";
}

</script>
			
		</head>
		<body>
		<br>
<button onclick="newsFeed()">Newsfeed</button><button onclick="addFriend()">Friend</button><button onclick="createAlbum()">CreateAlbum</button><button onclick="createPhoto()">CreatePicture</button><button onclick="addLike()">AddLike</button><button onclick="AddTag()">AddTag</button><button onclick="addComment()">AddComment</button><button onclick="showLike()">ListOfLikes</button><button onclick="UserActivity()">UserActivity</button><button onclick="PopTag()">PopularTags</button><button onclick="logout()">Logout</button>
<br>
<br>

			<div id="containerActivity">
		   		<div id="contentActivity">
		   			<form action='' method='post'>
						<fieldset>
							<legend>Add Friend</legend>
							<p class="name"><label for="name">Friend Name:</label> <input type="text" id="name" name="friend"/></br>
							<p class="submit"><input type='submit' value=' Add '/>
							</form>
							<form action='../addFriend/addFriend.php'>
							<p class="reset"><input type='submit' value='Reset'/>
							</form>
						</fieldset>
					</form>
		    	 </div>
			</div>
			<?php
			$model = new APIModel();


			$this->list=$model->FriendList($_SESSION['userid']);
            $this->arrlength=count($this->list);
            
            echo"<table id= 'myTable' style='width:400px'>";
            echo"  <caption>Friend List</caption>";
            echo"<tr>";
            echo"<td>Friend Name:</td>";
            echo"<td>Delete:</td>	";	
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {
             echo"<tr>";
            echo "<td>" .$this->list[$x]. "</td>";
            echo "<td> <form  action='' method='POST'>"; 
            echo"<input type='hidden' id='pleasework' name='item' value='" . $this->counter. "' />";
            echo "<input type='submit' id=" .$this->counter. " name='Deletez' value='Delete' ></form></td>";
            echo"</tr>";
            echo"<br>";
            echo"<br>";



            $this->counter++;
            }

            $this->userlist=$model->notFriendList($_SESSION['userid']);
            $this->arrlength2=count($this->userlist);
            echo"<table id= 'myTable' style='width:200px'>";
            echo"  <caption>NO Friend List</caption>";
            echo"<tr>";
            echo"<td>Not Your Friends:</td>";	
            echo"</tr>";
            for($x=0;$x<$this->arrlength2;$x++) {
            	echo"<tr>";
            	echo "<td>" .$this->userlist[$x]. "</td>";
            	echo "<tr>";



            }



			?>

		</body>		
	</html>
	<?php }
	
	private function showBody(){
		print("<body>");
		$this->showForm();
		print("</body>");
	}
	
	
	private function showHTML(){
		echo $_SESSION['userid'];
		print("<html>");
		$this->showHead();
		$this->showBody();
		print("</html>");
	}
	
	private function getInput(){
		if(isset($_POST["friend"])){
			$this->context = "Data was submitted";
			$this->friendName = ($_POST["friend"]);
		}
		else{
			$this->context = "No data was submitted";
		}

		if (isset($_POST['Deletez'])){
      $this->del=$_POST['item'];
      $this->context2=1;

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
		if((!isset($this->friendName) || $this->friendName == '')){
			//something's missing
			$this->PrintError(0);
			
			return false;
		}
		else{
			return true;
		}
	}
	
	private function processData(){
		if($this->context == "Data was submitted"){
			$model = new APIModel();
			if($this->verifyForm()){
				if ($_SESSION['userid']==""){
				echo "<script>
			alert('Session variable not working');
			</script>";

				}
					$result = $model->createFriend($_SESSION['userid'], $this->friendName);
					if($result == "Creation successful."){
						//session_register($this->username);


						//echo $userID;

			print '<script type="text/javascript">'; 
		print 'alert("The friend '.$this->friendName.' is succesfuly added")'; 
			print '</script>'; 


						

					?>
						<!--<form method="get" action="../createAlbum/createAlbum.php">
    				<input type="hidden" name="userid" value='<?php //echo $userID; ?>'>
    				<input type="submit">
						</form>-->

						<!--<meta http-equiv="refresh" content="0; url=http://localhost:8888/CS460PA2/addPicture/createPhoto.php" />-->

						<?php
					
		

					} 
					else{
						
						print($result);
					}
				
			}
		}

		      if($this->context2 == 1){

		      	$model = new APIModel();





      $this->list=$model->FriendList($_SESSION['userid']);
      $result=$model->deleteFriend($this->list[$this->del],$_SESSION['userid']);
      if($result==1){



print '<script type="text/javascript">'; 
print 'alert("The friend '. $this->list[$this->del].' is succesfuly deleted")'; 
print '</script>'; 


      }

      else{
                print '<script type="text/javascript">'; 
print 'alert("The friend '. $this->list[$this->del].' is NOT succesfuly  DELETED")'; 
print '</script>'; 
      }


	}
}
	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}	
	
	