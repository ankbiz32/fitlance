<?php
if (isset($_POST['name'])) {
    $invoice = $_POST['name'];
?>
		<h3>Pay Balance </h3>
		<hr />
		<form action="bal_pay_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">

			<?php
			    $query  = "select * from subsciption WHERE invoice='$invoice'";
			    //echo $query;
			    $result = mysqli_query($con, $query);
			    $sno    = 1;
			    
			    if (mysqli_affected_rows($con) == 1) {
			        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			            $name  = $row['name'];
			            $total = $row['total'];
			            $paid  = $row['paid'];
			        }
			    }
			?>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Member Name :</label>					
					<div class="col-sm-5">
						<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" readonly/>
					</div>
			</div>


			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Invoice :</label>					
					<div class="col-sm-5">
						 <input type="text" name="invoice" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value ='<?php echo $invoice; ?>' placeholder="Plan Name" maxlength="100"class="uneditable-input"  readonly>
					</div>
			</div>
					

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Total :</label>					
					<div class="col-sm-5">
						 <input type="text" name="total" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Days" value ='<?php echo $total; ?>'  onKeyPress="return checkIt(event)" maxlength="9">
					</div>
			</div>
					
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Paid :</label>					
					<div class="col-sm-5">
						 <input type="text" name="paid" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Mobile / Phone" value ='<?php echo $paid; ?>'  onKeyPress="return checkIt(event)" maxlength="10">
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
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid'>";
}
?>

