<?php
//echo "jugllu";
include 'showLikeStub.php';
include 'showLikeAPI.php';

//include '../Login/login.php';
class showLikeActivity
{

	private $pictureName;
	private $albumName;
	private $userName;
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
	var $likeList;
	var $peopleList;



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


<?php



	 $model = new APIModel();


     $this->albumList=$model->AlbumList();
     $this->captionList=$model->pictureTitles();
     $this->photoList=$model->getImages();
     $this->dates=$model->datesOfPics();
     $this->idphoto=$model->photoID();
     $this->likeList=$model->likeZList();
      $this->peopleList=$model->ownerLIst();

      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>Like List</caption>";
            echo"<tr>";
            echo"<td>Liker of Photo:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
             echo"<td>Like:</td>";
            echo"<td>Image:</td>";
            
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	echo "<td>" .$this->likeList[$x]. "</td>";
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            	*/
            		$picid = $this->idphoto[$x];

            	echo "<td><img src =../addLike/get.php?id=".$picid."> </td>";
 




            	$this->counter++;

            }


?>


</body>

</html>

		<?php

        

		
	}
	

	

	

	
	public function run(){
	
		$this->showHTML();
	}
}	
	
	