
<?php
session_start();
echo $_SESSION['userid'];


?>
<!DOCTYPE html>
<html>
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
<body>
<br>
<button onclick="newsFeed()">Newsfeed</button><button onclick="addFriend()">Friend</button><button onclick="createAlbum()">CreateAlbum</button><button onclick="createPhoto()">CreatePicture</button><button onclick="addLike()">AddLike</button><button onclick="AddTag()">AddTag</button><button onclick="addComment()">AddComment</button><button onclick="showLike()">ListOfLikes</button><button onclick="UserActivity()">UserActivity</button><button onclick="PopTag()">PopularTags</button><button onclick="logout()">Logout</button>
<br>
<br>


<button onclick="myFunction()">LOGOUT</button>


<script>
function myFunction() {

   window.location.href ="http://localhost:8888/CS460PA2/Login/login.php";
}
</script>

</body>
</html>



	
	