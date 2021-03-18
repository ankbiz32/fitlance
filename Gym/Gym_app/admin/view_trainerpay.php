<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<div class="table-responsive">
<h4 class="hed">Trainer Payments Details</h4>
  <div class="col-sm-12" style="padding-bottom: 15px;"><form method="post" action="export_trainerpay.php"><input type="submit" name="export" class="btn btn-sm btn-danger pull-right" value="Export To Excel" /></form></div>
<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Name / Staff ID</th>
				<th>Designation</th>
				<th>Total Amount</th>
				<th>Percentage</th>
				<th>Paid Amount</th>
				<th>Paid Date </th>
				<!--<th>Invoice </th>-->
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from trainer ORDER BY trainer_name DESC";
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
						echo "<td>" . $row3['name'] . "</td>";
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




