<?php
include('db_conn.php');
	if ($_POST['id']) {
	$id = $_POST['id'];
	$query  = "select * from staff_data";
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
			<option value="<?php echo $row['name'];?>" <?php if($id==$row['staffid']){echo'selected';} ?>><?php echo $row['name'];?></option>
			<?php }
		}
	}
?>