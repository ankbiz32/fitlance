<?php
include('db_conn.php');
session_start();
  if(!empty($_GET['planid'])&&!empty($_GET['planname'])&&!empty($_GET['plandays'])&&!empty($_GET['planrate'])) {
    $query2 = "select * from mem_types WHERE mem_type_id='".$_GET['planid']."'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
	   $query = "insert into mem_types(mem_type_id,name,days,rate,insert_by) values ('".$_GET['planid']."','".$_GET['planname']."','".$_GET['plandays']."','".$_GET['planrate']."','".$_SESSION['id']."')";
	  $result = mysqli_query($con, $query);
	  $query1 = "select * from mem_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}else
	{
	    $query1 = "select * from mem_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
	}
}else{
        $query1 = "select * from mem_types ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
			  
		  }
		}
}
?>