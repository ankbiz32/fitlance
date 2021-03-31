<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {cursor: not-allowed;background-color: #efefef;
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
<h4 class="hed">Edit Member Details :</h4>
<hr />
    <form action="edit_mem_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
	<?php
	$query  = "select * from user_data WHERE newid='$memid'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
	if (mysqli_affected_rows($con)) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$query1  = "select * from subsciption WHERE mem_id='$memid'";
			//echo $query1;
			$result1 = mysqli_query($con, $query1);
			if (mysqli_affected_rows($con)) {
				while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
					//$invoice = $row1['invoice'];
					$mem_type = $row1['sub_type'];
					$query2 = "select * from mem_types WHERE mem_type_id='$mem_type'";
					//echo $query2;
					$result2 = mysqli_query($con, $query2);
					if (mysqli_affected_rows($con)) {
						while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
							$rate = $row2['rate'];
							$sub_type_name = $row1['sub_type_name'];
							$payment_method = $row1['payment_method'];
							$dis = $row1['dis'];
							$paid = $row1['paid'];
							$total = $row1['total'];
							$bal = $row1['bal'];
							$expiry = $row1['expiry'];
					    $invoice = $row1['invoice'];
							$p_id = $row['newid'];
							$joindate = $row['joining'];
							$workout_time = $row['workout_time_id'];
							$full_name = $row['name'];
							$email = rtrim($row['email']);
							$address = rtrim($row['address']);
							$zipcode = rtrim($row['zipcode']);    
							$birthdate = $row['birthdate'];
							$contact = rtrim($row['contact']);
							$sex = rtrim($row['sex']);
							$curr_date = $row['curr_date'];
							$landline = rtrim($row['landline']);
							$activity = rtrim($row['activity']);
							$date1 = date('d-m-Y',strtotime( $row['curr_date'] ));
							$date2 = date('d',strtotime( $row['joining'] ));
							$month2 = date('m',strtotime( $row['joining'] ));
							$year2 = date('Y',strtotime( $row['joining'] ));
							$date3 = date('d',strtotime( $row['birthdate'] ));
							$month3 = date('m',strtotime( $row['birthdate'] ));
							$year3 = date('Y',strtotime( $row['birthdate'] ));
						}
					}
				}
			}
		}
	}
	?>
	<input type="hidden" name="expiry" value="<?php echo $expiry; ?>" class="form-control" readonly/>
	<input type="hidden" name="paid" value="<?php echo $paid; ?>" class="form-control" readonly/>
	<input type="hidden" name="bal" value="<?php echo $bal; ?>" class="form-control" readonly/>
	<input type="hidden" name="invoice" value="<?php echo $invoice; ?>" class="form-control" readonly/>
    <div class="row">
     <h4 class="hed">Personal Information :</h4>
      <hr/>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
        <div class="col-sm-9"><input type="text" name="p_id" value="<?php echo $p_id; ?>" class="form-control" readonly/></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-9"><input type="text" name="p_name" id="textfield3" value="<?php echo $full_name;?>" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Member Name" maxlength="30" required="required"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Email Id :</label>					
        <div class="col-sm-9"><input type="text" name="email"  id="emailfield" value="<?php echo $email;?>" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60"></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Birthdate :</label>			
        <div class="col-sm-9"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $date3){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($num==$month3){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$year3){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Mobile :</label>					
        <div class="col-sm-9"><input type="text" name="contact" id="textfield6" value="<?php echo $contact;?>" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Mobile" onKeyPress="return checkIt(event)" maxlength="12"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Landline No. :</label>					
        <div class="col-sm-9"><input type="text" name="landline" id="textfield6"  value="<?php echo $landline;?>" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Landline No." onKeyPress="return checkIt(event)" maxlength="12"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
        <div class="col-sm-9"><?php echo "<select name='dayj'>"; foreach($days as $valued) { if($valued == $date2){ $default = 'selected="echo $date2;"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='monthj'>"; foreach($months as $num => $name) { if($num==$month2){ $default1 = 'selected="echo $month2;"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yearj'>"; foreach($years as $valuey) { if($valuey==$year2){ $default1 = 'selected="echo $year2;"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Gender :</label>					
        <div class="col-sm-9"><select name="sex" id="bbb" data-rule-required="true" class="form-control">
                <option value="">-- Please select --</option>
                <option value="Male" <?php if($sex=='Male'){echo'selected';} ?>>Male</option>
                <option value="Female" <?php if($sex=='Female'){echo'selected';} ?>>Female</option>
				 <option value="Other" <?php if($sex=='Other'){echo'selected';} ?>>Other</option>
            </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Address :</label>					
        <div class="col-sm-9"><input type="text" name="add" id="textfield5" class="form-control" value="<?php echo $address;?>" data-rule-required="true" data-rule-minlength="6" placeholder="Address"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Pin Code :</label>					
        <div class="col-sm-9"><input type="text" name="zipcode" id="zipcode" class="form-control" value="<?php echo $zipcode;?>" data-rule-required="true" data-rule-minlength="6" placeholder="Pincode" onKeyPress="return checkIt(event)" maxlength="6"></div>
      </div>
    </div>
	<hr />
	<div class="row">
	  <h4 class="hed">Payment & Plan Information : </h4>
      <hr/>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Preferred Workout :</label>				
        <div class="col-sm-9">
			<select name="workout_time" id="bbb" data-rule-required="true" class="form-control" required="required">
                <option value="">-- Please select --</option>
                <?php
				$query = "select * from workout_time";
				//echo $query;
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					  <option value="<?php echo $row['id']?>" <?php if($row['id']==$workout_time){echo'selected';}?>><?php echo $row['name'];?></option>
				<?php 
				}
				}
				?>
			</select>
		</div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Activity :</label>					
        <div class="col-sm-9"><input type="text" name="activity" id="textfield5" value="<?php echo $activity;?>" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Activity"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership Type :</label>					
        <div class="col-sm-9"><select name="mem_type" onchange="plan_Details(this.value)" data-rule-required="true" class="form-control">
				<option value="">-- Please select --</option>
				<?php
					$query = "select * from mem_types";
					$result = mysqli_query($con, $query);
					if (mysqli_affected_rows($con) != 0) {
					  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					  <option value="<?php echo $row['mem_type_id']?>" <?php if($row['mem_type_id']==$mem_type){echo'selected';}?>><?php echo $row['name'];?></option>
				 <?php }
				}
				?>
            </select>
        </div>	
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
        <div class="col-sm-9"><select name="payment_method" id="paymentdata" data-rule-required="true" class="form-control">
                <option value="">-- Please select --</option>
                <option value="cash" <?php if($payment_method=='cash'){echo'selected';} ?>>By Cash</option>
                <option value="cheque" <?php if($payment_method=='cheque'){echo'selected';} ?>>By Cheque</option>
				<option value="card pay" <?php if($payment_method=='card pay'){echo'selected';} ?>>By Card Pay</option>
				<option value="RTGS" <?php if($payment_method=='RTGS'){echo'selected';} ?>>By RTGS</option>
                <option value="DD" <?php if($payment_method=='DD'){echo'selected';} ?>>By DD</option>
				<option value="NEFT" <?php if($payment_method=='NEFT'){echo'selected';} ?>>By NEFT</option>
            </select></div>
      </div>
    </div>
	<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Total :</label>					
			<div class="col-sm-9"><input type="text" name="total" id="total" value="<?php echo $rate;?>" class="form-control" readonly></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Discount :</label>					
			<div class="col-sm-9"><input type="text" name="dis" id="discount" value="<?php echo $dis;?>" class=" form-control" onKeyPress="return checkIt(event)" onblur="checkTotal()" onkeypress="checkTotal()" placeholder="Discount"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Paid :</label>					
			<div class="col-sm-9"><input type="text" name="paid" id="paid" value="<?php echo $paid;?>" class="form-control" onblur="finalTotal()" onkeypress="finalTotal()"></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Balance :</label>					
			<div class="col-sm-9"><input type="text" name="bal" id="balance" value="<?php echo $bal;?>" class="form-control" readonly></div>
		</div>
	</div>
    <div class="form-group">		
      <div class="col-sm-offset-2 col-sm-5">
        <div class="city"></div>
      </div>
    </div>
	<div class="col-md-12 form-group">		
	  <div class="col-sm-offset-1 col-sm-11">
		<button type="submit" class="btn btn-primary">Submit</button>
        <a href="?vis=view_mem" class="btn btn-secondary">Cancel</a>
	  </div>
	</div>		
    </form>
<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>

<SCRIPT language=Javascript>
	function plan_Details(inputId)
	{
		if(inputId !="")
		{
		$.ajax({
			type: "POST",
			url: 'ajax_memplan.php',
			data: {mem_type:inputId},
			cache: false,
			dataType:'json',
			success: function(data) {
				if(data.status=="200"){	
					$("#total").val(0);	
					$("#total").val(data.content['rate']);
					$("#discount").val(0);
					$("#paid").val(data.content['rate']);
					$("#balance").val(0);
				}
			}
		});
		}else{
			$("#total").val(0);
			$("#discount").val(0);
			$("#paid").val(0);
			$("#balance").val(0);
		}
	}

function checkTotal()
{
	var total = parseInt($("#total").val() || 0);
	var discount = parseInt($("#discount").val() || 0);
	var paid = parseInt($("#paid").val() || 0);
	var balance = parseInt($("#balance").val() || 0);
	if(total >= discount){
		$("#paid").val(total - discount);
		$("#balance").val(0);
		$(':input[type="submit"]').prop('disabled', false);
	}else{
		$("#paid").val(0);
		$(':input[type="submit"]').prop('disabled', true);
		alert("Plan amount less than equal to Discount amount");
		}
}
function finalTotal()
{
	var total = parseInt($("#total").val() || 0);
	var discount = parseInt($("#discount").val() || 0);
	var paid = parseInt($("#paid").val() || 0);
	var balance = parseInt($("#balance").val() || 0);
	var finalTotal = total - discount;
	if(finalTotal >= paid){
		$("#balance").val(finalTotal - paid);
		$(':input[type="submit"]').prop('disabled', false);
	}else{
		$("#balance").val(0);
		$("#paid").val(finalTotal);
		$(':input[type="submit"]').prop('disabled', true);
		alert("Plan Total less than equal to Paid amount");
		}
}
</SCRIPT>