﻿
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Membership Expiry</th>
					<th>Name / Member ID</th>
					<th>Address / Contact</th>
					<th>Proof</th>
					<th>E-Mail / Age / Sex</th>
					<th>Height / Weight</th>
					<th>Height / Weight</th>
					<th>Action</th>
				</tr>
			</thead>
				<tbody>

						<?php
							$query  = "select * from user_data ORDER BY joining DESC";
							//echo $query;
							$result = mysqli_query($con, $query);
							$sno    = 1;

							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $msgid   = $row['newid'];
							        $query1  = "select * from subsciption WHERE mem_id='$msgid' AND renewal='yes'";
							        $result1 = mysqli_query($con, $query1);
							        if (mysqli_affected_rows($con) == 1) {
							            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
							                
							                
							                echo "<tr><td>" . $row1['expiry'] . "</td>";
							                $expiry        = $row1['expiry'];
							                $sub_type_name = $row1['sub_type_name'];
							                
							                echo "<td>" . $row['name'] . " / " . $row['newid'] . "<img src='" . $row['pic_add'] . "'></td>";
							                echo "<td>" . $row['address'] . " / " . $row['contact'] . "</td>";
							                echo "<td>" . $row['proof'] . " / " . $row['other_proof'] . "</td>";
							                echo "<td>" . $row['email'] . " / " . $row['age'] . " / " . $row['sex'] . "</td>";
							                echo "<td>" . $row['height'] . " / " . $row['weight'] . "</td>";
							                echo "<td>" . $row['joining'] . " / " . $row1['sub_type_name'] . "</td>";
							                
							                $sno++;
							                
							                echo "<td><form action='read_member.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='View History ' class='btn btn-info'/></form><form action='edit_member.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning'/></form><form action='health_member.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Health Status' class='btn btn-ifo'/></form><form action='del_member.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete ' class='btn btn-danger'/></form></td></tr>";
							                $msgid = 0;
							            }
							        }
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
			





