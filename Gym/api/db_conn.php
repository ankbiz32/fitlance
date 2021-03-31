<?php
date_default_timezone_set('Asia/Calcutta'); 
error_reporting(0);
$host     = "localhost"; 
$username = "root"; 
$password = "";
$db_name  = "aimfitness";

/*$host     = "localhost"; 
$username = "thefitn1_aimgym"; 
$password = "Aimfitness@2018";
$db_name  = "thefitn1_aimfitness";*/

$con      = mysqli_connect($host, $username, $password, $db_name);
if (mysqli_connect_errno()) {
    // echo "Failed to connect to MySQL: " . mysqli_connect_error();
    $resp['status']='error';
    $resp['error_msg']='Database connection failed';
    $resp=json_encode($resp);
    echo $resp;
    exit;
}
?>
