<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['item'])) {
	$id    =  $_POST['id'];
	$item  = rtrim($_POST['item']);
    $price  = rtrim($_POST['price']);
    $date2  =  $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	$date1    = date('d-m-Y',strtotime($date2));
	$insert_by = rtrim($_POST['insert_by']);
	$date = date('Y-m-d',strtotime($date1));
    mysqli_query($con, "INSERT INTO expance (item,price,date,insert_by)VALUES('$item','$price','$date','$insert_by')");
    //print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=account_mangement'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=expance'>";
}
?>
