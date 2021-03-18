<h3>Change Password</h3>
<hr />
<form action="change_s_pwd.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Id :</label>					
        <div class="col-sm-5">
            <input type="text" name="login_id" value="<?php echo $_SESSION['user_data']; ?>" class="form-control" readonly/>
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Secert Key :	</label>					
        <div class="col-sm-5">
            <input type="text" name="login_key"  class="form-control"  data-rule-required="true" placeholder="Your secert key">
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Password :</label>					
        <div class="col-sm-5">
            <input type="text" name="pwfield" id="pwfield" class="form-control"  data-rule-required="true" data-rule-minlength="6" placeholder="Your new passowrd">
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Confirm password :</label>					
        <div class="col-sm-5">
            <input type="text" name="confirmfield" id="confirmfield" class="form-control"  data-rule-equalto="#pwfield" data-rule-required="true" data-rule-minlength="6" placeholder="Confirm Your new passowrd">
        </div>
    </div>
    <div class="form-group">		
      <div class="col-sm-offset-3 col-sm-5">
          <input type="submit" class="btn btn-primary" value="Submit">
          <button type="button" class="btn">Cancel</button>
      </div>
    </div>	
</form>
