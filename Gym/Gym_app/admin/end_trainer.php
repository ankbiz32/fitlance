<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>
    <?php
	$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
	$days = range(1,31);
	$years = range (1960, 2030);
	$currentDay = date('d');
	$currentMonth = date('F');
	$currentYear = date('Y');
	?>
    <div class="table-responsive">
    <h4 class="hed">Ending Personal Trainer Lists</h4>
    <div class="col-sm-12" style="padding-bottom:15px;"><form method="post" action="export_ending.php"><input type="submit" name="export" class="btn btn-sm btn-success pull-right" value="Export To Excel" /></form></div>
    <hr />

	<form action="?vis=end_trainer" method="POST" class='form-horizontal form-bordered'>
	<div class="row">
	<div class="col-md-4 form-group"><label for="field-1" class="col-sm-3">From :</label>					
		<div class="col-sm-9">
			<?php echo "<select name='dayf'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
			echo "<select name='monthf'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
			echo "<select name='yearf'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
		</div>
	</div>

	<div class="col-md-4 form-group"><label for="field-1" class="col-sm-3">To :</label>					
		<div class="col-sm-9">
			<?php echo "<select name='dayt'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
			echo "<select name='montht'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
			echo "<select name='yeart'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
		</div>
	</div>

	<div class="col-md-4 form-group">					
		<button type="submit" class="btn btn-info btn-sm">Submit</button>
		<a href="?vis=end_trainer" class="btn btn-danger btn-sm">Reset</a>
	</div>
	</div>	
	</form>
	<hr />

	<?php
	if (isset($_POST['dayf'])) {
		$from2 = $_POST['yearf'].'-'.$_POST['monthf'].'-'.$_POST['dayf'];
		$to2   = $_POST['yeart'].'-'.$_POST['montht'].'-'.$_POST['dayt'];
		$from = date('d-m-Y',strtotime($from2));
		$to   = date('d-m-Y',strtotime($to2));
	?>	
	<h5>Date From :  <?php echo $from; ?>   To :  <?php echo $to; ?> </h5><hr />
        <table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
				<th>S.No.</th>
				<th>Member Name / Id</th>
				<th>Trainer Name / Id</th>
				<th>Join Date / Plan</th>
				<th>Total</th>
				<th>Paid / Balance</th>
				<th>Expiry Date</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$time    = time();
				$newtime = $time + 864000;
				$query   = "select * from trainer_pay WHERE exp_time < $newtime AND renewal='yes' AND branch_id = '$_SESSION[branch_id]' AND paybalance=0 AND expiry_date  BETWEEN '$from2' AND '$to2' ORDER BY expiry DESC";
				$result  = mysqli_query($con, $query);
				$sno     = 1;
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$msgid = $row['invoice'];

						$query2  = "select * from trainer_types WHERE staff_type_id='".$row1['trainer_type_id']."'";
						$result2 = mysqli_query($con, $query2);
						$row2 = mysqli_fetch_assoc($result2);

						$date1 = date('d-m-Y',strtotime( $row['expiry_date'] ));
						$date2 = date('d-m-Y',strtotime( $row['join_date'] ));

						echo "<td>" . $sno . "</td>";
						echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
						echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
						echo "<td>" . $date2. " / " . $row2['name'] . "</td>";
						echo "<td>" . $row['total'] . "</td>";
						echo "<td>" . $row['paid'] . " / " . $row['paybalance'] . "</td>";
						echo "<td>" . $date1 . "</td>";
						          
						echo "<td><form action='?vis=trainer_renewal' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Renewal' class='btn btn-info'/></form></td></tr>";
						$sno++;
						$msgid = 0;
					}
				}
			?>																									
			</tbody>
		</table>

		<?php }else{ ?>

		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
				<th>S.No</th>
				<th>Member Name / Id</th>
				<th>Trainer Name / Id</th>
				<th>Join Date / Plan</th>
				<th>Total</th>
				<th>Paid / Balance</th>
				<th>Expiry Date</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$time    = time();
				$newtime = $time + 864000;
				$query   = "select * from trainer_pay WHERE exp_time < $newtime AND renewal='yes' AND paybalance=0 AND branch_id = '$_SESSION[branch_id]' ORDER BY expiry_date DESC";
				$result  = mysqli_query($con, $query);
				$sno     = 1;
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$msgid = $row['invoice'];

						$query2  = "select * from trainer_types WHERE staff_type_id='".$row1['trainer_type_id']."'";
						$result2 = mysqli_query($con, $query2);
						$row2 = mysqli_fetch_assoc($result2);

						$date1 = date('d-m-Y',strtotime( $row['expiry_date'] ));
						$date2 = date('d-m-Y',strtotime( $row['join_date'] ));

						echo "<td>" . $sno . "</td>";
						echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
						echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
						echo "<td>" . $date2. " / " . $row2['name'] . "</td>";
						echo "<td>" . $row['total'] . "</td>";
						echo "<td>" . $row['paid'] . " / " . $row['paybalance'] . "</td>";
						echo "<td>" . $date1 . "</td>";
						          
						echo "<td><form action='?vis=trainer_renewal' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Renewal' class='btn btn-info'/></form></td></tr>";
						$sno++;
						$msgid = 0;
					}
				}
				?>																							
			</tbody>
		</table>
		<?php } ?>
	</div>
<script type="text/javascript">
	jQuery(document).ready(function($)
	{
		$("#table-1").dataTable({
			"sPaginationType": "bootstrap",
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"bStateSave": true
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
</script>	
<link rel="stylesheet" href="../../vishnu/js/select2/select2-bootstrap.css"  id="style-resource-1">
<link rel="stylesheet" href="../../vishnu/js/select2/select2.css"  id="style-resource-2">
<script src="../../vishnu/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../../vishnu/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="../../vishnu/js/select2/select2.min.js" id="script-resource-9"></script>