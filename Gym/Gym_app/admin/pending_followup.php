<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<h4 class="hed">Pending Follow Up</h4>
<hr />
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
        $query = "SELECT * FROM `follow` WHERE is_active='1' ORDER BY id DESC";
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
						echo"<td><form action='' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Transfer Member' class='btn btn-success btn-sm pull-left'/></form>
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




