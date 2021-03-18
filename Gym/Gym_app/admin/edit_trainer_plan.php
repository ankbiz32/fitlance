<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
<h3>Edit Plan Details</h3>
<hr />
	<?php
        $query  = "select * from trainer_types WHERE staff_type_id='$memid'";
        $result = mysqli_query($con, $query);
        $sno    = 1;
        if (mysqli_affected_rows($con) == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name    = $row['name'];
                $day    = $row['day'];
                $time    = $row['time'];
            }
        }
    ?>
  <form action="submit_edit_plan_trainer.php" method="POST" role="form" class="form-horizontal form-groups-bordered">
  <input type="hidden" name="staff_type_id" value="<?php echo $memid; ?>" readonly/>
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Plan :</label>					
          <div class="col-sm-5">
            <input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Plan Name" maxlength="100" required="required" value="<?php echo $name;?>">
          </div>
      </div>
    
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Days :</label>					
          <div class="col-sm-5">
            <input type="text" name="day"  id="emailfield" class="form-control"  data-rule-minlength="5" placeholder="Days" maxlength="999" required="required" value="<?php echo $day;?>">
          </div>
      </div>
      
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Session Slots :</label>					
          <div class="col-sm-5">
            <input type="text" name="time" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Time" required="required" maxlength="20" value="<?php echo $time;?>">
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
    echo "<meta http-equiv='refresh' content='0; url=?vis=view_tranier_plan'>";
}
?>

