<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<form action="attaindance_submit.php" method="POST" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
	<div class="row">
	<h4 class="hed">Company Information :</h4>
	<hr/>
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Company Name :</label>					
			<div class="col-sm-6"><input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Member Name" maxlength="30" required="required"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label"> Address : </label>					
			<div class="col-sm-6"><input type="text" name="address"  id="facebookaccount" class="form-control" data-rule-minlength="5" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label"> Mobile :</label>					
			<div class="col-sm-6"><input type="text" name="mobile" class="form-control" placeholder="Mobile" onKeyPress="return checkIt(event)" maxlength="12" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Email : </label>					
			<div class="col-sm-6"><input type="text" name="email"  id="emailfield" class="form-control" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Website : </label>					
			<div class="col-sm-6"><input type="text" name="website" id="emailfield" class="form-control" data-rule-minlength="5" placeholder="Website" maxlength="60" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Image:</label>				
			<div class="col-sm-6"><input type="file" name="image" id="fileToUpload" required="required" /></div>
		</div>
	</div>
	<div class="col-md-12 form-group">		
		<div class="col-sm-offset-1 col-sm-11">
			<button type="submit" class="btn btn-primary">Submit</button>
			    <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
		</div>
	</div>
</form>

