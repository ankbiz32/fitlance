
		<h2>Overview</h2>
		<hr />
			<form action="?vis=over_month" method="POST" class='form-horizontal form-bordered'>
				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">From :</label>					
						<div class="col-sm-5">
							<input type="text" name="from" id="textfield22"  class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
						</div>
				</div>


				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">To :</label>					
						<div class="col-sm-5">
							 <input type="text" name="to" id="textfield22" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
						</div>
				</div>
	 
				<div class="form-actions">
						<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
