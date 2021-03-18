<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
		<h3>Edit Member Details</h3>

		<hr />

			<form action="edit_mem_submit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">

				<?php
	    
				    $query  = "select * from user_data WHERE newid='$memid'";
				    //echo $query;
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    
				    if (mysqli_affected_rows($con) == 1) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				            $pic_src = $row['pic_add'];
				            $name    = $row['name'];
				            $email   = $row['email'];
				            $address   	 = $row['address'];
				            $zipcode = $row['zipcode'];
				            $birthdate	 = $row['birthdate'];
				            $age     = $row['age'];
				            $date    = $row['joining'];
				            $address = $row['address'];
				            $contact = $row['contact'];
				            $height  = $row['height'];
				            $weight  = $row['weight'];
							$sex     = $row['sex'];
							$proof   = $row['proof'];
				            $nationality  = $row['nationality'];
				            $facebookaccount  = $row['facebookaccount'];
				            $twitteraccount  = $row['twitteraccount'];
				            $contactperson  = $row['contactperson'];
				            $previousgym  = $row['previousgym'];
				            $yearstraining  = $row['yearstraining'];

				        }
				    }


				?>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Membership ID :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_id" value="<?php echo $memid;?>" class="form-control" readonly/>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Photo :</label>					
						<div class="col-sm-5">
							<img src='<?php echo $pic_src; ?>'>
						</div>
				</div>			

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Name :</label>					
						<div class="col-sm-5">
							<input type="text" name="p_name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value ='<?php echo $name; ?>' placeholder="Member Name" maxlength="30">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Address :</label>					
						<div class="col-sm-5">
							<input type="text" name="add" id="textfield5" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $address; ?>'  placeholder="Address">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Zip Code :</label>					
						<div class="col-sm-5">
							<input type="text" name="zipcode" id="zipcode" class="form-control" data-rule-required="true" data-rule-minlength="4" value ='<?php echo $zipcode; ?>' placeholder="Zip Code" maxlength="30">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Birth Date :</label>					
						<div class="col-sm-5">
							<input type="text" name="birthdate" id="birthdate" class="form-control datepicker" value ='<?php echo $birthdate; ?>' data-format="yyyy-m-d">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Age :</label>					
						<div class="col-sm-5">
							<input type="text" name="age" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Age" value ='<?php echo $age; ?>'  onKeyPress="return checkIt(event)" maxlength="3">
						</div>
				</div>					

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Sex :</label>					
						<div class="col-sm-5">
						<select name="sex" class="form-control">
						    <option value="">-- Please select --</option>
						    <option value="Male" <?php if($sex=='Male'){echo'selected';} ?>>Male</option>
						    <option value="Female" <?php if($sex=='Female'){echo'selected';} ?>>Female</option>
						</select>
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Height :</label>					
						<div class="col-sm-5">
							<input type="text" name="height" id="textfield" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Height" onKeyPress="return checkIt(event)" value ='<?php echo $height; ?>' maxlength="3"> (In Feet)
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Weight :</label>					
						<div class="col-sm-5">
							<input type="text" name="weight" id="textfield" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Weight" onKeyPress="return checkIt(event)" value ='<?php echo $weight; ?>'  maxlength="3"> (In Kgs)
	    				</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Nationality :</label>					
						<div class="col-sm-5">
							<input type="text" name="nationality" id="nationality" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $nationality; ?>'  placeholder="Nationality">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Contact :</label>					
						<div class="col-sm-5">
							<input type="text" name="contact" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Mobile / Phone" value ='<?php echo $contact; ?>'  onKeyPress="return checkIt(event)" maxlength="10">
						</div>
				</div>										

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">E-Mail :</label>					
						<div class="col-sm-5">
							<input type="text" name="email"  id="emailfield" class="form-control" value ='<?php echo $email; ?>'  data-rule-minlength="5" placeholder="E-Mail" maxlength="60">
						</div>
				</div>

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Facebook Account :</label>					
						<div class="col-sm-5">
							<input type="text" name="facebookaccount" id="facebookaccount" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $facebookaccount; ?>'  placeholder="Facebook Account">
						</div>
				</div>						

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Twitter Account :</label>					
						<div class="col-sm-5">
							<input type="text" name="twitteraccount" id="twitteraccount" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $twitteraccount; ?>'  placeholder="Twitter Account">
						</div>
				</div>						


				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Contact Person :</label>					
						<div class="col-sm-5">
							<input type="text" name="contactperson" id="contactperson" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $contactperson; ?>'  placeholder="Contact Person">
						</div>
				</div>	

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Previous Gym :</label>					
						<div class="col-sm-5">
							<input type="text" name="previousgym" id="previousgym" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $previousgym; ?>'  placeholder="Previous Gym">
						</div>
				</div>					

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Years Training:</label>					
						<div class="col-sm-5">
							<input type="text" name="yearstraining" id="yearstraining" class="form-control" data-rule-required="true" data-rule-minlength="6" value ='<?php echo $yearstraining; ?>'  placeholder="Years Training">
						</div>
				</div>	

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Proof Given :</label>					
						<div class="col-sm-5">
						<select name="proof" class="form-control">
							    <option value="">-- Please select --</option>
							    <option value="GSIS Card" <?php if($proof=='GSIS Card'){echo'selected';} ?>>GSIS Card</option>
							    <option value="Voter Card" <?php if($proof=='Voter Card'){echo'selected';} ?>>Voter Card</option>
								<option value="Driving License" <?php if($proof=='Driving License'){echo'selected';} ?>>Driving License</option>
								<option value="Passport" <?php if($proof=='Passport'){echo'selected';} ?>>Passport</option>
								<option value="College/School ID" <?php if($proof=='College/School ID'){echo'selected';} ?>>College/School ID</option>
								<option value="Others" <?php if($proof=='Others'){echo'selected';} ?>>Others</option>
						</select>
						
						</div>
				</div>				

				<div class="form-group">
					<label for="field-1" class="col-sm-3 control-label">Join Date :</label>					
						<div class="col-sm-5">
							<input type="text" name="date" id="textfield22" class="form-control datepicker" value ='<?php echo $date; ?>' data-format="yyyy-m-d">
						</div>
				</div>	

				

			
	 
										
	
	                                    
				<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-primary">Save changes</button>	
						</div>
				</div>		

			

			</form>
<?php
} else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
?>