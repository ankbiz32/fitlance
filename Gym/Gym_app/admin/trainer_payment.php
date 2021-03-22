<div class="table-responsive">
  <h4 class="hed">+ Add trainer Payment</h4>
  <p>Select any trainer to view their allotted members & add member-wise payment</p>
  <!--<div class="col-sm-12" style="padding-bottom: 15px;"><a href="?vis=trainer" class="btn btn-sm btn-info pull-right">Add Person Trainer</a></div>-->
  <hr />
  <table class="table table-bordered datatable" id="table-1">
    <thead>
      <tr>
        <th>S.No.</th>
		<th>Trainer Name / Trainer ID</th>
        <th>Email / Mobile No.</th>
		<th>Gender / Age </th>
        <th>Designation</th>
        <th style="width: 200px !important;">Action</th>
      </tr>
    </thead>
    <tbody>
	  <?php
        $query  = "select * from trainer_pay GROUP BY staff_id";
        $result = mysqli_query($con, $query);
        $sno    = 1;
          if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $stafid = $row['staff_id'];
			$query2  = "select * from staff_data WHERE staffid='$stafid'";
			//echo $query2 ;
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
			$query3 = "select * from designation WHERE id='".$row2['designation']."'";
			//echo $query3; 
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
				echo "<tr><td>" . $sno . "</td>";
				echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
				echo "<td>" . $row2['email'] . " / " . $row2['mobile'] . "</td>";
				echo "<td>" . $row2['gender']. " / " . $row2['age'] . "</td>";
				echo "<td>" . $row3['name'] . "</td>";
				$sno++;
				echo "<td><form action='index.php?vis=member_view' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Member View' class='btn btn-info'/></form></td></tr>";
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
