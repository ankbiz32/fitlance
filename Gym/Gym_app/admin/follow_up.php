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
	<h4 class="hed">Todays Follow Up</h4>
	<div class="col-sm-12" style="padding-bottom:15px;"><a href="?vis=pending_followup" class="btn btn-sm btn-info pull-right">Pending Follow Up</a></div>
	<hr />
	<form action="?vis=follow_up" method="POST" class='form-horizontal form-bordered'>
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

	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Address / Contact</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query1  = "select * from follow WHERE joining  BETWEEN '$from2' AND '$to2' AND is_active='1'  ORDER BY id DESC";
		//echo $query1;
		$result1 = mysqli_query($con, $query1);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
					$msgid = $row1['id'];
					$joining = $row1['joining'];
					$status = $row1['status'];
					$date1 = date('d-m-Y', strtotime( $row1['joining'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row1['name'] . "</td>";
                    echo "<td>" . $row1['address'] . " / " . $row1['contact'] . "</td>";
					echo "<td>" . $date1 . "</td>";
                    if($status == 0){
						echo"<td><form action='index.php?vis=add_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Add Member' class='btn btn-info btn-sm pull-left'/></form>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}else{
						echo"<td><input type='submit' value='Transfer Member' class='btn btn-success btn-sm pull-left'/>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}
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
				<th>Name</th>
				<th>Address / Contact</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
        $currentdate = date('Y/m/d'); 
        $echo . $currentdate;
		$query = "SELECT * FROM `follow` WHERE '$currentdate' =joining AND is_active='1' ORDER BY id DESC";
		//echo $query ;
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$msgid = $row['id'];
					$joining = $row['joining'];
					$status = $row['status'];
					$date1 = date('d-m-Y', strtotime( $row['joining'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['address'] . " / " . $row['contact'] . "</td>";
					echo "<td>" . $date1 . "</td>";
                    if($status == 0){
						echo"<td><form action='index.php?vis=add_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Add Member' class='btn btn-info btn-sm pull-left'/></form>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}else{
						echo"<td><input type='submit' value='Transfer Member' class='btn btn-success btn-sm pull-left'/>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}
					$sno++; 
					$msgid = 0;
				}
			}
		?>									
		</tbody>
	</table>
	<?php } ?>


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




