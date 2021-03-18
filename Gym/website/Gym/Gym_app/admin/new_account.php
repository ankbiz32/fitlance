<h3>Add New User</h3>
<hr />
<form action="new_account_submit.php" method="POST" role="form" class="form-horizontal form-groups-bordered">
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Role Login</label>					
        <div class="col-sm-5">
           <select name="level" class="form-control">
           <option value="1">Administrator</option>
           <option value="2">Cashier</option>
           <option value="3">Trainer</option>
           <option value="4">Other</option>
           </select>
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Full Name</label>					
        <div class="col-sm-5">
            <input class="form-control" type="text" name="full_name" id="textfield2"  data-rule-required="true" data-rule-minlength="3"  maxlength="25">
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Sex</label>					
        <div class="col-sm-5">
            <input type="radio" name="sex"  data-rule-required="true" data-rule-minlength="3" value="male"/> Male
            <input type="radio" name="sex"  data-rule-required="true" data-rule-minlength="3" value="female"/> Female
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Username</label>					
        <div class="col-sm-5">
            <input type="text" name="login_id"  class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Password</label>					
        <div class="col-sm-5">
          <input type="text" name="password"  class="form-control" />
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Confirm Password</label>					
        <div class="col-sm-5">
          <input type="text" name="confirm"  class="form-control" />
        </div>
    </div>	
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Secert Key</label>					
        <div class="col-sm-5">
            <input type="text" name="security"  class="form-control" />
        </div>
    </div>								
    <div class="form-group">		
        <div class="col-sm-offset-3 col-sm-5">
            <input type="submit" class="btn btn-primary" value="Submit">
            <button type="button" class="btn">Cancel</button>
        </div>
    </div>
</form>
   