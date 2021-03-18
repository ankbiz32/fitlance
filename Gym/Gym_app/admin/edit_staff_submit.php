<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['staffid'])) {
      $staffid   = $_POST['staffid'];
	  $date     =  $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	  $date1    = date('d-m-Y',strtotime($date));
	  $name      = rtrim($_POST['name']);
	  $email     = rtrim($_POST['email']);
	  $address   = rtrim($_POST['address']);
	  $mobile    = rtrim($_POST['mobile']);
	  $gender    = rtrim($_POST['gender']);
	  $designation = rtrim($_POST['designation']);
	  $age       = $_POST['age'];
	  $bank_name = $_POST['bank_name'];
	  $bank_acc  = rtrim($_POST['bank_acc']);
	  $branch_name = rtrim($_POST['branch_name']);
	  $ifsc_code = rtrim($_POST['ifsc_code']);
	  $micr_code = rtrim($_POST['micr_code']);
	  $insert_by = $_SESSION['id'];
	  $date = date('Y-m-d',strtotime($date1));
    mysqli_query($con, "UPDATE staff_data SET name='$name',email='$email',address='$address',mobile='$mobile',gender='$gender', age='$age',designation='$designation',date='$date', bank_acc='$bank_acc',bank_name='$bank_name',branch_name='$branch_name',ifsc_code='$ifsc_code',micr_code='$micr_code',insert_by='$insert_by' WHERE staffid='$staffid'");
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
    
}
?>