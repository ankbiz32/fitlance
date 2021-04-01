<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {cursor: not-allowed;background-color: #efefef;
}
</style>
<?php
  function getRandomWord($len = 8)
  {
	$word = array_merge(range('A', 'Z'));
	shuffle($word);
	return substr(implode($word), 0, $len);
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
<form action="new_submit.php" method="POST" class="form-horizontal form-groups-bordered">
    <div class="row">
     <h4 class="hed">Personal Information :</h4>
      <hr/>
	  <?php
	  $sql = mysqli_query($con,"SELECT * FROM user_data ORDER BY id DESC LIMIT 1");
	  $print_data = mysqli_fetch_row($sql);
	  $rowid = $print_data[0] + 1;
	  //echo $rowid;
	  ?>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
        <div class="col-sm-9"><input type="text" name="p_id" value="<?php echo $rowid; ?>" class="form-control" readonly/>
		</div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-9"><input type="text" name="p_name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Member Name" maxlength="30" required="required"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Email Id :</label>					
        <div class="col-sm-9"><input type="text" name="email"  id="emailfield" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60"></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Birthdate :</label>			
        <div class="col-sm-9"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
		</div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Mobile :</label>					
        <div class="col-sm-9"><input type="text" name="contact" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Mobile" onKeyPress="return checkIt(event)" maxlength="12" required="required"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Landline No. :</label>					
        <div class="col-sm-9"><input type="text" name="landline" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Landline No." onKeyPress="return checkIt(event)" maxlength="12"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
        <div class="col-sm-9"><?php echo "<select name='dayj'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='monthj'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yearj'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Gender :</label>					
        <div class="col-sm-9"><select name="sex" id="bbb" class="form-control">
            <option value="">-- Please select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
			<option value="Other">Other</option>
        </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Address :</label>					
        <div class="col-sm-9"><input type="text" name="add" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Address"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Pin Code :</label>					
        <div class="col-sm-9"><input type="text" name="zipcode" id="zipcode" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Pincode" onKeyPress="return checkIt(event)" maxlength="6"></div>
      </div>
    </div>
	<hr />
    <div class="row">
	  <h4 class="hed">Payment & Plan Information : </h4>
      <hr/>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Preferred Workout :</label>				
        <div class="col-sm-7"><select name="workout_time" id="workoutdata" data-rule-required="true" class="form-control" >
            <option value="">-- Please select --</option>
            <?php
				$query = "select * from workout_time";
				//echo $query;
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					  echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
				  }
				}
			?>
			</select></div>
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Workout Time" id="newworkout"><i class="entypo-plus"></i>Add</a></div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Activity :</label>					
        <div class="col-sm-9"><input type="text" name="activity" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Activity"></div>
      </div>
    </div>
	<div class="row" id="insertworkout" style="display:none;">
	<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Insert Workout :</label>				
        <div class="col-sm-7"><input type="text" name="workout_name"  class="form-control"  placeholder="Workout Name" id="workout_name" data-rule-required="true"></div>
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Workout Time" onclick="workout_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	</div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership Type :</label>					
        <div class="col-sm-7"><select name="mem_type" id="plan" onchange="plan_Details(this.value)"  data-rule-required="true" required='required' class="form-control">
				<option value="">-- Please select --</option>
				<?php
					$query = "select * from mem_types where branch_id = '$_SESSION[branch_id]'";
					$result = mysqli_query($con, $query);
					if (mysqli_affected_rows($con) != 0) {
					  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						  echo "<option value=" . $row['mem_type_id'] . ">" . $row['name'] . "</option>";
					  }
					}
				?>
            </select>
        </div>	
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Membership Type" id="newplan"><i class="entypo-plus"></i>Add</a></div>				
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
        <div class="col-sm-9"><select name="paymentdata" id="paymentdata" class="form-control">
            <option value="">-- Please select --</option>
            <option value="cash">By Cash</option>
			<option value="cheque">By Cheque</option>
			<option value="card pay">By Card Pay</option>
			<option value="RTGS">By RTGS</option>
			<option value="DD">By DD</option>
			<option value="NEFT">By NEFT</option>
        </select></div>
      </div>
    </div>
	<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Total :</label>					
			<div class="col-sm-9"><input type="text" name="total" id="total" value="<?php echo $rate;?>" class="form-control" readonly></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Discount :</label>					
			<div class="col-sm-9"><input type="text" required name="dis" id="discount" value="<?php echo $dis;?>" class=" form-control" onKeyPress="return checkIt(event)" onblur="checkTotal()" onkeypress="checkTotal()" required placeholder="Discount"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Paid :</label>					
			<div class="col-sm-9"><input type="text" name="paid" id="paid" required value="<?php echo $paid;?>" class="form-control" onblur="finalTotal()" onkeypress="finalTotal()" required></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Balance :</label>					
			<div class="col-sm-9"><input type="text" required name="bal" id="balance" value="<?php echo $bal;?>" class="form-control" readonly></div>
		</div>
	</div>
	<div class="row" id="insertpayment" style="display:none" >
	<div class="col-md-6 form-group">
        <label for="field-1" class="col-sm-3 control-label">Cheque Number :</label>					
          <div class="col-sm-9">
            <input type="text" name="chequeno" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
          </div>
      </div>
	  <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Bank Name :</label>					
        <div class="col-sm-7"><select name="bank" id="bank" data-rule-required="true" class="form-control">
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
	</div>
	<div class="row" id="insertbank" style="display:none;">
	<div class="col-md-6">&nbsp;</div>
	<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
        <div class="col-sm-7"><input type="text" name="bank_name"  class="form-control"  placeholder="Bank Name" id="bankname" data-rule-required="true"></div>
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="bank_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	</div>
	<div class="row" id="insertplan" style="display:none;">
	<input type="hidden" name="plan_id" value="<?php echo getRandomWord(); ?>" class="form-control" id="planid" />
	<div class="form-group">
        <label for="field-1" class="col-sm-1 control-label">Name :</label>					
          <div class="col-sm-4">
            <input type="text" name="planname"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Plan Name" maxlength="100" id="planname">
          </div>
      </div>
	  <div class="form-group">
        <label for="field-1" class="col-sm-1 control-label">Days :</label>					
          <div class="col-sm-4">
            <input type="text" name="plandays"  class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Validity In Days"  onKeyPress="return checkIt(event)" maxlength="3" id="plandays">
          </div>
      </div>
	  <div class="form-group">
        <label for="field-1" class="col-sm-1 control-label">Rate :</label>					
          <div class="col-sm-4">
            <input type="text" name="planrate"  class="form-control" data-rule-required="true" data-rule-minlength="10"  placeholder="Rate"  onKeyPress="return checkIt(event)" maxlength="10" id="planrate">
          </div>
		  <div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Workout Time" onclick="plan_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	</div>
    <hr />
	
	<div class="col-md-12 form-group">		
		<fieldset class="question">
			<h4 class="hed"><input class="coupon_question" type="checkbox" name="coupon_question" value="1" /> Personal Trainer Assign</h4>
		</fieldset>
		<hr />

		<fieldset class="answer">
		<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Personal Trainer Name :</label>					
			<div class="col-sm-9"><select name="trainer_name" class="form-control chosen-select-trainer">
				<option value="">-- Please select --</option>						
				<?php
				$query  = "select * from staff_data where branch_id = '$_SESSION[branch_id]'";
				//echo $query;
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
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Session Slot :</label>					
			<div class="col-sm-9"><select name="trainer_type_id" id="trainer_type_id" data-rule-required="true" class="country form-control">
				<option value="">-- Please select --</option>
				<?php
				$query = "select * from trainer_types where branch_id = '$_SESSION[branch_id]'";
				//echo $query;
				$result = mysqli_query($con, $query);
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo "<option value=" . $row['staff_type_id'] . ">" . $row['time'] . "</option>";
					}
				}
				?>
				</select>
			</div>
		</div>
	    </div>
		<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
			<div class="col-sm-9"><?php echo "<select name='dayt'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='montht'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yeart'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Payment Method :</label>					
			<div class="col-sm-9"><select name="payment_methodt" id="paymentdata" data-rule-required="true" class="form-control" >
				<option value="">-- Please select --</option>
				<option value="cash">By Cash</option>
				<option value="cheque">By Cheque</option>
				<option value="card pay">By Card Pay</option>
				<option value="RTGS">By RTGS</option>
				<option value="DD">By DD</option>
				<option value="NEFT">By NEFT</option>
				</select>
			</div>
		</div>
	    </div>
		<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Total Amount :</label>					
			<div class="col-sm-9"><input type="text" name="totalt" id="total" class="form-control" placeholder="Total Amount"></div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Paid Amount:</label>					
			<div class="col-sm-9"><input type="text" name="paidt" id="paid" class="form-control" placeholder="Paid Amount"></div>
		</div>
	    </div>
		<div class="row">
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Cheque Number :</label>					
			<div class="col-sm-9"><input type="text" name="cheque_not"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
        </div>
		</div>
		<div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Bank Name :</label>					
			<div class="col-sm-9"><select name="bank_idt" id="bank" data-rule-required="true" class="form-control">
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
            </select></div>
		</div>
	    </div>
		</fieldset>
    </div>

    <div class="col-md-12 form-group">		
      <div class="col-sm-offset-1 col-sm-11 pull-right">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="?vis=view_mem" class="btn btn-secondary">Cancel</a>
      </div>
    </div>
</form>

<script type="text/javascript">
$(".answer").hide();
$(".coupon_question").click(function() {
    if($(this).is(":checked")) {
        $(".answer").show();
    } else {
        $(".answer").hide();
    }
});
</script>
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
