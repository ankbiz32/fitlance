<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<h4 class="hed">Unpaid Personal Trainer List</h4>
<hr />
	<table class="table table-bordered datatable" id="table-2">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Invoice</th>
				<th>Member ID / Member Name</th>
				<th>Trainer ID / Trainer Name</th>
				<th>Date of Payment</th>
				<th>Total / Paid</th>
				<th>Balance</th>
				<th>Expiry</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query = "select * from trainer_pay WHERE paybalance>0 ORDER BY paybalance DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
		$income = 0;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				   $msgid   = $row['member_id'];
				   $date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				   $date2 = date('d-m-Y',strtotime( $row['expiry'] ));
						echo "<td>" . $sno . "</td>";
						echo "<td>" . $row['invoice'] . "</td>";
						echo "<td>" . $msgid . " / " . $row['member_name']. "</td>";
						echo "<td>" . $row['staff_id'] . " / " . $row['staff_name']. "</td>";
						echo "<td>" . $date1 . "</td>";
						echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
						echo "<td>" . $row['paybalance'] . "</td>";
						echo "<td>" . $date2 . "</td>";
				        $sno++;
						echo "<td><form action='?vis=bal_trainerpay' method='post'><input type='hidden' name='name' value='" . $row['invoice'] . "'/><input type='submit' value='Pay Balance ' class='btn btn-info'/></form></td></tr>";
						$msgid  = 0;
						$income = $row['paybalance'] + $income;
				}
			}
		?>																	
		</tbody>
	</table>

<h3>Total Unpaid Amount :<?php echo $income; ?></h3>
<link rel="stylesheet" href="../../vishnu/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="../../vishnu/js/select2/select2.css">
<script src="../../vishnu/js/jquery.dataTables.min.js"></script>
<script src="../../vishnu/js/dataTables.bootstrap.js"></script>
<script src="../../vishnu/js/select2/select2.min.js"></script>					
<script type="text/javascript">
jQuery(document).ready(function($)
{
	$("#table-2").dataTable({
		"sPaginationType": "bootstrap",
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"bStateSave": true
	});
	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
});
</script>
		
