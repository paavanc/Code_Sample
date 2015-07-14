<?php
//echo "jugllu";
include 'newsFeedStub.php';
include 'newsFeedAPI.php';

//include '../Login/login.php';
class newsFeedActivity
{

	private $allPics;
	private $yourTags;
	private $allTags;
	private $yourAlbums;
	private $allAlbums;
	private $yourPics;
	private $allBrowsePictures;
	var $tagName;
	public $context;
	private $file;
	private $image_size;
	private $image;
	var $albumList;
	var $captionList;
	var $photoList;
	var $peopleList;
	//var $likeList;
	var $dates;


	var $idphoto;
	var $tagList;
	function __construct(){
		$this->getInput();
	}

	private function getInput(){
		if(isset($_POST["allpics"])){
			$this->context = "Data was submitted";
			$this->allPics = ($_POST["allpics"]);
			$this->yourTags = ($_POST["yourtag"]);
			$this->allTags = ($_POST["alltag"]);
		    $this->yourAlbums = ($_POST["yourAlbum"]);
			$this->allAlbums = ($_POST["allAlbum"]);
		    $this->yourPics = ($_POST["yourPicture"]);
			$this->allBrowsePictures = ($_POST["allPicture"]);
		

		}
		else{
			$this->context = "No data was submitted";
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
<title>Browse Photos By: </title>

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
<form action="newsFeed.php" method = "POST" >
Instructions: Please fill out one field at a time.  Thanks!
<br>
All: -Type in 1
<br>

<input type="text" id="name" name="allpics"/>
<br>
Your Photos By Tag: -Type in the tag name
<br>
<input type="text" id="name" name="yourtag"/>
<br>
All By Tag: -Type in the tag name
<br>
<input type="text" id="name" name="alltag"/>
<br>
Browse Your Albums: -Type in the album name
<br>
<input type="text" id="name" name="yourAlbum"/>
<br>
Browse All Albums: -Type in the album name
<br>
<input type="text" id="name" name="allAlbum"/>
<br>
Browse Your Pictures: -Type in the picture name
<br>
<input type="text" id="name" name="yourPicture"/>
<br>
Browse All Pictures: -Type in the picture name
<br>
<input type="text" id="name" name="allPicture"/>
<br>


<input type ="submit" value = "Submit">


</form>


</body>

</html>

		<?php

        

		
	}

	



	private function processData(){

		if($this->context == "Data was submitted"){

			$model = new APIModel();
			/*echo "allPics is: ". $this->allPics;
			echo "<br>";
			echo "yourTags is: ". $this->yourTags;
			echo "<br>";
			echo "allTags is: ". $this->allTags;
			echo "<br>";
			*/
			if ($this->allPics == 1 && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){
				//echo "we here 1";
	 $this->albumList=$model->allAlbumList();
     $this->captionList=$model->allCaptionsList();
     $this->photoList=$model->allgetImages();
     $this->dates=$model->allDateOfAlbums();
     
     $this->peopleList=$model->allOwnerList();
      $this->idphoto=$model->allPhotoIDList();
    // $this->likeList=$model->allLikeList();
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Pictures List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            echo"<td>Image:</td>";
           //  echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	
/*
            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            	//echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            		$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";



            }

			}
			else if ( $this->allPics == '' && $this->yourTags!='' &&  $this->allTags=='' && $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){
				
				$result = $model->verifyYourTag ($_SESSION['userid'], $this->yourTags);

				if ($result=="Tag Exists"){

					$this->tagList=$model->yourTagtagZList($_SESSION['userid'],$this->yourTags);


	 $this->albumList=$model->yourTagAlbumList($_SESSION['userid'],$this->yourTags);
     $this->captionList=$model->yourTagCaptionsList($_SESSION['userid'],$this->yourTags);
     $this->photoList=$model->yourTaggetImages($_SESSION['userid'],$this->yourTags);
     $this->dates=$model->yourTagDateOfAlbums($_SESSION['userid'],$this->yourTags);
     
     $this->peopleList=$model->yourTagOwnerList($_SESSION['userid'],$this->yourTags);
      $this->idphoto=$model->yourPhotoList($_SESSION['userid'],$this->yourTags);

     //$this->likeList=$model->yourTagLikeList($this->yourTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Pictures By Your Tag List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            echo"<td>Tag:</td>";
            echo"<td>Image:</td>";
            // echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	echo "<td>" .$this->tagList[$x]. "</td>";
            	

      
            		$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";



            	

            }

					




				}
				else {
					echo "<script>
			alert('You do not have a tag by this name');
			</script>";


				}




			}
			else if ($this->allPics == '' && $this->yourTags=='' &&  $this->allTags!='' && $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){
					
				$result = $model->verifyAllTag ($this->allTags);


				if ($result=="Tag Exists"){


$this->tagList=$model->allTagtagZList($this->allTags);
	 $this->albumList=$model->allTagAlbumList($this->allTags);
     $this->captionList=$model->allTagCaptionsList($this->allTags);
     $this->photoList=$model->allTaggetImages($this->allTags);
     $this->dates=$model->allTagDateOfAlbums($this->allTags);
     
     $this->peopleList=$model->allTagOwnerList($this->allTags);
     $this->idphoto=$model->allPhotoList($this->allTags);

     //$this->likeList=$model->allTagLikeList($this->allTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Pictures By Tag List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            echo"<td>Tag:</td>";

            echo"<td>Image:</td>";
          //   echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	echo "<td>" .$this->tagList[$x]. "</td>";
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            //	echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            	$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";


            	

            }
         


				}
				

				else {

						echo "<script>
			alert('This tag does not exist!');
			</script>";



				}

		




			}

					else if ($this->allPics == "" && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){
						echo "<script>
			alert('You messed up and didn't follow the directions!!!!!');
			</script>";
				}

					else if ($this->allPics == "" && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums!=''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){

										$result = $model->verifyAlbum ($_SESSION['userid'],$this->yourAlbums);


				if ($result=="Album Exists"){

					$albumid = $model ->getAlbumID($_SESSION['userid'],$this->yourAlbums);



	 $this->albumList=$model->yourAlbumsAlbumList($albumid );
     $this->captionList=$model->yourAlbumsCaptionsList($albumid );
     $this->photoList=$model->yourAlbumsgetImages($albumid );
     $this->dates=$model->yourAlbumsDateOfAlbums($albumid );
     
     $this->peopleList=$model->yourAlbumsOwnerList($albumid );
     $this->idphoto=$model->yourAlbumsPhotoList($albumid );

     //$this->likeList=$model->allTagLikeList($this->allTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Your Albums By Name List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            

            echo"<td>Image:</td>";
          //   echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
      
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            //	echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            	$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";


            	

            }
         


				}
				

				else {

						echo "<script>
			alert('You don't have an album by this name!');
			</script>";



				}
					




				}
	else if ($this->allPics == "" && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums==''&&  $this->allAlbums!=''&&  $this->yourPics=='' &&  $this->allBrowsePictures==''){
		//echo $this->allAlbums;

										$result = $model->verifyAllAlbum ($this->allAlbums);
										//echo $result;


				if ($result=="Album Exists"){

					



	 $this->albumList=$model->allAlbumsAlbumList($this->allAlbums);
     $this->captionList=$model->allAlbumsCaptionsList($this->allAlbums );
     $this->photoList=$model->allAlbumsgetImages($this->allAlbums );
     $this->dates=$model->allAlbumsDateOfAlbums($this->allAlbums);
     
     $this->peopleList=$model->allAlbumsOwnerList($this->allAlbums);
     $this->idphoto=$model->allAlbumsPhotoList($this->allAlbums );

     //$this->likeList=$model->allTagLikeList($this->allTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All ALbums By Name List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
          

            echo"<td>Image:</td>";
          //   echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            //	echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            	$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";


            	

            }
         


				}
				

				else {

						echo "<script>
			alert('The album you have chosen does not exist!');
			</script>";



				}
					




				}
					else if ($this->allPics == "" && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics!='' &&  $this->allBrowsePictures==''){


										$result = $model->verifyYourPics($_SESSION['userid'],$this->yourPics);


				if ($result=="Picture Exists"){

					$photoid = $model->getPhotoID($_SESSION['userid'],$this->yourPics);
					

					



	 $this->albumList=$model->yourPicsAlbumList($photoid);
     $this->captionList=$model->yourPicsCaptionsList($photoid );
     $this->photoList=$model->yourPicsgetImages($photoid);
     $this->dates=$model->yourPicsDateOfAlbums($photoid);
     
     $this->peopleList=$model->yourPicsOwnerList($photoid);
     $this->idphoto=$model->yourPicsPhotoList($photoid);

     //$this->likeList=$model->allTagLikeList($this->allTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Your Pictures By Name List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
            

            echo"<td>Image:</td>";
          //   echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            //	echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            	$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";


            	

            }
         


				}
				

				else {

						echo "<script>
			alert('You do not own a picture by this name!');
			</script>";



				}
					




				}
									else if ($this->allPics == "" && $this->yourTags=='' &&  $this->allTags==''&&  $this->yourAlbums==''&&  $this->allAlbums==''&&  $this->yourPics=='' &&  $this->allBrowsePictures!=''){

										$result = $model->verifyAllPics($this->allBrowsePictures);


				if ($result=="Picture Exists"){

					

					



	 $this->albumList=$model->allBrowsePicturesAlbumList($this->allBrowsePictures);
     $this->captionList=$model->allBrowsePicturesCaptionsList($this->allBrowsePictures);
     $this->photoList=$model->allBrowsePicturesgetImages($this->allBrowsePictures);
     $this->dates=$model->allBrowsePicturesDateOfAlbums($this->allBrowsePictures);
     
     $this->peopleList=$model->allBrowseOwnerList($this->allBrowsePictures);
     $this->idphoto=$model->allBrowsePhotoList($this->allBrowsePictures);

     //$this->likeList=$model->allTagLikeList($this->allTags);
      $this->arrlength=count($this->albumList);

        echo"<table id= 'myTable' style='width:800px;'>";
            echo"  <caption>All Pictures By Name List</caption>";
            echo"<tr>";
             echo"<td>Owner:</td>";
            echo"<td>Album Name:</td>";
            echo"<td>DateOfALbum:</td>	";	
            echo" <td>Picture Name: </td>";
       

            echo"<td>Image:</td>";
          //   echo"<td>Likes:</td>";
            echo"</tr>";
            for($x=0;$x<$this->arrlength;$x++) {

				
            	//echo $this->photoList[$x];
            	echo"<tr>";
            	echo "<td>" .$this->peopleList[$x]. "</td>";
            	echo "<td>" .$this->albumList[$x]. "</td>";
            	echo "<td>" .$this->dates[$x]. "</td>";
            	echo "<td>" .$this->captionList[$x]. "</td>";
            	
            	/*

            	$image = imagecreatefromstring($this->photoList[$x]); 
            	ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
				imagepng($image, null, 80);
				$data = ob_get_contents();
				ob_end_clean();
				
            	
            	echo '<td><img src="data:image/png;base64,' .  base64_encode($this->photoList[$x])  . '" /></td>';
            //	echo "<td>" .$this->likeList[$x]. "</td>";
            	
*/
            	$picid = $this->idphoto[$x];
				
				echo "<td><img src =../Newsfeed/get.php?id=".$picid."> </td>";


            	

            }
         


				}
				

				else {

						echo "<script>
			alert('You do not own a picture by this name!');
			</script>";



				}
					




				}

			else {


				echo "<script>
			alert('You messed up and didn't follow the directions!!!!!');
			</script>";


			}



		}			



	}

	

	

	
	public function run(){
		$this->processData();
		$this->showHTML();
	}
}	
	
	