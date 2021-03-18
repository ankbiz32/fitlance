<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>
	<div class="table-responsive">
	<h4 class="hed">Staff Payments</h4>
	<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Name / Staff ID</th>
				<th>Email / Join Date </th>
				<th>Address / Contact</th>
				<th>Designation</th>
				<th>Insert By</th>
				<th style="width: 200px !important;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from staff_data where is_active='1' ORDER BY id DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$id = $row['insert_by'];

					$query2 = "select * from auth_user WHERE id='$id'";
					$result2 = mysqli_query($con, $query2);
					$row2 = mysqli_fetch_assoc($result2);

					$idd = $row['designation'];
					$query3 = "select * from designation WHERE id='$idd'";
					$result3 = mysqli_query($con, $query3);
					$row3 = mysqli_fetch_assoc($result3);

					$stafid = $row['staffid'];
					$date1 = date('d-m-Y',strtotime( $row['date'] ));

					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['name'] . " / " . $row['staffid'] . "</td>";
					echo "<td>" . $row['email'] . " / " . $date1 . "</td>";
					echo "<td>" . $row['address'] . " / " . $row['mobile'] . "</td>";
					echo "<td>" . $row3['name'] . "</td>";
					echo "<td>" . $row2['name'] . "</td>";
					echo "<td width='150'><form action='?vis=staffpay' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Add Payment' class='btn btn-info pull-left'/></form></td></tr>";
					$sno++;
					$stafid = 0;
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




