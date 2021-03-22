<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<div class="table-responsive">
<div class="row">
	<h4 class="hed col-sm-6">Trainers payment history with details</h4>
	  <div class="col-sm-6" style="padding-bottom: 15px;"><form method="post" action="export_trainerpay.php"><input type="submit" name="export" class="btn btn-sm btn-danger pull-right" value="Export To Excel" /></form></div>
</div>
<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Trainer name / ID</th>
				<th>Paid for Member / ID</th>
				<th>Session</th>
				<th>Session from / To</th>
				<th>Total Amount</th>
				<th>Percentage</th>
				<th>Paid Amount</th>
				<th>Payment Date </th>
				<!--<th>Invoice </th>-->
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from trainer ORDER BY id DESC";
		//echo $query;
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$msgid = $row['invoice'];
					$query3 = "select * from designation WHERE id='".$row['designation']."'";
					//echo $query3; 
					$result3 = mysqli_query($con, $query3);
					$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
					$date = date('d-m-Y',strtotime( $row['paid_date'] ));
						echo "<tr><td>" . $sno . "</td>";
						echo "<td>" . $row['trainer_name'] . " / " . $row['trainer_id'] . "</td>";
						echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
						echo "<td>" . $row['session_name'] . "</td>";
						echo "<td>" . $row['session_from'] . " / " . $row['session_to'] . "</td>";
						echo "<td>" . $row['total_amount'] . "</td>";
						echo "<td>" . $row['percentage'] ."%" . "</td>";
						echo "<td>" . $row['paid'] . "</td>";
						echo "<td>" . $date . "</td>";
						//echo "<td>" . $row['invoice'] . "</td>";
					$sno++;
					echo "<td><form action='invoice_personaltrainer.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Print Invoice ' class='btn btn-info btn-sm pull-left'/></form></td>";
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




