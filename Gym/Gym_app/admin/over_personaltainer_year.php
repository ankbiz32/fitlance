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
<h4 class="hed">Personal Trainer Overview</h4>
<hr />
<form action="?vis=over_personaltrainer" method="POST" class='form-horizontal form-bordered'>
	<div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">From :</label>					
			<div class="col-sm-5">
				<?php echo "<select name='dayf'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='monthf'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yearf'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
			</div>
	</div>
	<hr />
	<div class="form-group">
		<label for="field-1" class="col-sm-3 control-label">To :</label>					
			<div class="col-sm-5">
				 <?php echo "<select name='dayt'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
								    echo "<select name='montht'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
                                    echo "<select name='yeart'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
			</div>
	</div>
    <hr />
	<div class="form-actions">
			<button type="submit" class="btn btn-primary">Save changes</button>
	</div>
</form>
