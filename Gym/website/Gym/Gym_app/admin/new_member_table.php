<?php
if (isset($_POST['name'])) {
     $memid  = $_POST['name'];
     $query1 = "select * from user_data WHERE newid='$memid'";
    
    //echo $query;
    $result1 = mysqli_query($con, $query1);
    
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            
            $pic = $row1['pic_add'];
        }
    }
?>

		<h3>New Member Schedule</h3>
		<hr />
		<form action="submit_new_table.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">


			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
					<div class="col-sm-5">
						<input type="text" name="p_id" value="<?php echo $_POST['name']; ?>" class="form-control"  readonly/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Photo :</label>					
					<div class="col-sm-5">
						<img src='<?php echo $pic; ?>'>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Name :</label>					
					<div class="col-sm-5">
						<input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value="<?php echo $_POST['full_name']; ?>"  maxlength="100" readonly/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Sechdule Details :</label>					
					<div class="col-sm-5">
						<textarea class="form-control" name="details" data-rule-minlength="5" maxlength="999" cols="200" rows="10"></textarea>
					</div>
			</div>						

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Date :</label>					
					<div class="col-sm-5">
						 <input type="text" name="date" id="textfield22" class="form-control datepicker">
					</div>
			</div>	

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Save changes</button>	
					</div>
			</div>	

		</form>

<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=table_view'>";
    
}
?>