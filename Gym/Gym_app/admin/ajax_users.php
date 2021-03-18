<?php
include('db_conn.php');
if ($_POST['id']) {
  $id = $_POST['id'];
  //$query  = "select * from user_data WHERE id='$id'";
  $query  = "select * from user_data";
  //echo $query;
  $result = mysqli_query($con, $query);
  if (mysqli_affected_rows($con) != 0) {
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
		<option value="<?php echo $row['name'];?>" <?php if($id==$row['newid']){echo'selected';} ?>><?php echo $row['name'];?></option>
	<?php }
  }
}
?>