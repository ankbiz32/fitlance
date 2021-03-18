		<h2>New Plan Details</h2>
		<hr />
		<form action="submit_plan_new.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Plan ID :</label>					
					<div class="col-sm-5">
						<?php
							function getRandomWord($len = 8)
							{
							    $word = array_merge(range('A', 'Z'));
							    shuffle($word);
							    return substr(implode($word), 0, $len);
							}

						?>
						<input type="text" name="p_id" value="<?php echo getRandomWord(); ?>" class="form-control"  readonly/>
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Name :</label>					
					<div class="col-sm-5">
						<input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" placeholder="Plan Name" maxlength="100">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Details :</label>					
					<div class="col-sm-5">
						<input type="text" name="details"  id="emailfield" class="form-control"  data-rule-minlength="5" placeholder="Details" maxlength="999">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Days :</label>					
					<div class="col-sm-5">
						<input type="text" name="days" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Validity In Days"  onKeyPress="return checkIt(event)" maxlength="3">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Rate :</label>					
					<div class="col-sm-5">
						<input type="text" name="rate" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Mobile / Phone"  placeholder="Rate"  onKeyPress="return checkIt(event)" maxlength="10">
					</div>
			</div>

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Save changes</button>	
					</div>
			</div>				
</form>
			
