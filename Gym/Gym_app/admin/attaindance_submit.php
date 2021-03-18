<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['name'])) {
	$id      =  $_POST['id'];
	$name    = rtrim($_POST['name']);
    $email   = rtrim($_POST['email']);
    $address = rtrim($_POST['address']);
	$mobile  = rtrim($_POST['mobile']);
	$website = rtrim($_POST['website']);
	//$image   = rtrim($_POST['image']);
	$insert_by = rtrim($_POST['insert_by']);
	
	$fileinfo=PATHINFO($_FILES["image"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["image"]["tmp_name"],"../upload/" . $newFilename);
	$location="../upload/" . $newFilename;
 
	
    mysqli_query($con, "INSERT INTO card (name,email,address,mobile,website,img_location,insert_by)VALUES('$name','$email','$address','$mobile','$website','$location','$insert_by')");
    //print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=attaindance'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=attaindance'>";
}
?>
