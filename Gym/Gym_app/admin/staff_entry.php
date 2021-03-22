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
  <form action="staff_submit.php" method="POST" class="form-horizontal form-groups-bordered">
    <div class="row">
      <h4 class="hed">Personal Information :</h4>
      <hr/>
			<?php
			$sql = mysqli_query($con,"SELECT * FROM staff_data ORDER BY id DESC LIMIT 1");
			$print_data = mysqli_fetch_row($sql);
			$rowid = $print_data[0] + 1;
			//echo $rowid;
			?>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Staff ID :</label>					
        <div class="col-sm-9"><input type="text" name="staffid" value="<?php echo $rowid; ?>" class="form-control" readonly/></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
        <div class="col-sm-9"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
        </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-9"><input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Staff Name" maxlength="30" required="required"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Email Id :</label>					
        <div class="col-sm-9"><input type="text" name="email"  id="emailfield" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" required="required"></div>
      </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Address :</label>					
        <div class="col-sm-9"><input type="text" name="address" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Address"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Contact No. :</label>					
        <div class="col-sm-9"><input type="text" name="mobile" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Mobile / Phone" onKeyPress="return checkIt(event)" maxlength="12"></div>
      </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Age :</label>			
        <div class="col-sm-9"><input type="text" name="age" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Age" onKeyPress="return checkIt(event)" maxlength="3"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Gender :</label>					
        <div class="col-sm-9"><select name="gender" id="bbb" data-rule-required="true" class="form-control" required="required">
            <option value="">-- Please select --</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
			      <option value="Other" >Other</option>
          </select>
        </div>
      </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Designation :</label>					
        <div class="col-sm-7"><select name="designation" id="newdeg" data-rule-required="true" class="form-control" required="required">
                              <option value="">-- Please select --</option>
															<?php
															$query = "select * from designation";
															$result = mysqli_query($con, $query);
															if (mysqli_affected_rows($con) != 0) {
																while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
																	echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
																}
															}
															?>
                              </select></div>
		    <div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Bank" id="newpost"><i class="entypo-plus"></i>Add</a></div>
      </div>
    </div>
	  <div class="row" id="insertpost" style="display:none;">
	    <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Insert Designation:</label>				
        <div class="col-sm-7"><input type="text" name="newdegval"  class="form-control"  placeholder="Designation" id="newdegval" data-rule-required="true"></div>
		    <div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="post_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	  </div>
	  <div class="row">
      <h4 class="hed">Bank Details</h4>
      <hr/>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Bank Name :</label>					
        <div class="col-sm-7"><select name="bank_name" id="bank" data-rule-required="true" class="form-control">
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
		    <div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Bank" id="newbank"><i class="entypo-plus"></i>Add</a></div>
      </div>
	    <div class="col-md-6 form-group" id="insertbank" style="display:none;"><label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
        <div class="col-sm-7"><input type="text" name="bank_name"  class="form-control"  placeholder="Bank Name" id="bankname" data-rule-required="true"></div>
		    <div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="bank_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	 
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Branch Name :</label>					
        <div class="col-sm-9"><input type="text" name="branch_name"  id="textfield5" class="form-control" data-rule-minlength="5" placeholder="Branch Name" maxlength="60"></div>
      </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Account No. :</label>					
        <div class="col-sm-9"><input type="text" name="bank_acc" id="textfield6" class="form-control" placeholder="Account No." ></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">IFSC Code :</label>					
        <div class="col-sm-9"><input type="text" name="ifsc_code"  id="textfield5" class="form-control" data-rule-minlength="5" placeholder="IFSC Code" maxlength="60"></div>
      </div>
    </div>
	  <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">MICR Code :</label>					
        <div class="col-sm-9"><input type="text" name="micr_code" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="MICR Code" maxlength="30"></div>
      </div>
    </div>
	  <div class="col-md-12 form-group">		
      <div class="col-sm-offset-1 col-sm-11">
        <button type="submit" class="btn btn-primary">Submit</button>
			<button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
      </div>
    </div>
  </form>
  <script type="text/javascript">
		$(document).ready(function()
		{
		$("#newpost").click(function()
		{
		$("#insertpost").show();   
		});
		$("#newbank").click(function()
		{
		$("#insertbank").show();   
		});
		});
		function post_save()
		{
			var newdef = $('#newdegval').val();
			var dataString = 'name='+ newdef; 
				$.ajax
				({    
				type: "GET",
				url: "ajax_designation.php",
				data: dataString,
				cache: false,
				success: function(html)
				{ 
				$('#newdeg').empty();                 
				$("#newdeg").append(html); 
				$("#insertpost").hide(); 
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