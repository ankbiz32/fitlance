<?php
if (isset($_POST['name'])) {
$msgid = $_POST['name'];
?>

	<form action="submit_designation_edit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
	<?php
	$query  = "select * from designation WHERE id='$msgid'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
		if (mysqli_affected_rows($con) == 1) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$name    = $row['name'];
			}
		}
	?>
	<div class="row">
	<h3>Edit Designation Details</h3>
    <hr />
	<div class="col-md-5 form-group"><label for="field-1" class="col-sm-4 control-label">Designation ID:</label>					
	<div class="col-sm-8"><input type="text" name="id" id="id" value="<?php echo $msgid; ?>" class="form-control" placeholder="ID" readonly></div>
	</div>
	<div class="col-md-5 form-group"><label for="field-1" class="col-sm-4 control-label">Designation :</label>					
	<div class="col-sm-8"><input type="text" name="name" id="name" value ='<?php echo $name; ?>' class="form-control" placeholder="Designation" ></div>
	</div>
	<div class="col-md-2 form-group"><button type="submit" class="btn btn-primary pull-left">Submit</button></div>
	</div>
	</form>
<?php
} else {
echo "<meta http-equiv='refresh' content='0; url=?vis=designation_details'>";
}
?>

