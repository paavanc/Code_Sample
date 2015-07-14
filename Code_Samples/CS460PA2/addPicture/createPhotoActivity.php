<?php
include 'createPhotoStub.php';
include 'createPhotoAPI.php';


//include '../Login/login.php';
class createPhotoActivity
{

	private $pictureName;
	private $albumName;
	public $context;
	private $file;
	private $image_size;
	private $image;
	var $image_name;
	var $albumList;
	var $captionList;
	var $photoList;
	var $dates;
	var $counter=0;
	var $context2;
	var $del;
	var $idphoto;
	function __construct(){
		$this->getInput();
	}

	private function getInput(){
		if(isset($_POST["album"])){
			$this->context = "Data was submitted";
			$this->pictureName = ($_POST["picture"]);
			$this->albumName = ($_POST["album"]);
			$this->file = $_FILES['image']['tmp_name'];
			$this->image = addslashes( file_get_contents($_FILES['image']['tmp_name']));
			$this->image_size= getimagesize($_FILES['image']['tmp_name']);
			$this->image_name = addslashes($_FILES['image']['name']);

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
<form action="createPhoto.php" method = "POST" enctype = "multipart/form-data">
Picture Name:
<br>
<input type="text" id="name" name="picture"/>
<br>
Album Name:
<br>
<input type="text" id="name" name="album"/>
<br>
File:
<br>
<input type = "file" name ="image"> <input type ="submit" value = "Upload">


</form>

<?php

	 $model = new APIModel();


     $this->albumList=$model->AlbumList($_SESSION['userid']);
     $this->captionList=$model->pictureTitles($_SESSION['userid']);
     $this->photoList=$model->getImages($_SESSION['userid']);
     $this->dates=$model->datesOfPics($_SESSION['userid']);
     $this->idphoto=$model->photoID($_SESSION['userid']);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>Picture List</caption>";
            echo"<tr>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            echo"<td>Image:</td>";
            echo"<td>Delete:</td>";
            echo"</tr>";

            for($x=0;$x<$this->arrlength;$x++) {
            	//echo  $this->photoList[$x];

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	/*


            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				*/
			//	header("Content-type: image/gif");
				$picid = $this->idphoto[$x];
				
				echo "<td><img src =../addPicture/get.php?id=".$picid."> </td>";

				
				//echo '<td>'.base64_decode($this->photoList[$x]).'</td>';
				//echo '<td><img src="data:image/gif;base64,' . $this->photoList[$x] . '" /></td>';
				
            	
      
            	
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

	}
	
	private function verifyForm(){
			if ($_SESSION['userid']==""){
				echo "<script>
			alert('Session variable not working');
			</script>";

				}

		



		if((!isset($this->albumName) || $this->albumName == '') || (!isset($this->pictureName) || $this->pictureName == '')){
			//something's missing
			$this->PrintError(0);
			
			return false;
		}
		if(!isset($this->file)){
			//something's missing
			$this->PrintError(1);
			
			return false;
		}
		if($this->image_size == FALSE){
			//something's missing
			$this->PrintError(2);
			
			return false;
		}
		$model = new APIModel();
		$result = $model->verifyAlbum($_SESSION['userid'],$this->albumName);
		if($result != "Album Exists"){
			//something's missing
			$this->PrintError(3);
			
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

				
				



             $albumID=$model->getAlbumID($_SESSION['userid'], $this->albumName);
             if ($albumID =="Get ID Fail"){
             	echo "<script>
			alert('Get ID FAILED!');
			</script>";


             }
             
          //echo $this->image;

					$result = $model->createPicture($albumID,$this->image, $this->pictureName, $this->image_name);
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

      $result=$model->deletePhoto($this->idphoto[$this->del]);
      if($result==1){



print '<script type="text/javascript">'; 
print 'alert("The Photo '. $this->captionList[$this->del].' from Album '. $this->AlbumList[$this->del]. ' is succesfuly deleted")'; 
print '</script>'; 


      }

      else{
                print '<script type="text/javascript">'; 
print 'alert("The Photo '. $this->captionList[$this->del].' from Album '.$this->AlbumList[$this->del].' is NOT succesfuly  DELETED")'; 
print '</script>'; 
      }


	}
	}

	

	

	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}	
	
	