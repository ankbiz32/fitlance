<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['id'])) {
	
		$joindate2 = $_POST['dayj'].'-'.$_POST['monthj'].'-'.$_POST['yearj'];
		$joindate1 = date('d-m-Y',strtotime($joindate2));
		$workout_time = rtrim($_POST['workout_time']);
		$full_name = rtrim($_POST['p_name']);
		$email = rtrim($_POST['email']);
		$address = rtrim($_POST['add']);
		$zipcode = rtrim($_POST['zipcode']);    
		$birthdate2 = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$birthdate1 = date('d-m-Y',strtotime($birthdate2));
		$contact = rtrim($_POST['contact']);
		$sex = rtrim($_POST['sex']);
		$comment = rtrim($_POST['comment']);
		$curr_date = date('Y-m-d');
		$landline = rtrim($_POST['landline']);
		$insert_by = $_SESSION['id']; 
		
		$joindate = date('Y-m-d',strtotime($joindate1));
		$birthdate = date('Y-m-d',strtotime($birthdate1));
		$date1 = date('d-m-Y',strtotime($curr_date));
		$id = $_POST['id'];
		
		mysqli_query($con, "UPDATE follow SET name='$full_name',address='$address',zipcode='$zipcode',birthdate='$birthdate',contact='$contact',email='$email',curr_date='$curr_date',comment='$comment',landline='$landline',joining='$joindate',sex='$sex' WHERE id=$id");
        echo "<meta http-equiv='refresh' content='0; url=index.php?vis=follow_up'>";
	} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>

