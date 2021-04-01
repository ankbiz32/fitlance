<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
			<h2>Edit Invoice</h2>
			<hr />
			<form action="edit_submit_payments.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">


			<?php
			    
			    $query  = "select * from subsciption WHERE invoice='$memid'";
			    //echo $query;
			    $result = mysqli_query($con, $query);
			    $sno    = 1;
			    
			    if (mysqli_affected_rows($con) == 1) {
			        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			            $mem_id    = $row['mem_id'];
			            $name      = $row['name'];
			            $paid_date = $row['paid_date'];
			        }
			    }
			?>


				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_id" value="<?php echo $memid;?>" class="form-control" readonly/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Invoice :</label>					
						<div class="col-sm-5">
							<input type="text" name="invoice" value="<?php echo $memid; ?>" class="form-control" readonly/>
						</div>
				</div>


				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Name :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_name" id="textfield3" class="form-control"  data-rule-required="true" data-rule-minlength="4" value="<?php echo $name;?>" placeholder="Member Name" maxlength="30" readonly/>
						</div>
				</div>
					
						
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Payment Date :</label>					
						<div class="col-sm-5">
							<input type="text" name="date" id="textfield22" class="form-control datepicker" value="<?php echo $paid_date; ?>">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Membership Type :</label>					
						<div class="col-sm-5">
							<select name="mem_type" id="id" data-rule-required="true" class="form-control country" >
							<option value="">-- Please select --</option>
								<?php    
								    $query = "select * from mem_types where branch_id = '$_SESSION[branch_id]' ";
								    
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
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>

