<?php
if (isset($_POST['name'])) {
    $staffid = $_POST['name'];
?>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
    <h4>Edit Staff Registration</h4>
    <hr />
  <form action="edit_staff_submit.php" method="POST" class="form-horizontal form-groups-bordered">
    <?php
    $query  = "select * from staff_data WHERE staffid='$staffid'";
    //echo $query;
    $result = mysqli_query($con, $query);
    $sno    = 1;
      if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $full_name = $row['name'];
			$email     = $row['email'];
			$address   = $row['address'];
			$mobile    = $row['mobile'];
			$age       = $row['age'];
			$gender    = $row['gender'];
			$designation   = $row['designation'];
			$salary    = $row['salary'];
			$bank_name = $row['bank_name'];
			$branch_name  = $row['branch_name'];
			$bank_acc  = $row['bank_acc'];
			$ifsc_code = $row['ifsc_code'];
			$micr_code = $row['micr_code'];
			$date      = $row['date'];
			$date1 = date('d',strtotime( $row['date'] ));
			$month1 = date('m',strtotime( $row['date'] ));
			$year1 = date('Y',strtotime( $row['date'] ));
        }
      }
    ?>
 <style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<form action="edit_staff_submit.php" method="POST" class="form-horizontal form-groups-bordered">
    <div class="row">
     <h4 class="hed">Personal Information :</h4>
      <hr/>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Staff ID :</label>					
        <div class="col-sm-9"><input type="text" name="staffid" value="<?php echo $staffid; ?>" class="form-control" readonly/></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
        <div class="col-sm-9"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $date1){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($num==$month1){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$year1){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
      </div>
    </div>
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-9"><input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Staff Name" maxlength="30" required="required" value="<?php echo $full_name; ?>"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Email Id :</label>					
        <div class="col-sm-9"><input type="text" name="email"  id="emailfield" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" value="<?php echo $email; ?>"></div>
      </div>
    </div>
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Address :</label>					
        <div class="col-sm-9"><input type="text" name="address" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Address" value="<?php echo $address; ?>"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Contact No. :</label>					
        <div class="col-sm-9"><input type="text" name="mobile" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="12" placeholder="Mobile / Phone" required="required" onKeyPress="return checkIt(event)" maxlength="12" value="<?php echo $mobile; ?>"></div>
      </div>
    </div>
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Age :</label>			
        <div class="col-sm-9"><input type="text" name="age" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Age" onKeyPress="return checkIt(event)" maxlength="3" value="<?php echo $age; ?>"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Gender :</label>					
        <div class="col-sm-9"><select name="gender" id="bbb" data-rule-required="true" class="form-control" required="required">
            <option value="">-- Please select --</option>
            <option value="Male" <?php if($gender=='Male'){echo 'selected';}?>>Male</option>
            <option value="Female" <?php if($gender=='Female'){echo 'selected';}?>>Female</option>
			<option value="Other" <?php if($gender=='Other'){echo 'selected';}?>>Other</option>
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
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					<option value="<?php echo $row['id'];?>" <?php if($designation==$row['id']){echo 'selected';}?>><?php echo $row['name'];?></option>
				<?php  }
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
				  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
					  <option value="<?php echo $row['id'];?>" <?php if($bank_name==$row['id']){echo 'selected';}?>><?php echo $row['bank_name'];?></option>
				 <?php }
				}
				?>
            </select>
        </div>	
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-success" title="Add New Bank" id="newbank"><i class="entypo-plus"></i>Add</a></div>
      </div>
	<div class="col-md-6 form-group" id="insertbank" style="display:none;"><label for="field-1" class="col-sm-3 control-label">Insert Bank Name :</label>				
        <div class="col-sm-7"><input type="text" name="bank_val"  class="form-control"  placeholder="Bank Name" id="bankname" data-rule-required="true"></div>
		<div class="col-sm-2"><a href="javascript:void(0)" class="btn btn-sm btn-info" title="Add New Bank Name" onclick="bank_save()"><i class="entypo-right"></i>Save</a></div>
      </div>
	 
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Branch Name :</label>					
        <div class="col-sm-9"><input type="text" name="branch_name"  id="textfield5" class="form-control" data-rule-minlength="5" placeholder="Branch Name" maxlength="60" value="<?php echo $branch_name; ?>"></div>
      </div>
    </div>
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Account No. :</label>					
        <div class="col-sm-9"><input type="text" name="bank_acc" id="textfield6" class="form-control" placeholder="Account No." value="<?php echo $bank_acc; ?>"></div>
      </div>
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">IFSC Code :</label>					
        <div class="col-sm-9"><input type="text" name="ifsc_code"  id="textfield5" class="form-control" data-rule-minlength="5" placeholder="IFSC Code" maxlength="60" value="<?php echo $ifsc_code; ?>"></div>
      </div>
    </div>
	<div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">MICR Code :</label>					
        <div class="col-sm-9"><input type="text" name="micr_code" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="MICR Code" maxlength="30" value="<?php echo $micr_code; ?>"></div>
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
<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
}
?>

<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>