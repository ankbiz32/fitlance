<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<div class="table-responsive">
<h4 class="hed">Today Birthday</h4>
<hr />
<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Member ID</th>
			<th>Name</th>
			<th>Date Of Birth</th>
			<th>Contact</th>
			<th>Email</th>
			<!--<th>Action</th>-->
		</tr>
	</thead>
	<tbody>
	<?php
	$query  = "select * from user_data WHERE MONTH(birthdate) = MONTH(NOW()) AND DAY(birthdate) = DAY(NOW()) AND branch_id = '$_SESSION[branch_id]'";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$msgid = $row['newid'];
			$date1 = date('d-m-Y',strtotime( $row['birthdate'] ));
			echo "<tr><td>" . $sno . "</td>";
			echo "<td>" . $row['newid'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $date1 . "</td>";
			echo "<td>" . $row['contact'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			$sno++;
			/*echo "<td><form action='sms_birthday.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Send Message' class='btn btn-info pull-left'/></form></td></tr>";*/
			$msgid = 0;
			}
		}
	?>									
	</tbody>
</table>
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
			



