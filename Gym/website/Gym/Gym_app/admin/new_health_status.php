		<h2>Health Status</h2>
		<hr />
		<form action="submit_health_new.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
			<div class="form-group">
				<label class="col-sm-3 control-label">Membership ID</label>
                <div class="col-sm-5">	
                  <select name="id" id="id" class="userid" >
                      <option value="">-- Please select --</option>						
                        <?php
                            $query  = "select * from user_data";
                            //echo $query;
                            $result = mysqli_query($con, $query);

                            if (mysqli_affected_rows($con) != 0) {
                                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    echo "<option value=" . $row['id'] . ">" . $row['newid'] . "</option>";
                                }
                            }
                        ?>								
                  </select>			
                </div>
			</div>			
			<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-5">						
                    <select name="name" id="name" class="username" >
                        <option value="">-- Please select --</option>						
                          <?php
                              $query  = "select * from user_data";
                              //echo $query;
                              $result = mysqli_query($con, $query);

                              if (mysqli_affected_rows($con) != 0) {
                                  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                      echo "<option value=" . $row['name'] . ">" . $row['name'] . "</option>";
                                  }
                              }
                          ?>								
                    </select>
                </div>
			</div>
			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Date:</label>					
					<div class="col-sm-5">
						<input type="text" name="date1" id="date1" class="form-control datepicker" value="<?php echo date('Y-m-d'); ?>">
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Body Fat:</label>					
					<div class="col-sm-5">
						<input type="text" name="bodyfat" id="bodyfat" class="form-control" placeholder="Body Fat" >
					</div>
			</div>			

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Water:</label>					
					<div class="col-sm-5">
						<input type="text" name="water" id="water" class="form-control" placeholder="Water" >
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Muscle:</label>					
					<div class="col-sm-5">
						<input type="text" name="muscle" id="muscle" class="form-control" placeholder="Muscle" >
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Calorie:</label>					
					<div class="col-sm-5">
						<input type="text" name="calorie" id="calorie" class="form-control" placeholder="Calorie" >
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Bone:</label>					
					<div class="col-sm-5">
						<input type="text" name="bone" id="bone" class="form-control" placeholder="Bone" >
					</div>
			</div>

			<div class="form-group">
				<label for="field-1" class="col-sm-3 control-label">Remarks:</label>					
					<div class="col-sm-5">
						<input type="text" name="remarks" id="remarks" class="form-control" placeholder="Remarks" >
					</div>
			</div>										

			<div class="form-group">		
					<div class="col-sm-offset-3 col-sm-5">
						<button type="submit" class="btn btn-primary">Save changes</button>	
					</div>
			</div>				
</form>
<script type="text/javascript">
$(document).ready(function()
{
	$(".userid").change(function()
	{
	var id=$(this).val();
	var dataString = 'id='+ id;
		$.ajax({
		type: "POST",
		url: "ajax_users.php",
		data: dataString,
		cache: false,
		success: function(html){
		$(".username").html(html);
		} 
		});
	});
});
$(document).ready(function()
{
	$(".username").change(function()
	{
	var id=$(this).val();
	var dataString = 'name='+ id;
		$.ajax({
		type: "POST",
		url: "ajax_usersid.php",
		data: dataString,
		cache: false,
		success: function(html){
		$(".userid").html(html);
		} 
		});
	});
});
</script>


   
