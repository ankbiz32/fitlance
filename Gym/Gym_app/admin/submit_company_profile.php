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

    mysqli_query($con, "INSERT INTO company_profile (name,email,address,mobile,website)VALUES('$name','$email','$address','$mobile','$website')");
    //print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
}
?>
