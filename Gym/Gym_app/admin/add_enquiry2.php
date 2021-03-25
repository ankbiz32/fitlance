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
<h3 align="center"><b>Enquiry Form</b></h3>
<form action="enquiry_submit.php" method="POST" class="form-horizontal form-groups-bordered">
    <div class="row">
      <hr/>
			<h4 class="hed">Personal Information :</h4>
			<hr/>
	  <?php
	  $sql = mysqli_query($con,"SELECT * FROM user_data ORDER BY id DESC LIMIT 1");
	  $print_data = mysqli_fetch_row($sql);
	  $rowid = $print_data[0] + 1;
	  //echo $rowid;
	  ?>			
        <input type="hidden" name="p_id" value="<?php echo $rowid; ?>" class="form-control" readonly/>
	 
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-9"><input type="text" name="p_name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Member Name" maxlength="30" required="required"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Mobile :</label>					
        <div class="col-sm-9"><input type="text" name="contact" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Mobile" onKeyPress="return checkIt(event)" maxlength="12" required="required"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Email Id :</label>					
        <div class="col-sm-9"><input type="text" name="email"  id="emailfield" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Gender :</label>					
        <div class="col-sm-9">
        <select name="sex" id="bbb" class="form-control" required>
            <option value="">-- Please select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
			<option value="Other">Other</option>
        </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Follow Up Date :</label>					
        <div class="col-sm-9"><?php echo "<select name='dayj'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='monthj'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yearj'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
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
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Comments :</label>					
        <div class="col-sm-9"><input type="text" name="comment" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Comment"></div>
      </div>
    </div>
	<hr />
    
    <div class="col-md-12 form-group">		
      <div class="col-sm-offset-1 col-sm-11">
			  <button type="submit" class="btn btn-primary pull-right"  name="follow_up" value="submit" style="margin-right: 5px;">Submit enquiry</button>
        
      </div>
    </div>
</form>
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