<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>

<?php
if (isset($_POST['name'])) {
    $id = $_POST['name'];
	$query  = "select * from trainer_pay WHERE id='$id'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
	if (mysqli_affected_rows($con) == 1) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$member_id = $row['member_id'];
			$member_name = $row['member_name'];
			$staff_id  = $row['staff_id'];
			$staff_name  = rtrim($row['staff_name']);
			$trainer_type_id = rtrim($row['trainer_type_id']);
			$bank_id  = rtrim($row['bank_id']);    
			$paid_date = $row['paid_date'];
			$join_date = rtrim($row['join_date']);
			$payment_method = rtrim($row['payment_method']);
			$cheque_no = $row['cheque_no'];
			$total = rtrim($row['total']);
			$paid = rtrim($row['paid']);
			$invoice = $row['invoice'];
			$expiry = rtrim($row['expiry']);
			$exp_time  = rtrim($row['exp_time']);
			$date2 = date('d',strtotime( $row['join_date'] ));
			$month2 = date('m',strtotime( $row['join_date'] ));
			$year2 = date('Y',strtotime( $row['join_date'] ));
			if(!empty($cheque_no)){?> 
			<script type="text/javascript">
			$(document).ready(function()
			{
			$("#insertpayment").show();
			});
			</script>
			<?php }
		}
	}
?>
<h4 class="hed">Personal Trainer Assign Update : </h4>
<hr />
<form action="edit_submit_trainer.php"  method="POST" role="form" class="form-horizontal form-groups-bordered">
<input type="hidden" value="<?php echo $id;?>" name="id"/>
<input type="hidden" value="<?php echo $invoice;?>" name="invoice"/>
  <div class="form-group">
   <label class="col-sm-3 control-label">Member Name :</label>
          <div class="col-sm-3">						
			<select name="member_name" id="name" class="form-control chosen-select">
			  <option value="">-- Please select --</option>						
			  <?php
				$query  = "select * from user_data";
				//echo $query;
				$result = mysqli_query($con, $query);
				  if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					 <option value="<?php echo $row['newid'];?>" <?php if($row['name']==$member_name){echo 'selected';} ?>> <?php echo $row['name'];?></option>
				<?php	}
				  }
			  ?>								
			</select>
          </div>
        <label class="col-sm-3 control-label">Personal Trainer Name :</label>
          <div class="col-sm-3">						
			<select name="trainer_name" id="name" class="form-control chosen-select-trainer">
			  <option value="">-- Please select --</option>						
			  <?php
			  $query  = "select * from staff_data";
			  //echo $query;
			  $result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					<option value="<?php echo $row['staffid'];?>" <?php if($row['name']==$staff_name){echo 'selected';} ?>> <?php echo $row['name'];?></option>
				<?php  }
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
				$query = "select * from trainer_types";
				//echo $query;
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) { 
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
				  <option value="<?php echo $row['staff_type_id'];?>" <?php if($row['staff_type_id']==$trainer_type_id){echo 'selected';} ?>> <?php echo $row['time'];?></option>
				<?php  }
				}
				?>
			</select>
		</div>	
	 <label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
          <div class="col-sm-3"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $date2){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($num==$month2){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$year2){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
          </div>
      </div>
  <div class="form-group"><label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
	<div class="col-sm-3"><select name="payment_method" id="paymentdata" data-rule-required="true" class="form-control" >
		<option value="">-- Please select --</option>
		<option value="cash" <?php if($payment_method=='cash'){echo 'selected';} ?> >By Cash</option>
		<option value="cheque" <?php if($payment_method=='cheque'){echo 'selected';} ?>>By Cheque</option>
		<option value="card pay" <?php if($payment_method=='card pay'){echo 'selected';} ?>>By Card Pay</option>
		<option value="RTGS" <?php if($payment_method=='RTGS'){echo 'selected';} ?>>By RTGS</option>
		<option value="DD" <?php if($payment_method=='DD'){echo 'selected';} ?>>By DD</option>
		<option value="NEFT" <?php if($payment_method=='NEFT'){echo 'selected';} ?>>By NEFT</option>
	</select></div>
	<label for="field-1" class="col-sm-3 control-label">Total Amount :</label>					
		<div class="col-sm-3">
			<input type="text" name="total" id="total" class="form-control" placeholder="Total Amount" value="<?php echo $total;?>">
	</div>
</div>
<div class="form-group">
	<label for="field-1" class="col-sm-3 control-label">Paid Amount :</label>					
		<div class="col-sm-3">
			<input type="text" name="paid" id="paid" class="form-control" placeholder="Paid Amount" value="<?php echo $paid;?>">
	</div>
</div>
<div id="insertpayment" style="display:none">
<div class="form-group">
	<label for="field-1" class="col-sm-3 control-label">Cheque Number :</label>					
	  <div class="col-sm-3">
		<input type="text" name="cheque_no"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno" value="<?php echo $cheque_no;?>">
	  </div>
   <label for="field-1" class="col-sm-2 control-label">Bank Name :</label>					
	<div class="col-sm-3"><select name="bank_id" id="bank" data-rule-required="true" class="form-control">
			<option value="">-- Please select --</option>
			<?php
			$query = "select * from bank_name";
			$result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
			  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
			  <option value="<?php echo $row['id'];?>" <?php if($row['id']==$bank_id){echo 'selected';} ?>> <?php echo $row['bank_name'];?></option>
			 <?php }
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
<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_details'>";
}
?>
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