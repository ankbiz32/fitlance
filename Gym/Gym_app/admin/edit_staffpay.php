<?php 
if (isset($_POST['name'])) {
  $id  = $_POST['name'];
  $query1 = "select * from staff_pay WHERE id='$id'";
  //echo $query;
  $result1 = mysqli_query($con, $query1);
	if (mysqli_affected_rows($con) == 1) {
	  while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
		  $staff_id   = $row1['staff_id'];
		  $name   = $row1['name'];
		  $payment_method   = $row1['payment_method'];
		  $total   = $row1['total'];
		  $paid   = $row1['paid'];
		  $pay_date   = $row1['paid_date'];
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
  <h4>Edit Staff Payment:</h4>
  <hr />
  <form action="update_paymentstaff.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
    <div class="form-group">
      <label for="field-1" class="col-sm-3 control-label">Staff ID :</label>					
        <div class="col-sm-5">
          <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"  readonly/>
          <input type="text" name="staff_id" value="<?php echo $staff_id; ?>" class="form-control"  readonly/>
        </div>
    </div>
    <div class="form-group">
      <label for="field-1" class="col-sm-3 control-label">Name :</label>					
        <div class="col-sm-5">
          <input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value="<?php echo $name; ?>" placeholder="Staff Name" maxlength="30" readonly/>
        </div>
    </div>
	
	<div class="form-group">   
      <label for="field-1" class="col-sm-3 control-label">Total Salary : </label>
        <div class="col-sm-5">
          <input name="total" id="textfield" class="form-control" data-rule-required="true" data-rule-minlength="4" value="<?=$total?>" required="required" maxlength="10">
        </div>
    </div>
    <div class="form-group">
      <label for="field-1" class="col-sm-3 control-label">Pay Salary : </label>
        <div class="col-sm-5">
          <input name="paid" id="textfield" class="form-control" data-rule-required="true" data-rule-minlength="4" value="<?=$paid?>" maxlength="10" required="required">
        </div>
    </div>
    <div class="form-group">
      <label for="field-1" class="col-sm-3 control-label">Date :</label>					
        <div class="col-sm-5"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
        </div>
    </div>
	
    <div class="form-group">		
      <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class="btn btn-primary">Update </button>	
		<button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
      </div>
    </div>	
  </form>
  
<?php
} else {
 echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_staff'>";
}
?>