<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['member_name'])) {
function getRandomWord($len = 3)
  {
	$word = array_merge(range('a', 'z'), range('0', '9'));
	shuffle($word);
	return substr(implode($word), 0, $len);
  }
	$staff_type = $_POST['trainer_type_id'];
	$query1 = "select * from trainer_types WHERE staff_type_id='$staff_type'";
    //echo $query1;
	$result1 = mysqli_query($con, $query1);
	  if (mysqli_affected_rows($con) == 1) {
		  while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
			$name    = $row1['name'];
			$time    = $row1['time'];
			$day     = $row1['day'];
		 }
	  }
	$newid = $_POST['member_name'];
	$query2 = "select * from user_data WHERE newid='$newid'";
	$result2 = mysqli_query($con, $query2);
	  if (mysqli_affected_rows($con) == 1) {
		  while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			$name_member    = $row2['name'];
		 }
	  }
	$staffid = $_POST['trainer_name'];
	$query3 = "select * from staff_data WHERE staffid='$staffid'";
	$result3 = mysqli_query($con, $query3);
	  if (mysqli_affected_rows($con) == 1) {
		  while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
			$name_staff   = $row3['name'];
		 }
	  }
	$member_name  = rtrim($_POST['member_name']);
	$trainer_name = rtrim($_POST['trainer_name']);
	$trainer_type_id  = rtrim($_POST['trainer_type_id']);
	$date2    = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	$date1    = date('d-m-Y',strtotime($date2));
	$payment_method = $_POST['payment_method'];
	$total = $_POST['total'];
	$paid = $_POST['paid'];
	$paybalance = $total - $paid;
	$cheque_no = $_POST['cheque_no'];
	$bank_id = $_POST['bank_id'];
	$invoice   = substr(time(), 2, 10) . getRandomWord();
	$insert_by = $_SESSION['id'];
	$date = date('Y-m-d',strtotime($date1));
	$mod_date  = strtotime($date . "+ $day day");
	$expiry    = date("Y-m-d", $mod_date);
	$wait      = "no";
	$time      = $day * 86400;
	$exp_time = $time + strtotime($date);
	//$expiry = date('Y-m-d',strtotime($expiry));
	echo $expiry_date;
    mysqli_query($con, "UPDATE trainer_pay SET renewal='no' WHERE member_id=$member_name");
    mysqli_query($con, "INSERT INTO trainer_pay (member_id,member_name,staff_id,staff_name,trainer_type_id,bank_id,paid_date,join_date,payment_method,expiry_date,cheque_no,total,paid,invoice,paybalance,expiry,renewal,exp_time,insert_by)VALUES('$member_name','$name_member','$trainer_name','$name_staff','$trainer_type_id','$bank_id','$date','$date','$payment_method','$expiry','$cheque_no','$total','$paid','$invoice','$paybalance','$expiry','yes','$exp_time','$insert_by')");
	//print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_details'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_details'>";
    
}
?>
