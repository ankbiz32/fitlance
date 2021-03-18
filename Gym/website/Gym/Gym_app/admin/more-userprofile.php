		<h3>Edit user profile</h3>
		(You will be required to Login Again After Profile Update)
		<hr />
		<?php $user_id_auth = $_SESSION['user_data']; ?>
		<form action="submit_changed_details.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Id</label>					
                <div class="col-sm-5">
                    <input type="text" name="login_id" value="<?php echo $_SESSION['user_data']; ?>" class="form-control"  readonly/>
                </div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Full Name</label>					
                <div class="col-sm-5">
                    <input class="form-control" type="text" name="full_name" id="textfield2"  data-rule-required="true" data-rule-minlength="3" value="<?php echo $_SESSION['full_name']; ?>" maxlength="25">
                </div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Sex</label>					
                <div class="col-sm-5">
                    <input type="text" name="sex"  data-rule-required="true" data-rule-minlength="3" value="<?php echo $_SESSION['sex']; ?>" class="form-control"  readonly>
                </div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Password</label>					
                <div class="col-sm-5">
                    <p><span class="form-control">*********</span> <a href="?vis=change_pwd" class="btn">Change password</a> <span class="help-block">*For security reasons hidden</span></p>
                </div>
			</div>									
			<div class="form-group">		
                <div class="col-sm-offset-3 col-sm-5">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <button type="button" class="btn">Cancel</button>
                </div>
			</div>
		</form>
   