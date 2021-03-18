<div class="table-responsive">
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Membership Expiry</th>
					<th>Name / Member ID</th>
					<th>Address / Contact</th>
					<th>Height / Weight</th>
					<th>Join / Plan</th>
					<th style="width: 200px !important;">Action</th>
				</tr>
			</thead>
				<tbody>
						<?php
							$query  = "select * from user_data ORDER BY joining DESC";
							$result = mysqli_query($con, $query);
							$sno    = 1;

							if (mysqli_affected_rows($con) != 0) {
							    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							        $msgid   = $row['newid'];
							        $query1  = "select * from subsciption WHERE mem_id='$msgid' AND renewal='yes'";
									//echo $query1;
							        $result1 = mysqli_query($con, $query1);
							        if (mysqli_affected_rows($con) == 1) {
							            while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
							                
							                
							                echo "<tr><td>" . $row1['expiry'] . "</td>";
							                $expiry        = $row1['expiry'];
							                $sub_type_name = $row1['sub_type_name'];
							                
							                echo "<td>" . $row['name'] . " / " . $row['newid'] . "<img src='" . $row['pic_add'] . "'></td>";
							                echo "<td>" . $row['address'] . " / " . $row['contact'] . "</td>";
							                echo "<td>" . $row['height'] . " / " . $row['weight'] . "</td>";
							                echo "<td>" . $row['joining'] . " / " . $row1['sub_type_name'] . "</td>";
							                
							                $sno++;
							                
							                echo "<td><form action='index.php?vis=read_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='View History ' class='btn btn-info btn-sm pull-left'/></form><form action='index.php?vis=edit_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form><form action='del_member.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
							                $msgid = 0;
							            }
							        }
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

        <script type="text/javascript">
		var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
		var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
		var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
		var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
		var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
		var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2");
    </script>
    </body>
</html>





