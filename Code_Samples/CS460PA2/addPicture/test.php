< ?php
$con=file_get_contents(“tkdown.gif”);
$en=base64_encode($con);
$mime=’image/gif';
$binary_data=’data:’ . $mime . ‘;base64,’ . $en ;
? >

<img src=”<?php echo $binary_data; ?>” alt=”Test”>