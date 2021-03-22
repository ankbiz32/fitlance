<?php
if (isset($_POST['name'])) {
    $id = $_POST['name'];
?>
<h3>Edit Company Profile</h3>
<hr />
<form action="update_companyprofile.php" method="POST" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">

	<?php
        $query  = "select * from card WHERE id='$id'";
        // echo $query;
        $result = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name    = $row['name'];
                $address = $row['address'];
                $mobile  = $row['mobile'];
				$email   = $row['email'];
                $website = $row['website'];
				$img_location = $row['img_location'];
            }
        }
    ?>
	<input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" readonly/>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Company Name :</label>					
			<div class="col-sm-6"><input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" value="<?php echo $name; ?>" data-rule-minlength="4" placeholder="Member Name" maxlength="30" required="required"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label"> Address : </label>					
			<div class="col-sm-6"><input type="text" name="address"  id="facebookaccount" class="form-control" value="<?php echo $address; ?>" data-rule-minlength="5" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label"> Mobile :</label>					
			<div class="col-sm-6"><input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo $mobile; ?>" onKeyPress="return checkIt(event)" maxlength="12" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Email : </label>					
			<div class="col-sm-6"><input type="text" name="email"  id="emailfield" class="form-control" value="<?php echo $email; ?>" data-rule-minlength="5" placeholder="E-Mail" maxlength="60" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Website : </label>					
			<div class="col-sm-6"><input type="text" name="website" id="emailfield" class="form-control" value="<?php echo $website; ?>" data-rule-minlength="5" placeholder="Website" maxlength="60" required="required" /></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 form-group"><label for="field-1" class="col-sm-3 control-label">Image:</label>				
			<div class="col-sm-6"><input type="file" name="image" id="fileToUpload" value="<?php echo $img_location; ?>"  required="required" /></div>
		</div>
	</div>
	<div class="col-md-12 form-group">		
		<div class="col-sm-offset-1 col-sm-11">
			<button type="submit" class="btn btn-primary">Submit</button>
			    <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
		</div>
	</div>
</form>
<?php
} else {
    echo "<meta http-equiv='refresh' content='0; url=?vis=companys'>";
}
?>
