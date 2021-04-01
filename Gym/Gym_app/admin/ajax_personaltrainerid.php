<?php
include('db_conn.php');
	if ($_POST['name']) {
	$name = $_POST['name'];
	//$query  = "select * from staff_data WHERE id='$id'";
	$query  = "select * from staff_data where designation='3'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
			<option value="<?php echo $row['staffid'];?>" <?php if($name==$row['name']){echo'selected';}?>><?php echo $row['staffid'];?></option>
			<?php }
		}
    }
?>