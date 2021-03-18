		<h2>Members List</h2>
		<hr />
<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Name / Member ID</th>
					<th>Date of Last Payment</th>
					<th>Plan</th>
					<th>Total / Paid </th>
					<th>Balance</th>
					<th>expiry</th>
					<th></th>
				</tr>
			</thead>

				<tbody>
						<?php

						$time    = time();
						$newtime = $time + 864000;
						$query   = "select * from subsciption WHERE exp_time < $newtime AND renewal='yes'  ORDER BY expiry DESC";
						//echo $query;
						$result  = mysqli_query($con, $query);
						$sno     = 1;

						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						        $msgid = $row['mem_id'];
						        echo "<td>" . $sno . "</td>";
						        echo "<td>" . $row['name'] . " / " . $row['mem_id'] . "</td>";
						        echo "<td>" . $row['paid_date'] . "</td>";
						        echo "<td>" . $row['sub_type_name'] . "</td>";
						        echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
						        echo "<td>" . $row['bal'] . "</td>";
						        echo "<td>" . $row['expiry'] . "</td>";
						        $sno++;
						        
						        echo "<td><form action='?vis=make_payments' method='post'><input type='hidden' name='name' value='" . $row['mem_id'] . "'/><input type='submit' value='Make Payment' class='btn btn-info'/></form></td></tr>";
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