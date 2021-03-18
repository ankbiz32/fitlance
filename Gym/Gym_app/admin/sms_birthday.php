<?php
require 'db_conn.php';
sms_birthday($message,$contact);
function sms_birthday($message,$contact){
	$AUTH_KEY = "1952a2efef188b6fa9fa81d345a6281b";
	$message = "Happy%20Birthday!!%20Wish%20you%20a%20wonderful%20Birthday.%20I%20hope%20you%20have%20an%20amazing%20day..!";
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
	$query = "SELECT COUNT(*) FROM user_data WHERE MONTH(birthdate)= MONTH(NOW()) AND DAY(birthdate)=DAY(NOW());";
	//echo $query;
	$result  = mysqli_query($con, $query);
?>