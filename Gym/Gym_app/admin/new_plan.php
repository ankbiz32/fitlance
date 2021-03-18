  <h4>New Plan</h4>
  <hr />
  <form action="submit_plan_new.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
            <?php
              function getRandomWord($len = 8)
              {
                $word = array_merge(range('A', 'Z'));
                shuffle($word);
                return substr(implode($word), 0, $len);
              }
            ?>
            <input type="hidden" name="p_id" value="<?php echo getRandomWord(); ?>" class="form-control"  readonly/>
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Name :</label>					
          <div class="col-sm-5">
            <input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Plan Name" maxlength="100">
          </div>
      </div>
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Days :</label>					
          <div class="col-sm-5">
            <input type="text" name="days" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Validity In Days"  onKeyPress="return checkIt(event)" maxlength="3">
          </div>
      </div>
      
      <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Amount  :</label>					
          <div class="col-sm-5">
            <input type="text" name="rate"  class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Rate"  onKeyPress="return checkIt(event)" maxlength="10">
          </div>
      </div>
      
      <div class="form-group">		
        <div class="col-sm-offset-3 col-sm-5">
          <button type="submit" class="btn btn-primary">Save</button>	
        </div>
      </div>				
  </form>

