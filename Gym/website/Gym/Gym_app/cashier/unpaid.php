		<h2>Unpaid Members List</h2>
		<hr />
<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Invoice</th>
					<th>Member ID</th>
					<th>Name</th>
					<th>Plan Name</th>
					<th>Date of Payment</th>
					<th>Total / Paid</th>
					<th>Balance</th>
					<th>Expiry</th>
					<th></th>
				</tr>
			</thead>
				<tbody>
					<?php
						$query = "select * from subsciption WHERE bal>0 ORDER BY bal DESC";
						//echo $query;								<tbody>

						$result = mysqli_query($con, $query);
						$sno    = 1;
						$income = 0;
						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						        $msgid   = $row['mem_id'];
						        $query1  = "select * from user_data WHERE newid='$msgid'";
						        $result1 = mysqli_query($con, $query1);
						        if (mysqli_affected_rows($con) == 1) {
						            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
						                
						                
						                
						                echo "<td>" . $sno . "</td>";
						                echo "<td>" . $row['invoice'] . "</td>";
						                echo "<td>" . $msgid . "</td>";
						                echo "<td>" . $row['name'] . "<img src='" . $row1['pic_add'] . "'></td>";
						            }
						        }
						        echo "<td>" . $row['sub_type_name'] . "</td>";
						        echo "<td>" . $row['paid_date'] . "</td>";
						        echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
						        echo "<td>" . $row['bal'] . "</td>";
						        echo "<td>" . $row['expiry'] . "</td>";
						        $sno++;
						        
						        echo "<td><form action='?vis=bal_pay' method='post'><input type='hidden' name='name' value='" . $row['invoice'] . "'/><input type='submit' value='Pay Balance ' class='btn btn-info'/></form></td></tr>";
						        $msgid  = 0;
						        $income = $row['bal'] + $income;
						    }
						    
						}

					?>																	
					</tbody>
				</table>

				<h3>Total Unpaid Amount :<?php echo $income; ?></h3>
						
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