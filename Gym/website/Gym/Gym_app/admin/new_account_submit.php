<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['level']) && isset($_POST['full_name']) && isset($_POST['login_id']) && isset($_POST['password']) && isset($_POST['confirm'])&& isset($_POST['security'])) {
    
	$query2 = "select * from auth_user WHERE login_id='".$_POST['login_id']."'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
		$full_name    = rtrim($_POST['full_name']);
		$login_id     = rtrim($_POST['login_id']);
		$pass_key    = rtrim($_POST['password']);
		$security     = rtrim($_POST['security']);
		$level        = rtrim($_POST['level']);    
		$sex        = rtrim($_POST['sex']);
		mysqli_query($con, "INSERT INTO auth_user (login_id,pass_key,security,level,sex,name)VALUES('$login_id',$pass_key,'$security',$level,'$sex','$full_name')");
		echo "<head><script>alert('Login User Added ,Login Id :$login_id');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=new_account'>";
	}else
	{
	   echo "<head><script>alert('Login Id already exists, Check Again');</script></head></html>";
       echo "<meta http-equiv='refresh' content='0; url=index.php?vis=new_account'>";
	}
}
?>