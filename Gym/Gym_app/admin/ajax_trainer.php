<?php
include('db_conn.php');
session_start();
  if(!empty($_GET['trainerid'])&&!empty($_GET['trainername'])&&!empty($_GET['trainerdays'])&&!empty($_GET['trainertime'])) {
    $query2 = "select * from trainer_types WHERE staff_type_id='".$_GET['trainerid']."'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
	   $query = "insert into trainer_types(staff_type_id,name,day,time,insert_by) values ('".$_GET['trainerid']."','".$_GET['trainername']."','".$_GET['trainerdays']."','".$_GET['trainertime']."','".$_SESSION['id']."')";
	  $result = mysqli_query($con, $query);
	  $query1 = "select * from trainer_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}else
	{
	    $query1 = "select * from trainer_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}
}else{
        $query1 = "select * from trainer_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
}
?>