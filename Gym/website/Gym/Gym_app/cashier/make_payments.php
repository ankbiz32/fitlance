<?php
if (isset($_POST['name'])) {
    $memid  = $_POST['name'];
    $query1 = "select * from user_data WHERE newid='$memid'";
    //echo $query;
    $result1 = mysqli_query($con, $query1);
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            
            $name = $row1['name'];
            $pic  = $row1['pic_add'];
        }
    }
?>
		<h3>Payments</h3>
		<hr />
		<form action="submit_payments.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
					<div class="col-sm-5">
						<input type="text" name="p_id" value="<?php echo $memid; ?>" class="form-control"  readonly/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Name :</label>					
					<div class="col-sm-5">
						<input type="text" name="p_name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value="<?php echo $name; ?>" placeholder="Member Name" maxlength="30" readonly/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Photo :</label>					
					<div class="col-sm-5">
						<img src='../images/<?php echo $pic; ?>' style="height:150px; width:150px;border:1px solid;">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Date :</label>					
					<div class="col-sm-5">
						<input type="text" name="date" id="textfield22" class="input-medium datepicker" value="<?php echo date('Y-m-d'); ?>">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Membership Type :</label>					
					<div class="col-sm-5">
						<select name="mem_type" id="id" data-rule-required="true" class="country">
							<option value="">-- Please select --</option>
							<?php
							    $query = "select * from mem_types";
							    //echo $query;
							    $result = mysqli_query($con, $query);
							    if (mysqli_affected_rows($con) != 0) {
							        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							            echo "<option value=" . $row['mem_type_id'] . ">" . $row['name'] . "</option>";
							            
							        }
							    }
							    
							?>
						</select>
					</div>
			</div>

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<div class="city"></div>
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
	 echo "<meta http-equiv='refresh' content='0; url=index.php?vis=payments'>";
    
}
?>