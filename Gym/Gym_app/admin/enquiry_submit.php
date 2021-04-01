<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['submit']) && $_POST['submit'] == 'submit') {
	if (!empty($_POST['mem_type']) && !empty($_POST['total']) && !empty($_POST['paid'])) {
    function getRandomWord($len = 3)
    {
	    $word = array_merge(range('a', 'z'), range('0', '9'));
	    shuffle($word);
	    return substr(implode($word), 0, $len);
    }
	function new_register($message,$contact)
	{
		$AUTH_KEY = "1952a2efef188b6fa9fa81d345a6281b";
		$message = "YOUR%20REGISTRATION%20HAS%20BEEN%20SUCCESSFUL..!";
		$senderId = "ORANGE";
		$routeId = "1";
		//$mobileNos  = "8975687500";
		$smsContentType ="english";
		$url = "http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$AUTH_KEY."&message=".$message."&senderId=".$senderId."&routeId=".$routeId."&mobileNos=".$contact."&smsContentType=".$smsContentType."";
		//echo $url;
		$ch = curl_init();
		$timeout = 30;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTIONTIMEOUT,$timeout);
		$response =curl_exec($ch);
		curl_close($ch);
		//echo $response;
	}
    $mem_type = $_POST['mem_type'];
    $query1 = "select * from mem_types WHERE mem_type_id='$mem_type'";
    $result1 = mysqli_query($con, $query1);
    if (mysqli_affected_rows($con) == 1) {
	  while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		$name_type = $row1['name'];
		$details   = $row1['details'];
		$days      = $row1['days'];
		$rate      = $row1['rate'];
	  }
    }
    $query2 = "select * from user_data WHERE newid=".$_POST['p_id'];
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
		$invoice   = substr(time(), 2, 10) . getRandomWord();
		$p_id = $_POST['p_id'];
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
		$activity = rtrim($_POST['activity']);
		$curr_date = date('Y-m-d');
		$landline = rtrim($_POST['landline']);
		$total     = $_POST['total'];
		$paid      = $_POST['paid'];
		$mod_date  = strtotime($joindate1 . "+ $days days");
		$expiry    = date("Y-m-d", $mod_date);
		$wait      = "no";
		$time      = $days * 86400;
		$exp_time = $time + strtotime($joindate1);
		$insert_by = $_SESSION['id']; 
		$bank_id = $_POST['bank'];
		$paymentdata= $_POST['paymentdata'];
		$chequeno= $_POST['chequeno'];
		$dis= $_POST['dis'];
		$joindate = date('Y-m-d',strtotime($joindate1));
		$birthdate = date('Y-m-d',strtotime($birthdate1));
		$date1 = date('d-m-Y',strtotime($curr_date));
		$branch_id= $_SESSION['branch_id'];

        mysqli_query($con,"INSERT INTO user_data (wait,newid,name,address,zipcode,birthdate,contact,email,curr_date,landline,joining,workout_time_id,sex,activity,branch_id,insert_by)VALUES('$wait','$p_id','$full_name','$address','$zipcode','$birthdate','$contact','$email','$curr_date','$landline','$joindate','$workout_time','$sex','$activity','$branch_id',$insert_by)");
		//print_r($_POST);
		$total = $total - $dis;
		$expiry = $expiry ;
		$expiry1 = date('d-m-Y',strtotime( $expiry ));
		$bal = $total - $paid;
		$branch_id= $_SESSION['branch_id'];
		
		mysqli_query($con, "INSERT INTO subsciption (mem_id,bank_id,name,sub_type,paid_date,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,exp_time,payment_method,cheque_no,renewal,curr_date,pay_date,branch_id,insert_by)
	VALUES ('$p_id','$bank_id','$full_name','$mem_type','$joindate','$total','$paid','$dis','$total_dis','$expiry','$invoice','$name_type','$bal','$exp_time','$paymentdata','$chequeno','yes','$curr_date','$curr_date','$branch_id','$insert_by')");
	
	    mysqli_query($con, "INSERT INTO payment (mem_id,bank_id,name,sub_type,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,payment_method,cheque_no,renewal,pay_date,insert_by)
	VALUES ('$p_id','$bank_id','$full_name','$mem_type','$total','$paid','$dis','$total_dis','$expiry','$invoice','$name_type','$bal','$paymentdata','$chequeno','yes','$curr_date','$insert_by')");

		echo "<head><script>alert('Member Added ,Member Id : $p_id');</script></head></html>";
		new_register($message,$contact);
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
	}
	else
	{
	   echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
       echo "<meta http-equiv='refresh' content='0; url=index.php?vis=add_enquiry2'>";
	}
	}
	else
	{
	   echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
       echo "<meta http-equiv='refresh' content='0; url=index.php?vis=add_enquiry2'>";
	}
}else{
    if (isset($_POST['follow_up']) && $_POST['follow_up'] == 'submit') {

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
		$curr_date = date('Y-m-d');
		$landline = rtrim($_POST['landline']);
		$insert_by = $_SESSION['id']; 
		$comment = rtrim($_POST['comment']);
		$branch_id = $_SESSION['branch_id'];
		
		$joindate = date('Y-m-d',strtotime($joindate1));
		$birthdate = date('Y-m-d',strtotime($birthdate1));
		$date1 = date('d-m-Y',strtotime($curr_date));
        mysqli_query($con,"INSERT INTO follow (name,address,zipcode,birthdate,contact,email,curr_date,landline,joining,sex,comment,branch_id,insert_by)VALUES('$full_name','$address','$zipcode','$birthdate','$contact','$email','$curr_date','$landline','$joindate','$sex','$comment','$branch_id',$insert_by)");
		//print_r($_POST);
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=follow_up'>";
    } else {
    echo "<head><script>alert('Follow Up NOT Add, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=add_enquiry2'>";
    }
}
 $query2 = "select * from card where branch_id = '$_SESSION[branch_id]' ";
 //echo $query2;
 $result2 = mysqli_query($con, $query2);
 if (mysqli_affected_rows($con) != 0) {
	while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
		$name_company = $row2['name'];
		$email_company = $row2['email'];
		$address_company = $row2['address'];
		$mobile_company = $row2['mobile'];
		$website = $row2['website'];
		$img_location = $row2['img_location'];
	}
 }
?>
<style>
	#hed {
		display: inline-block;
	}
	.hed_btn {
		background: transparent;
	}
</style>