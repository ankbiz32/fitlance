<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
    <h4>Personal Trainer Assign</h4>
    <hr />
    <form action="submit_trainer.php" method="POST" role="form" class="form-horizontal form-groups-bordered">
        <div class="form-group">
        <label class="col-sm-3 control-label">Member Name :</label>
        <div class="col-sm-3">
			<select name="member_name" class="form-control chosen-select" required="required">
			<option value="">-- Please select --</option>						
			<?php
			$query  = "select * from user_data where is_active='1' AND branch_id = '$_SESSION[branch_id]' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					echo "<option value=" .$row['newid']. ">" . $row['name'] . "</option>";
				}
			}
			?>								
			</select>
		</div>
        <label class="col-sm-3 control-label">Personal Trainer Name :</label>
        <div class="col-sm-3">						
			<select name="trainer_name" class="form-control chosen-select-trainer" required="required">
			<option value="">-- Please select --</option>						
			<?php
			$query  = "select * from staff_data where is_active='1' AND branch_id = '$_SESSION[branch_id]' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					echo "<option value=" . $row['staffid'] . ">" . $row['name'] . "</option>";
				}
			}
			?>								
			</select>
        </div>
        </div>

		<div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">Session Slot :</label>					
		<div class="col-sm-3">
			<select name="trainer_type_id" id="trainer_type_id" data-rule-required="true" class="country form-control" required="required">
				<option value="">-- Please select --</option>
				<?php
				$query = "select * from trainer_types where is_active='1' AND branch_id = '$_SESSION[branch_id]' ORDER BY id DESC";
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo "<option value=" . $row['staff_type_id'] . ">" . $row['time'] . "</option>";
					}
				}
				?>
			</select>
		</div>	
        <label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
        <div class="col-sm-3"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
							        echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
        </div>
        </div>

	    <div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
        <div class="col-sm-3">
		    <select name="payment_method" id="paymentdata" data-rule-required="true" class="form-control" >
				<option value="">-- Please select --</option>
				<option value="cash">By Cash</option>
				<option value="cheque">By Cheque</option>
				<option value="card pay">By Card Pay</option>
				<option value="RTGS">By RTGS</option>
				<option value="DD">By DD</option>
				<option value="NEFT">By NEFT</option>
			</select>
		</div>
		<label for="field-1" class="col-sm-3 control-label">Total Amount :</label>					
		<div class="col-sm-3"><input type="text" name="total" id="total" class="form-control" placeholder="Total Amount"></div>
        </div>

	    <div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">Paid Amount :</label>					
		<div class="col-sm-3"><input type="text" name="paid" id="paid" class="form-control" placeholder="Paid Amount">
		</div>
        </div>

		<div id="insertpayment" style="display:none">
		<div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">Cheque Number :</label>					
		<div class="col-sm-3">
		<input type="text" name="cheque_no"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
		</div>

		<label for="field-1" class="col-sm-2 control-label">Bank Name :</label>					
		<div class="col-sm-3">
			<select name="bank_id" id="bank" data-rule-required="true" class="form-control">
				<option value="">-- Please select --</option>
				<?php
				$query = "select * from bank_name";
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo "<option value=" . $row['id'] . ">" . $row['bank_name'] . "</option>";
					}
				}
				?>
			</select>
		</div>	
		<div class="col-sm-1"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Bank" id="newbank"><i class="entypo-plus"></i>Add</a></div>
		</div>
		</div>

		<div id="insertbank" style="display:none;">
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
			<div class="col-sm-3"><input type="text" name="bank_name"  class="form-control"  placeholder="Bank Name" id="bankname" data-rule-required="true"></div>
			<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="bank_save()"><i class="entypo-right"></i>Save</a></div>
		</div>
		</div>
		<div class="form-group">		
			<div class="col-sm-offset-3 col-sm-5">
			<button type="submit" class="btn btn-primary">Save</button>	
			</div>
		</div>				
    </form>

<script type="text/javascript">
	$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
	$(".chosen-select-trainer").chosen({no_results_text: "Oops, nothing found!"});
	
	$(document).ready(function()
	{
	$("#newbank").click(function()
	{
	$("#insertbank").show();   
	});
	$("#paymentdata").change(function()
	{
	var id=$(this).val();
	if(id=='cash'){
	$("#insertpayment").hide();
	}
	else if(id=='card pay'){
	$("#insertpayment").hide();
	}
	else if(id=='RTGS'){
	$("#insertpayment").hide();
	}
	else if(id=='DD'){
	$("#insertpayment").hide();
	}
	else if(id=='NEFT'){
	$("#insertpayment").hide();
	}else{
	$("#insertpayment").show();
	}
	});
	});
	
	function bank_save()
	{
		var bank_name = $('#bankname').val();
		var dataString = 'bank_name='+ bank_name; 
			$.ajax
			({    
			type: "GET",
			url: "ajax_bank.php",
			data: dataString,
			cache: false,
			success: function(html)
			{ 
			$('#bank').empty();                 
			$("#bank").append(html); 
			$("#insertbank").hide(); 
			}
		});
	}
</script>	

