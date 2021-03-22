<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<h4 class="hed">Expenses</h4>
<div class="col-sm-12" style="padding-bottom:15px;"><form method="post" action="export_expances.php"><input type="submit" name="export" class="btn btn-sm btn-success pull-right" value="Export To Excel" /></form><a href="?vis=expance" class="btn btn-sm btn-info pull-right">Add Expenses</a></div>
<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Item</th>
				<th>Price</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from expance ORDER BY id DESC";
		//echo $query;
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$msgid = $row['id'];
					$date = $row['date'];
					$date1 = date('d-m-Y', strtotime( $row['date'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['item'] . "</td>";
					echo "<td>" . $row['price'] . "</td>";
					echo "<td>" . $date1 . "</td>";
					echo"<td><form action='index.php?vis=edit_account_mangement' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form><form action='del_account_mangement.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
					$sno++; 
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




