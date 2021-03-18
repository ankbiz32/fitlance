<?php
$a = $_SERVER['HTTP_REFERER'];
if (strpos($a, '/Gym/') !== false) {
} else {
    header("Location: index.php");
}
?>
<?php
include 'include/db_conn.php';
session_start();
if (isset($_REQUEST['user_id_auth'])){
$user_id_auth = ltrim($_POST['user_id_auth']);
$user_id_auth = rtrim($user_id_auth);

$pass_key = ltrim($_POST['pass_key']);
$pass_key = rtrim($_POST['pass_key']);

$user_id_auth = stripslashes($user_id_auth);
$pass_key     = stripslashes($pass_key);

$user_id_auth = mysqli_real_escape_string($con, $_POST['user_id_auth']);
$pass_key     = mysqli_real_escape_string($con, $_POST['pass_key']);
$sql          = "SELECT * FROM auth_user WHERE login_id='$user_id_auth' and pass_key='$pass_key'";
$result       = mysqli_query($con, $sql);
$count        = mysqli_num_rows($result);
$info         = mysqli_fetch_assoc($result);

$login_id     = $info['login_id'];
$role_id      = $info['level'];
$branch_id    = $info['branch_id'];
$name         = $info['name'];
$login_time   = date("Y-m-d H:i:s");
$logout_time  = date("Y-m-d H:i:s");
$query        = "INSERT into `user_sessions` (login_id, login_time, role_id, branch_id, name, logout_time) VALUES ('$login_id', '$login_time', '$role_id', '$branch_id', '$name', '$logout_time')";
$result       = mysqli_query($con,$query);

function expiry_msg($message,$contact){
    $AUTH_KEY = "72cb95dfd3a1f683269b32882788116";
    //$message = "YOUR%20REGISTRATION%20HAS%20BEEN%20SUCCESSFUL..!";
    $senderId = "DEMOOS";
    $routeId = "1";
   // $mobileNos  = "8975687500";
    $smsContentType ="english";
    $url = "http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$AUTH_KEY."&message=".$message."&senderId=".$senderId."&routeId=".$routeId."&mobileNos=".$contact."&smsContentType=".$smsContentType."";
    $ch = curl_init();
    $timeout = 30;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTIONTIMEOUT,$timeout);
    $response =curl_exec($ch);
    curl_close($ch);
    //echo $response;
}


if ($count == 1) {
    // store session data
    $_SESSION['user_data']  = $user_id_auth;
    $_SESSION['logged']     = "start";
    $_SESSION['auth_level'] = $info['level'];
    $_SESSION['sex']        = $info['sex'];
    $_SESSION['full_name']  = $info['name'];
	$_SESSION['id']         = $info['id'];
	$_SESSION['branch_id']  = $info['branch_id'];
    $auth_l_x               = $_SESSION['auth_level'];
    if ($auth_l_x == 1) {
	  //echo $auth_l_x;
	  $days_ago = date('Y-m-d', strtotime('+10 days', strtotime(date('Y-m-d'))));
      //echo $days_ago;
      //exit;
      $query1 ="select * from subsciption WHERE expiry ='".$days_ago."' AND msg_status = '0' AND bal>0";
      $result = mysqli_query($con,$query1);
      if (mysqli_affected_rows($con) != 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $msgid   = $row['mem_id'];
        $query2  = "select * from user_data WHERE newid='$msgid' AND is_active='1'";
		$result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
        $name = $row2['name'];
        $contact= $row2['contact'];
        $balance = $row['bal'];
        $expdate = $row['expiry'];
        $message = urlencode('Dear '.$name.' ( Member Id : '.$msgid.') your pending amount of Rs.'.$balance.' is expected on '.$expdate.' from Aim Fitness.');
        expiry_msg($message,$contact);
        mysqli_query($con, "UPDATE subsciption SET msg_status='1' WHERE id=".$row['id']."");
               
        }
    }
        header("location: Gym_app/admin/");
    } else if ($auth_l_x == 2) {
       header("location: Gym_app/branch/");
    } else if ($auth_l_x == 3) {
        header("location: Gym_app/account/");  
	} else if ($auth_l_x == 4) {
        header("location: Gym_app/fc/");
	} else {
        header("location:index.php");
    }
} else {
    include 'index.php';
    echo "<html><head><script>alert('Username OR Password is Invalid');</script></head></html>";
}
}
?>