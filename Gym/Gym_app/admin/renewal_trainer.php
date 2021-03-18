<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>

	<div class="table-responsive">
	<h4 class="hed">Personal Trainer Renewal Details</h4>
	<hr />
	<table class="table table-bordered datatable" id="table-12">
		<thead>
			<tr>
			<th>S.No</th>
			<th>Member Name / Id</th>
			<th>Trainer Name / Id</th>
			<th>Join Date / Plan</th>
			<th>Total</th>
			<th>Paid / Balance</th>
			<th>Expiry Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$query  = "select * from trainer_pay where renewal='yes' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
		    $sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid   = $row['mem_id'];

				$query2  = "select * from trainer_types WHERE staff_type_id='".$row1['trainer_type_id']."'";
			    $result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$date1 = date('d-m-Y',strtotime( $row['expiry_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['join_date'] ));

				    echo "<tr><td>" .  $sno . "</td>";					
					echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
					echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
					echo "<td>" . $date2. " / " . $row2['name'] . "</td>";
					echo "<td>" . $row['total'] . "</td>";
					echo "<td>" . $row['paid'] . " / " . $row['paybalance'] . "</td>";
					echo "<td>" . $date1 . "</td></tr>";
					$sno++;
					$msgid = 0;
				}
			}
        ?>
		</tbody>
	</table>
	</div>
	
<script type="text/javascript">
jQuery(document).ready(function($)
{
$("#table-12").dataTable({
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