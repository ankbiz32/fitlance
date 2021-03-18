<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>
	<?php
	$months = array(01 =>'January',02 =>'February',03 =>'March',04 =>'April',05 =>'May',06 =>'June',07 =>'July',08 =>'August',09 =>'September',10 =>'October',11 =>'November',12 =>'December');
	$days = range(1,31);
	$years = range (1960, 2030);
	$currentDay = date('d');
	$currentMonth = date('F');
	$currentYear = date('Y');
	?>
	<h4 class="hed">Members Overview :</h4>
	<hr /><form action="?vis=follow_up" method="POST" class='form-horizontal form-bordered'>
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
		<a href="?vis=follow_up" class="btn btn-danger btn-sm">Reset</a>
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

	<div class="table-responsive">
	<table class="table table-bordered datatable" id="table-12">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Member Name / Id</th>
				<th>Address / Contact</th>
				<th>Gender / Workout Time</th>
				<th>Plan</th>
				<th>Total / Discount</th>
				<th>Paid / Balance</th>
				<th>Join Date / Expiry Date</th>
			</tr>
		</thead>
		<tbody>
		    <?php
			$query  = "select * from subsciption where renewal='yes' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
		    $sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid   = $row['mem_id'];

				$query1  = "select * from user_data WHERE newid='$msgid' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

				$query2  = "select * from workout_time WHERE id='".$row1['workout_time_id']."'";
			    $result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$query3  = "select * from mem_types WHERE mem_type_id ='".$row['sub_type']."'";
			    $result3 = mysqli_query($con, $query3);
				$row3 = mysqli_fetch_assoc($result3);
				
				$date1 = date('d-m-Y',strtotime( $row['expiry'] ));
				$date2 = date('d-m-Y',strtotime( $row1['joining'] ));

				    echo "<tr><td>" .  $sno . "</td>";					
					echo "<td>" . $row1['name'] . " / " . $row1['newid'] . "</td>";
					echo "<td>" . $row1['address'] . " / " . $row1['contact'] . "</td>";
					echo "<td>" . $row1['sex'] . " / " . $row2['name'] . "</td>";
					echo "<td>" . $row['sub_type_name'] . "</td>";
					echo "<td>" . $row3['rate'] . " / " . $row['dis'] . "</td>";
					echo "<td>" . $row['paid'] . " / " . $row['bal'] . "</td>";
					echo "<td>" . $date2 . " / " . $date1 . "</td></tr>";
					$sno++;
					$msgid = 0;
				}
			}
            ?>										
		</tbody>
	</table>
	</div>
	<?php }else{ ?>

		<div class="table-responsive">
	<table class="table table-bordered datatable" id="table-12">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Member Name / Id</th>
				<th>Address / Contact</th>
				<th>Gender / Workout Time</th>
				<th>Plan</th>
				<th>Total / Discount</th>
				<th>Paid / Balance</th>
				<th>Join Date / Expiry Date</th>
			</tr>
		</thead>
		<tbody>
		    <?php
			$query  = "select * from subsciption where renewal='yes' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
		    $sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid   = $row['mem_id'];

				$query1  = "select * from user_data WHERE newid='$msgid' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

				$query2  = "select * from workout_time WHERE id='".$row1['workout_time_id']."'";
			    $result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$query3  = "select * from mem_types WHERE mem_type_id ='".$row['sub_type']."'";
			    $result3 = mysqli_query($con, $query3);
				$row3 = mysqli_fetch_assoc($result3);
				
				$date1 = date('d-m-Y',strtotime( $row['expiry'] ));
				$date2 = date('d-m-Y',strtotime( $row1['joining'] ));

				    echo "<tr><td>" .  $sno . "</td>";					
					echo "<td>" . $row1['name'] . " / " . $row1['newid'] . "</td>";
					echo "<td>" . $row1['address'] . " / " . $row1['contact'] . "</td>";
					echo "<td>" . $row1['sex'] . " / " . $row2['name'] . "</td>";
					echo "<td>" . $row['sub_type_name'] . "</td>";
					echo "<td>" . $row3['rate'] . " / " . $row['dis'] . "</td>";
					echo "<td>" . $row['paid'] . " / " . $row['bal'] . "</td>";
					echo "<td>" . $date2 . " / " . $date1 . "</td></tr>";
					$sno++;
					$msgid = 0;
				}
			}
            ?>										
		</tbody>
	</table>
	</div>

	<?php } ?>
	
	<h4>Total Payments in This Date Range : <?php echo $sno - 1; ?></h4>
	<h4>Total Income in This Date Range : <?php echo $total;?></h4>

<script type="text/javascript">
jQuery(document).ready(function($)
{
$("#table-12").dataTable({
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


