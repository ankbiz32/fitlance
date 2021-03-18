<?php
include('db_conn.php');
  if(!empty($_GET['bank_name'])) {
    $query2 = "select * from bank_name WHERE bank_name='".$_GET['bank_name']."'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
	   $query = "insert into bank_name(bank_name) values ('".$_GET['bank_name']."')";
	  $result = mysqli_query($con, $query);
	  $query1 = "select * from bank_name ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['bank_name'] . "</option>";
			  
		  }
		}
	}else
	{
	    $query1 = "select * from bank_name ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['bank_name'] . "</option>";
			  
		  }
		}
	}
}else{
        $query1 = "select * from bank_name ORDER BY id desc";
		$result = mysqli_query($con, $query1);
		$num = mysqli_affected_rows($con);
		if ($num != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  echo "<option value=" . $row['id'] . ">" . $row['bank_name'] . "</option>";
			  
		  }
		}
}
?>