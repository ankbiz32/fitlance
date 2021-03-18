<?php
include('db_conn.php');
session_start();
  if(!empty($_POST['name'])) {
    $query2 = "select * from workout_time WHERE name='".$_POST['name']."'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
	   $query = "insert into workout_time(name,insert_by) values ('".$_POST['name']."','".$_SESSION['id']."')";
	  //echo "insert into workout_time(name,insert_by) values ('".$_POST['name']."','".$_SESSION['id']."')";
	  $result = mysqli_query($con, $query);
	  $query1 = "select * from workout_time ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}else{
	    $query1 = "select * from workout_time ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}
}else{
        $query1 = "select * from workout_time ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
}
?>