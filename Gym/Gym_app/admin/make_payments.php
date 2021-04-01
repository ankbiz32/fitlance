<?php
if (isset($_POST['name'])) {
$memid  = $_POST['name'];
$query1 = "select * from user_data WHERE newid='$memid'";
$result1 = mysqli_query($con, $query1);
if (mysqli_affected_rows($con) == 1) {
	while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		$name = $row1['name'];
	}
}
?>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
<h4>Payments Information :</h4>
<hr />
	<form action="new_make_payments.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
		<div class="row">
			<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
				<div class="col-sm-9"><input type="text" name="p_id" value="<?php echo $memid;?>" class="form-control" readonly/></div>
			</div>
			<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
				<div class="col-sm-9"><input type="text" name="p_name" id="textfield3" class="form-control"  data-rule-required="true" data-rule-minlength="4" value="<?php echo $name;?>" placeholder="Member Name" maxlength="30" readonly/></div>
			</div>
		</div>
		<h4>Plan Information:</h4>
		<hr />
		<table class="table table-bordered table-striped">
			<tr>
				<th><b>Invoice #</b></th>
				<th><b>Payment Date</b></th>
				<th><b>Membership Type</b></th>
				<th><b>Total</b></th>
				<th><b>Paid</b></th>
				<th><b>Balance</b></th>
				<th><b>Expiry</b></th>
				<th><b>Payment Method</b></th>
			</tr>
			<?php
			$query  = "select * from subsciption WHERE mem_id='$memid'";
			$result = mysqli_query($con, $query);
			$sno    = 1;
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$query1 = "select * from mem_types where mem_type_id ='".$row['sub_type']."'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1);
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));
				echo'<tr>';
				echo"<td>".$row['invoice']."</td>";
				echo"<td>". $date1 ."</td>";
				echo"<td>".$row1['name']."</td>";
				echo"<td>".$row['total']."</td>";
				echo"<td>".$row['paid']."</td>";
				echo"<td>".$row['bal']."</td>";
				echo"<td>". $date2 ."</td>";
				echo"<td>".$row['payment_method']."</td>";
				echo'</tr>';
			}
			?>
		</table>
		<h4>Add New Payments :</h4>
		<hr />
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
			<div class="col-sm-5">
				<?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
						echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
						echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
			</div>
		</div>
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label"> Membership Type :</label>					
			<div class="col-sm-5">
				<select name="mem_type" id="id" data-rule-required="true" class="form-control country">
					<option value="">-- Please select --</option>
					<?php    
					$query = "select * from mem_types where branch_id = '$_SESSION[branch_id]' ";
					$result = mysqli_query($con, $query);
					if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					<option value="<?php echo $row['mem_type_id']; ?>" <?php if($paln == $row['mem_type_id']){echo 'selected';}?>><?php echo $row['name']; ?></option>
					<?php	}
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
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
			<div class="col-sm-3">
				<select name="paymentdata" id="paymentdata" data-rule-required="true" class="form-control" >
					<option value="">-- Please select --</option>
					<option value="cash">By Cash</option>
					<option value="cheque">By Cheque</option>
					<option value="card pay">By Card Pay</option>
					<option value="RTGS">By RTGS</option>
					<option value="DD">By DD</option>
					<option value="NEFT">By NEFT</option>
				</select>
			</div>
			<div id="insertpayment" style="display:none" >
				<div class="col-sm-3">
					<input type="text" name="chequeno" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
				</div>
			</div>
		</div>
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Discount :</label>					
			<div class="col-sm-5">
				<input type="text" name="dis" class=" form-control" onKeyPress="return checkIt(event)"  placeholder="Discount">
			</div>
		</div>
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Paid Date :</label>					
			<div class="col-sm-5">
				<?php echo "<select name='dayp'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='monthp'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yearp'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
			</div>
		</div>
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Bank Name :</label>					
			<div class="col-sm-5">
				<select name="bank" id="bank" data-rule-required="true" class="form-control">
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
			<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Bank" id="newbank"><i class="entypo-plus"></i>Add</a></div>
		</div>
		<div class="form-group" id="insertbank" style="display:none;"><label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
			<div class="col-sm-5"><input type="text" name="bank_name"  class="form-control"  placeholder="Bank Name" id="bankname" data-rule-required="true"></div>
			<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="bank_save()"><i class="entypo-right"></i>Save</a></div>
		</div>	
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-5">
				<button type="submit" class="btn btn-primary">Save changes</button>	
				<button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>	
			</div>
		</div>		
	</form>
<script type="text/javascript">
	$(document).ready(function()
	{
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
	$("#newbank").click(function()
	{
	$("#insertbank").show();   
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

<?php
} else {
  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=payments'>";
}
?>