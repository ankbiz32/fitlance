
<div class="table-responsive">
  <h4 class="hed">Pending / Unpaid Member List</h4>
  <p>List of all members with pending payments.</p>
  <div class="col-sm-12" style="padding-bottom:15px;"><form method="post" action="export_pending.php"><input type="submit" name="export" class="btn btn-sm btn-success pull-right" value="Export To Excel" /></form></div>
  <hr />
	<table class="table table-bordered datatable" id="table-2">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Invoice</th>
				<th>Name / Member ID</th>
				<th>Contact</th>
				<th>Plan Name / Rate</th>
				<th>Total / Discount </th>
				<th>Paid / Balance</th>
				<th>Join Date / Expiry Date</th>
				<th>Date of Payment</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query = "select * from subsciption WHERE bal>0 AND branch_id = '$_SESSION[branch_id]' AND is_active = '1' ORDER BY id DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
		$income = 0;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid   = $row['mem_id'];
				$sub_type = $row['sub_type'];
				$query1  = "select * from user_data WHERE newid='$msgid'";
				$result1 = mysqli_query($con, $query1);
					if (mysqli_affected_rows($con) == 1) {
						while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
						$query11 = "select * from mem_types WHERE mem_type_id='$sub_type'";
						//echo $query11;
						$result11 = mysqli_query($con, $query11);
						$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
					    $date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
			            $date2 = date('d-m-Y',strtotime( $row['expiry'] ));
						$date3 = date('d-m-Y',strtotime( $row['pay_date'] ));
						echo "<td>" . $sno . "</td>";
						echo "<td>" . $row['invoice'] . "</td>";
						echo "<td>" . $row['name']. " / " .  $msgid . "</td>";
						echo "<td>" . $row1['contact'] . "</td>";
						echo "<td>" . $row['sub_type_name'] .  " / " .  $row11['rate'] . "</td>";
						echo "<td>" . $row['total'] . " / " . $row['dis'] ."</td>";
						echo "<td>" . $row['paid'] . " / ". $row['bal'] . "</td>";
						echo "<td>" . $date1 . " / " . $date2 . "</td>";
						echo "<td>" . $date3 . "</td>";
				        $sno++;
						echo "<td><form action='?vis=bal_pay' method='post'><input type='hidden' name='name' value='" . $row['invoice'] . "'/><input type='submit' value='Pay Balance ' class='btn btn-info'/></form>
						<form action='?vis=view_payment_details' method='post'><input type='hidden' name='name' value='" . $row['invoice'] . "'/><input type='submit' value='View Balance ' class='btn btn-success'/></form></td></tr>";
						$msgid  = 0;
						$income = $row['bal'] + $income;
						}
					}
				}
			}
		?>																	
		</tbody>
	</table>
</div>

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
<style>
a {
    color: #0fb2f1;
    text-decoration: none;
}
</style>
		
