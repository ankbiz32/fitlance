<div class="table-responsive">
<h4>Plan Details:</h4>
<div class="col-sm-12" style="padding-bottom:15px;"><a href="?vis=new_plan" class="btn btn-sm btn-info pull-right">Add Plan</a></div>
<hr />
<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>S.No</th><th>Plan ID</th>
			<th>Plan name</th>
			<th>Days</th>
			<th>Rate</th>
			<!--<th>Insert By</th>-->
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$query  = "select * from mem_types ORDER BY rate DESC";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$msgid = $row['mem_type_id'];
			$id = $row['insert_by'];
			$query11  = "select * from auth_user WHERE id='$id'";
			$result11 = mysqli_query($con, $query11);
			$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
			
			echo "<tr><td>" . $sno . "</td>";
			echo "<td>" . $row['mem_type_id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['days'] . "</td>";
			echo "<td>" . $row['rate'] . "</td>";
			/*echo "<td>" . $row11['name'] . "</td>";*/
			$sno++;
			echo "<td><form action='?vis=edit_plan' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit Plan ' class='btn btn-info pull-left'/></form><form action='del_plan.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete ' class='btn btn-danger pull-left'/></form></td></tr>";
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
			



