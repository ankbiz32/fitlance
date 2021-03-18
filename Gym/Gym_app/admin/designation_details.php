<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<div class="col-sm-12"><a href="?vis=designation" class="btn btn-sm btn-info pull-right">Add Designation</a></div>
<h4 class="hed">View Designation</h4>
<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>Designation ID</th>
				<th>Designation</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from designation ORDER BY id DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				    $msgid = $row['id'];
					
					echo "<tr><td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					$sno++;
					echo "<td><form action='?vis=edit_designation' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit Designation' class='btn btn-info pull-left'/></form><form action='del_designation.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete ' class='btn btn-danger pull-left'/></form></td></tr>";
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
			



