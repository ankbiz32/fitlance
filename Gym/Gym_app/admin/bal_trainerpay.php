<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<?php
if (isset($_POST['name'])) {
  $invoice = $_POST['name'];
?>
    <h4 class="hed">Personal Trainer Payment</h4>
    <hr />
    <form action="bal_trainerpay_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
	  <?php
		$query  = "select * from trainer_pay WHERE invoice='$invoice'";
		$result = mysqli_query($con, $query);
		$sno    = 1;
		
		if (mysqli_affected_rows($con) == 1) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$member_name = $row['member_name'];
			$staff_name  = $row['staff_name'];
			$total = $row['total'];
			$paid  = $row['paid'];
		  }
		}
      ?>
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Member Name :</label>					
          <div class="col-sm-5">
            <input type="text" name="name" value="<?php echo $member_name; ?>" class="form-control" readonly/>
          </div>
      </div>
	  
	  <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Trainer Name :</label>					
          <div class="col-sm-5">
            <input type="text" name="name" value="<?php echo $staff_name; ?>" class="form-control" readonly/>
          </div>
      </div>

      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Invoice :</label>					
          <div class="col-sm-5">
            <input type="text" name="invoice" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value ='<?php echo $invoice; ?>' placeholder="Plan Name" maxlength="100"class="uneditable-input"  readonly/>
          </div>
      </div>
      
      <div class="form-group">
      <label for="field-1" class="col-sm-3 control-label">Total :</label>					
      <div class="col-sm-5">
      <input type="text" name="total" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Days" value ='<?php echo $total; ?>'  onKeyPress="return checkIt(event)" maxlength="9" readonly="readonly">
      </div>
      </div>
      
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Paid :</label>					
          <div class="col-sm-5">
            <input type="text" name="lastamount" id="textfield6" class="form-control"  value ='<?php echo $paid; ?>'  readonly="readonly">
          </div>
      </div>
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Balance Amount :</label>					
          <div class="col-sm-5">
            <input type="text" name="paid" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="10" value ='<?php echo $total-$paid; ?>'  onKeyPress="return checkIt(event)" maxlength="10">
          </div>
      </div>
	  <div class="form-group">
			<label for="field-1" class="col-sm-3 control-label">Payment Date :</label>					
				<div class="col-sm-5">
					<input type="text" name="curr_date" id="textfield22" class="form-control datepicker" data-format="dd-mm-yyyy" required="required" value="<?php echo $curr_date; ?>">
				</div>
		</div>
		<div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">Payment Method :</label>				
			<div class="col-sm-3"><select name="payment_method" id="paymentdata" data-rule-required="true" class="form-control" >
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
				<input type="text" name="cheque_no"  class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Cheque Number" maxlength="100" id="chequeno">
			  </div>
		</div>
		</div>
		<div class="form-group">		
			<div class="col-sm-offset-3 col-sm-5">
				<div class="city"></div>
			</div>
		</div>
		<div class="form-group"><label for="field-1" class="col-sm-3 control-label">Bank Name :</label>					
        <div class="col-sm-5"><select name="bank_id" id="bank" data-rule-required="true" class="form-control">
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
		<div class="form-group" id="insertbank" style="display:none;">
		<label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
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
<?php
} else {
echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid'>";
}
?>
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

