<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
	<h4>Edit Invoice</h4>
	<hr />
	<form action="edit_submit_payments.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
		<?php
		$query  = "select * from subsciption WHERE invoice='$memid'";
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) == 1) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$mem_id    = $row['mem_id'];
					$name      = $row['name'];
					$paid_date = $row['paid_date'];
					$plan = $row['sub_type'];
					$totalcost = $row['total'];
					$paidamount = $row['paid'];
					$paymentmethod = $row['payment_method'];
					$cheque_no = $row['cheque_no'];
					$date1 = date('d',strtotime( $row['paid_date'] ));
					$month1 = date('m',strtotime( $row['paid_date'] ));
					$year1 = date('Y',strtotime( $row['paid_date'] ));
				}
			}
		?>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
				<div class="col-sm-5">
					<input type="text" name="p_id" value="<?php echo $mem_id;?>" class="form-control" readonly/>
				</div>
		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Name :</label>					
				<div class="col-sm-5">
					<input type="text" name="p_name" id="textfield3" class="form-control"  data-rule-required="true" data-rule-minlength="4" value="<?php echo $name;?>" placeholder="Member Name" maxlength="30" readonly/>
				</div>
		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Invoice :</label>					
				<div class="col-sm-5">
					<input type="text" name="invoice" value="<?php echo $memid; ?>" class="form-control" readonly/>
				</div>
		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Payment Date :</label>					
				<div class="col-sm-5">
					<?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $date1){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($num==$month1){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$year1){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
				</div>
		</div>
		<h4>Plan Information:</h4>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Old Membership Type :</label>					
				<div class="col-sm-3">
						<?php    
							$query = "select * from mem_types where mem_type_id ='".$plan."'";
							$result = mysqli_query($con, $query);
							$row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
						?>
					<input name="plan" value="<?php echo $row1['name'];?>" class="form-control" readonly  />
				</div>
				<div class="col-sm-3"><input name="totalcost" value="<?php echo $totalcost;?>" class="form-control" readonly /></div>
				<div class="col-sm-3"><input name="paidamount" value="<?php echo $paidamount;?>" class="form-control"  readonly /></div>
		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Payment Method :</label>					
				<div class="col-sm-3">
					<input name="plan" value="<?php echo $paymentmethod;?>" class="form-control" readonly  />
				</div>
				<div class="col-sm-3"><input name="oldcheque_no" value="<?php echo $cheque_no;?>" class="form-control" placeholder="Cheque Number" readonly  /></div>
		</div>
		<div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Change Membership Type :</label>					
				<div class="col-sm-5">
					<select name="mem_type" id="id" data-rule-required="true" class="form-control country" >
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
		<label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
			<div class="col-sm-3"><select name="paymentdata" id="paymentdata" data-rule-required="true" class="form-control" >
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
				<input type="text" name="chequeno"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
			  </div>
		</div>
		</div>
		<div class="form-group">		
			<div class="col-sm-offset-3 col-sm-5">
				<div class="city"></div>
			</div>
		</div>	
		<div class="form-group">
				<div class="col-sm-offset-3 col-sm-5">
					<button type="submit" class="btn btn-primary">Save</button>	
				</div>
		</div>		
	</form>
<?php
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>
<script type="text/javascript">
		$(document).ready(function()
		{
		$("#newworkout").click(function()
		{
		$("#insertworkout").show();   
		});
		$("#newplan").click(function()
		{
		$("#insertplan").show();   
		});
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
		function workout_save()
		{
		
			var name = $('#workout_name').val();
			var dataString = 'name='+ name;              
				$.ajax
				({    
				type: "POST",
				url: "ajax_workout.php",
				data: dataString,
				cache: false,
				success: function(html)
				{  
				//alert(html); 
				$('#workoutdata').empty();                 
				$("#workoutdata").append(html); 
				$("#insertworkout").hide(); 
				}
			});
		}
		function plan_save()
		{
			var planid = $('#planid').val();
			var planname = $('#planname').val();
			var plandays = $('#plandays').val();
			var planrate = $('#planrate').val();
			var dataString = 'planid='+ planid  +'&planname='+ planname +'&plandays='+ plandays +'&planrate='+ planrate; 
			//alert(dataString);              
				$.ajax
				({    
				type: "GET",
				url: "ajax_plan.php",
				data: dataString,
				cache: false,
				success: function(html)
				{ 
				$('#plan').empty();                 
				$("#plan").append(html); 
				$("#insertplan").hide(); 
				}
			});
		}
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

