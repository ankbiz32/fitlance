<?php
include('db_conn.php');
if (isset($_POST['mem_type'])){
$id = $_POST['mem_type'];
$query = "select * from mem_types where mem_type_id='".$id."'";
$result = mysqli_query($con, $query);
    if(mysqli_affected_rows($con) == 1 ){
	   $row = mysqli_fetch_array($result);
	}
	echo json_encode(array('status'=>200,'content'=>$row));
   	exit;
}
?>