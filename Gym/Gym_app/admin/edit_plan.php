<?php
if (isset($_POST['name'])) {
    $memid = $_POST['name'];
?>
<h3>Edit Plan Details</h3>
<hr />
<form action="submit_plan_edit.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
	<?php
        
        $query  = "select * from mem_types WHERE mem_type_id='$memid'";
        //echo $query;
        $result = mysqli_query($con, $query);
        $sno    = 1;
        
        if (mysqli_affected_rows($con) == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $name    = $row['name'];
                $days    = $row['days'];
                $rate    = $row['rate'];
                $combo    = $row['is_combo'];
            }
        }
    ?>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Plan ID :</label>					
            <div class="col-sm-5">
                <input type="text" name="p_id" value="<?php echo $memid; ?>" class="form-control" readonly/>
            </div>
    </div>

    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Name :</label>					
            <div class="col-sm-5">
                <input type="text" name="name" id="textfield3" class="form-control" data-rule-required="true" data-rule-minlength="4" value ='<?php echo $name; ?>' placeholder="Plan Name" maxlength="100">
            </div>
            
          <input type="checkbox" name="is_combo" id="checkbox" class=""  <?= $combo?'checked':''?>>
          <label for="checkbox" class="control-label" style="margin-bottom:2px">Is a combo plan (Can workout in both gyms with this plan)</label>			
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Days :</label>					
            <div class="col-sm-5">
                <input type="text" name="days" id="textfield4" class="form-control" data-rule-required="true" data-rule-minlength="1" placeholder="Days" value ='<?php echo $days; ?>'  onKeyPress="return checkIt(event)" maxlength="3">
            </div>
    </div>										


    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label">Rate :</label>					
            <div class="col-sm-5">
                <input type="text" name="rate" id="textfield6" class="form-control" data-rule-required="true" data-rule-minlength="10" placeholder="Mobile / Phone" value ='<?php echo $rate; ?>'  onKeyPress="return checkIt(event)" maxlength="10">
            </div>
    </div>		
    <div class="form-group">
            <div class="col-sm-offset-3 col-sm-5">
                <button type="submit" class="btn btn-primary">Save changes</button>	
			    <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
            </div>
    </div>	
</form>

<?php
} else {
    echo "<meta http-equiv='refresh' content='0; url=?vis=view_plan'>";
}
?>

