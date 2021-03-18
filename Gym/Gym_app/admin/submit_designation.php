<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['name'])) {
	$id    =  $_POST['id'];
	$name  = rtrim($_POST['name']);
  
    mysqli_query($con, "INSERT INTO designation (name)VALUES('$name')");
    //print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=designation_details'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=designation_details'>";
}
?>
