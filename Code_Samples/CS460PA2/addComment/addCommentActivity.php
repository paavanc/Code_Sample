<?php
//echo "jugllu";
include 'addCommentStub.php';
include 'addCommentAPI.php';

//include '../Login/login.php';
class addCommentActivity
{

	private $pictureName;
	private $albumName;
	private $userName;
	var $commentName;
	public $context;
	private $file;
	private $image_size;
	private $image;
	var $albumList;
	var $captionList;
	var $photoList;
	var $dates;
	var $counter=0;
	var $context2;
	var $del;
	var $idphoto;
	var $commentList;
	var $peopleList;
	function __construct(){
		$this->getInput();
	}

	private function getInput(){
		if(isset($_POST["album"])){
			$this->context = "Data was submitted";
			$this->pictureName = ($_POST["picture"]);
			$this->albumName = ($_POST["album"]);
			$this->userName = ($_POST["user"]);
			$this->commentName = ($_POST["comment"]);

		}
		else{
			$this->context = "No data was submitted";
		}


	if (isset($_POST['Deletez'])){
      $this->del=$_POST['item'];
      $this->context2=1;

    }
	}


	private function showHTML(){
		echo $_SESSION['userid'];
		?>
		<!--<html>
<body>
 
<form action="createAlbumActivity.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"/>
    <br />
    <input type="submit"/>
</form>
 
</body>
</html>-->

<html>
<head>
<title>Upload Image </title>
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
<form action="addComment.php" method = "POST" >
Comment:
<br>
<input type="text" id="name" name="comment"/>
<br>
Picture Name:
<br>
<input type="text" id="name" name="picture"/>
<br>
Album Name:
<br>
<input type="text" id="name" name="album"/>
<br>
Owner's Name:
<br>
<input type="text" id="name" name="user"/>
<br>
<input type ="submit" value = "Submit">


</form>

<?php

	 $model = new APIModel();


     $this->albumList=$model->AlbumList($_SESSION['userid']);
     $this->captionList=$model->pictureTitles($_SESSION['userid']);
     $this->photoList=$model->getImages($_SESSION['userid']);
     $this->dates=$model->datesOfPics($_SESSION['userid']);
     $this->idphoto=$model->photoID($_SESSION['userid']);
     $this->commentList=$model->commentZList($_SESSION['userid']);
      $this->peopleList=$model->ownerLIst($_SESSION['userid']);

      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>Comment List</caption>";
            echo"<tr>";
            echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
             echo"<td>Comment:</td>";
            echo"<td>Image:</td>";
            echo"<td>Delete:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	echo "<td>" .$this->commentList[$x]. "</td>";
/*
            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';

            	*/
            	$picid = $this->idphoto[$x];

            	echo "<td><img src =../addComment/get.php?id=".$picid."> </td>";
            	
           echo "<td> <form  action='' method='POST'>"; 
            echo"<input type='hidden' id='pleasework' name='item' value='" . $this->counter. "' />";
            echo "<input type='submit' id=" .$this->counter. " name='Deletez' value='Delete' ></form></td>";
            echo "<td> <form  action='' method='POST'>";




            	$this->counter++;

            }


?>


</body>

</html>

		<?php

        

		
	}
	private function PrintError($err_num){
		if($err_num == 0){
			echo "<script>
			alert('Something is missing from the form');
			</script>";
		}
		if($err_num == 1){
			echo "<script>
			alert('Please select an image.');
			</script>";
		}
		if($err_num == 2){
			echo "<script>
			alert('Thats not an image!');
			</script>";
		}
		if($err_num == 3){
			echo "<script>
			alert('Album does not exist!');
			</script>";
		}
		if($err_num == 5){
			echo "<script>
			alert('Picture does not exist!');
			</script>";
		}
		if($err_num == 4){
			echo "<script>
			alert('Person does not exist!');
			</script>";
		}

	}
	
	private function verifyForm(){
			if ($_SESSION['userid']==""){
				echo "<script>
			alert('Session variable not working');
			</script>";

				}

		



		if((!isset($this->albumName) || $this->albumName == '') || (!isset($this->pictureName) || $this->pictureName == '') || (!isset($this->userName) || $this->userName == '') || (!isset($this->commentName) || $this->commentName == '')){
			//something's missing
			$this->PrintError(0);
			
			return false;
		}

		$model = new APIModel();

			$result = $model->verifyPerson($this->userName);
		if($result != "Person Exists"){
			//something's missing
			$this->PrintError(4);
			
			return false;
		}





		$userid = $model->getID($this->userName);
		$result = $model->verifyAlbum($userid,$this->albumName);
		if($result != "Album Exists"){
			//something's missing
			$this->PrintError(3);
			
			return false;
		}
			
	
		$albumID=$model->getAlbumID($userid, $this->albumName);
		$result = $model->verifyPicture($albumID,$this->pictureName);
		if($result != "Picture Exists"){
			//something's missing
			$this->PrintError(5);
			
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

				
				


				$userid = $model->getID($this->userName);
             $albumID=$model->getAlbumID($userid, $this->albumName);
             if ($albumID =="Get ID Fail"){
             	echo "<script>
			alert('Get ID FAILED!');
			</script>";


             }
             
          $pictureID=$model->getPhotoID($albumID, $this->pictureName);

					$result = $model->addComment($pictureID, $this->commentName, $_SESSION['userid'] );
					if($result == "Creation successful."){
						//session_register($this->username);


						//echo $userID;
						echo "<script>
			alert('WE DID IT!');
			</script>";


						
					
		

					} 
					else{
						
						print($result);
					}
				
			}
		}



				      if($this->context2 == 1){

		      	$model = new APIModel();





       $this->idphoto=$model->photoID($_SESSION['userid']);
        $this->albumList=$model->AlbumList($_SESSION['userid']);
     $this->captionList=$model->pictureTitles($_SESSION['userid']);
     $this->commentList=$model->commentZList($_SESSION['userid']);

      $result=$model->deleteComment($this->idphoto[$this->del], $this->commentList[$this->del]);
      if($result==1){



print '<script type="text/javascript">'; 
print 'alert("The comment '.$this->commentList[$this->del].' from the picture '. $this->captionList[$this->del].' from Album '. $this->AlbumList[$this->del]. ' is succesfuly deleted")'; 
print '</script>'; 


      }

      else{
                print '<script type="text/javascript">'; 
print 'alert("The comment '.$this->commentList[$this->del].' from the picture '. $this->captionList[$this->del].' from Album '.$this->AlbumList[$this->del].' is NOT succesfuly  DELETED")'; 
print '</script>'; 
      }


	}
	}

	

	

	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}	
	
	