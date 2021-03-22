<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
	<form action="submit_expance.php" enctype="multipart/form-data" method="POST" role="form" class="form-horizontal form-groups-bordered">
		<div class="row">
		  <h4 class="hed">Add Expenses</h4>
		  <hr/>
			<div class="col-md-4 form-group"><label for="field-1" class="col-sm-3 control-label">Item :</label>					
				<div class="col-sm-9"><input type="text" name="item" id="item" class="form-control" placeholder="Item" ></div>
			</div>
			<div class="col-md-4 form-group"><label for="field-1" class="col-sm-3 control-label">Price :</label>					
				<div class="col-sm-9"><input type="text" name="price" id="price" class="form-control" placeholder="Price" ></div>
			</div>
			<div class="col-md-4 form-group"><label for="field-1" class="col-sm-3 control-label">Date :</label>					
				<div class="col-sm-9"><?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?></div>
			</div>
		</div>
		<div class="col-md-12 form-group">		
			<div class="col-sm-offset-1 col-sm-11">
				<button type="submit" class="btn btn-primary ">Submit</button>
			    <button type="button" class="btn btn-secondary" onclick="history.back()">Cancel</button>
			</div>
		</div>
	</form>

		
		

