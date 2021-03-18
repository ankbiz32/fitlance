<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['name'])) {
  function getRandomWord($len = 3)
	{
	  $word = array_merge(range('a', 'z'), range('0', '9'));
	  shuffle($word);
	  return substr(implode($word), 0, $len);
	}
	$query2 = "select * from staff_data WHERE staffid=".$_POST['staffid'];
	$result2 = mysqli_query($con, $query2);
	  if (mysqli_num_rows($result2) == 0){
	  $invoice   = substr(time(), 2, 10) . getRandomWord();
	  $staffid   = $_POST['staffid'];
	  $date1     = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	  $name      = rtrim($_POST['name']);
	  $email     = rtrim($_POST['email']);
	  $address   = rtrim($_POST['address']);
	  $mobile    = rtrim($_POST['mobile']);
	  $gender    = rtrim($_POST['gender']);
	  $designation = rtrim($_POST['designation']);
	  $age       = $_POST['age'];
	  $bank_name = rtrim($_POST['bank_name']);
	  $bank_acc  = rtrim($_POST['bank_acc']);
	  $branch_name = rtrim($_POST['branch_name']);
	  $ifsc_code = rtrim($_POST['ifsc_code']);
	  $micr_code = rtrim($_POST['micr_code']);
	  $insert_by = $_SESSION['id'];
	  $date = date('Y-m-d',strtotime($date1));
	  mysqli_query($con, "INSERT INTO staff_data (staffid,name,email,address,mobile,gender,designation,age,date,bank_name,bank_acc,branch_name,ifsc_code,micr_code,insert_by)VALUES('$staffid','$name','$email','$address','$mobile','$gender','$designation','$age','$date','$bank_name','$bank_acc','$branch_name','$ifsc_code','$micr_code','$insert_by')");
	  //print_r($_POST);
	  echo "<head><script>alert('Staff Name Added , Staff Name :$name');</script></head></html>";
	  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
	  }else
	  {
	  echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
	  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
	  }
}
?>
