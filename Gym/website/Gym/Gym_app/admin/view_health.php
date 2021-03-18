<h3>Orange Fitness</h3>
<hr />
<table class="table table-bordered datatable" id="table-1">
	<thead>
		<tr>
			<th>S.No</th>
			<th>Name</th>
			<th>Date</th>
			<th>Body Fat</th>
			<th>Water</th>
			<th>Muscle</th>
			<th>Calorie</th>
			<th>Bone</th>
			<th>Remarks</th>
			<th></th>
		</tr>
	</thead>
<tbody>
<?php
	$query  = "select * from healthstatus ORDER BY name DESC";
	//echo $query;
	$result = mysqli_query($con, $query);
	$sno    = 1;
	if (mysqli_affected_rows($con) != 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$msgid = $row['id'];
			echo "<tr><td>" . $sno . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['date1'] . "</td>";
			echo "<td>" . $row['bodyfat'] . "</td>";
			echo "<td>" . $row['water'] . "</td>";
			echo "<td>" . $row['muscle'] . "</td>";
			echo "<td>" . $row['calorie'] . "</td>";
			echo "<td>" . $row['bone'] . "</td>";
			echo "<td>" . $row['remarks'] . "</td>";
		    $sno++;   
			echo "<td width='150'><form action='?vis=edit_viewhealth' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-info pull-left'/></form><form action='del_viewhealth.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete' class='btn btn-danger pull-left'/></form></td></tr>";
			$msgid = 0;
		}
		
	}

?>									
	</tbody>
</table>
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




