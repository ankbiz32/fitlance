<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['id'])) {
    $id      =  $_POST['id'];
	$name    = rtrim($_POST['name']);
    $email   = rtrim($_POST['email']);
    $address = rtrim($_POST['address']);
	$mobile  = rtrim($_POST['mobile']);
	$website = rtrim($_POST['website']);
	$insert_by = rtrim($_POST['insert_by']);
	
	// $fileinfo=PATHINFO($_FILES["image"]["name"]);
	// $newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	// move_uploaded_file($_FILES["image"]["tmp_name"],"../upload/" . $newFilename);
	// $location="../upload/" . $newFilename; 
	
	mysqli_query($con, "UPDATE card SET name='$name',address='$address',mobile='$mobile',email='$email',website='$website' WHERE id=$id");
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
	// print_r($_POST);
} else {
    echo "<head><script>alert('Item NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
    
}

?>