<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<div class="table-responsive">
  <h4 class="hed">Trainer Details</h4>
  <div class="col-sm-12" style="padding-bottom: 15px;"><form method="post" action="export_trainerdetail.php"><input type="submit" name="export" class="btn btn-sm btn-danger pull-right" value="Export To Excel" /></form><a href="?vis=trainer" class="btn btn-sm btn-info pull-right">Add Person Trainer</a></div>
  <hr />
  <table class="table table-bordered datatable" id="table-1">
    <thead>
      <tr>
        <th>S.No.</th>
        <th>Member Name / Member ID</th>
		    <th>Trainer Name / Trainer ID</th>
        <th style="width:100px;">Join Date </th>
				<th>Session / Insert By</th>
				<th>Invoice</th>
        <th style="width: 200px !important;">Action</th>
      </tr>
    </thead>
    <tbody>
	  <?php
        $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' ORDER BY member_name DESC";
        $result = mysqli_query($con, $query);
        $sno    = 1;
          if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $stafid = $row['id'];
						$id = $row['insert_by'];
						$query11  = "select * from auth_user WHERE id='$id'";
						$result11 = mysqli_query($con, $query11);
						$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
						$query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
						$result2 = mysqli_query($con, $query2);
						$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
						$name = $row11['name'];
						$msgid = $row['invoice'];
						$date1 = date('d-m-Y',strtotime( $row['join_date'] ));
			      //$date2 = date('d-m-Y',strtotime( $row['expiry'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
					echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
					echo "<td>" . $date1 . "</td>";
					echo "<td>" . $row2['name']. " / " . $row11['name'] . "</td>";
				
					echo "<td>" . $row['invoice'] . "</td>";
					$sno++;
					echo "<td><form action='invoice_trainer.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='hidden' name='redirect' value='detalis'/><input type='submit' value='Print Invoice ' class='btn btn-info btn-sm pull-left'/></form><form action='index.php?vis=edit_trainer' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='hidden' name='redirect' value='detalis'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form><form action='del_trainer.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $stafid . "'/><input type='hidden' name='redirect' value='detalis'/><input type='submit' value='Delete ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
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
