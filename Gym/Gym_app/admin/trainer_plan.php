  <h3>Trainer Plan Details :</h3>
  <hr />
	<?php
		function getRandomWord($len = 8)
		{
		$word = array_merge(range('A', 'Z'));
		shuffle($word);
		return substr(implode($word), 0, $len);
		}
	?>
	
  <form action="submit_plan_trainer.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
      <input type="hidden" name="staff_type_id" value="<?php echo getRandomWord(); ?>" readonly/>
    
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Plan :</label>					
          <div class="col-sm-5">
            <input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Plan Name" maxlength="100" required="required">
          </div>
      </div>
    
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Days :</label>					
          <div class="col-sm-5">
            <input type="text" name="day"  id="emailfield" class="form-control"  data-rule-minlength="5" placeholder="Days" maxlength="999" required="required">
          </div>
      </div>
      
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Session Slots :</label>					
          <div class="col-sm-5">
            <input type="text" name="time" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Time"  maxlength="20" required="required">
          </div>
      </div>
      
      <div class="form-group">		
        <div class="col-sm-offset-3 col-sm-5">
          <button type="submit" class="btn btn-primary">Save</button>	
        </div>
      </div>				
  </form>

