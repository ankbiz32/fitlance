<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
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
<h4 class="hed">Edit Follow Up </h4>
<hr />
  <form action="edit_follow_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
	<?php
	$query  = "select * from follow WHERE id='$memid'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
	if (mysqli_affected_rows($con) == 1) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$joindate = $row['joining'];
					$full_name = $row['name'];
					$email = rtrim($row['email']);
					$address = rtrim($row['address']);
					$zipcode = rtrim($row['zipcode']);    
					$birthdate = $row['birthdate'];
					$contact = rtrim($row['contact']);
					$sex = rtrim($row['sex']);
					$curr_date = $row['curr_date'];
					$landline = rtrim($row['landline']);
					$comment = rtrim($row['comment']);
					$date1 = date('d-m-Y',strtotime( $row['curr_date'] ));
					$date2 = date('d',strtotime( $row['joining'] ));
					$month2 = date('m',strtotime( $row['joining'] ));
					$year2 = date('Y',strtotime( $row['joining'] ));
					$date3 = date('d',strtotime( $row['birthdate'] ));
					$month3 = date('m',strtotime( $row['birthdate'] ));
					$year3 = date('Y',strtotime( $row['birthdate'] ));
		  }
	}
	?>
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
        <div class="col-sm-9"><input type="text" name="id" value="<?php echo $memid; ?>" class="form-control" readonly/></div>
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
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Follow Up Date :</label>					
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
    <div class="row">
      <div class="col-md-6 form-group"><label for="field-1" class="col-sm-3 control-label">Comment :</label>					
        <div class="col-sm-9"><input type="text" name="comment" id="textfield5" class="form-control"  value="<?php echo $comment;?>" data-rule-required="true" data-rule-minlength="6" placeholder="Comment"></div>
      </div>
    </div>
	<hr />
	<div class="col-md-12 form-group">		
	  <div class="col-sm-offset-1 col-sm-11">
		<button type="submit" class="btn btn-primary pull-right">Submit</button>
	  </div>
	</div>		
    </form>
<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>
