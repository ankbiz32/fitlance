<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
a {color: #2652a5;}
</style>

	<div class="table-responsive">
	<h4 class="hed">Members & their membership details</h4>
	<div class="col-sm-12" style="padding-bottom:20px;"><form method="post" action="export_mem.php"><input type="submit" name="export" class="btn btn-sm btn-success pull-right" value="Export To Excel" /></form><a href="?vis=new_entry" class="btn btn-sm btn-info pull-right">Add Member</a></div>
	<hr />
	<table class="table table-bordered datatable" id="table-12">
		<thead>
			<tr>
			<th>S.No</th>
			<th>Member Name / Id <br><small> (contact)</small></th>
			<th>Plan / Workout Time</th>
			<th>Join Date / <br> Exp. date</th>
			<th>Payable amt.<br> <small>(Rate - Discount)</small></th>
			<th>Paid</th>
			<th>Balance</th>
			<th style="width: 230px !important;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$query  = "select * from subsciption where renewal='yes' AND is_active='1' AND is_deleted='0' AND (branch_id = '$_SESSION[branch_id]' OR is_combo_member ='1' ) ORDER BY id DESC";
			$result = mysqli_query($con, $query);
		    $sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid   = $row['mem_id'];

				$query1  = "select * from user_data WHERE newid='$msgid' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

				$query2  = "select * from workout_time WHERE id='".$row1['workout_time_id']."' AND is_active='1'";
			    $result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$query3  = "select * from mem_types WHERE mem_type_id ='".$row['sub_type']."' AND is_active='1'";
			    $result3 = mysqli_query($con, $query3);
				$row3 = mysqli_fetch_assoc($result3);
				
				$date1 = date('d-m-Y',strtotime( $row['expiry'] ));
				// $date2 = date('d-m-Y',strtotime( $row1['joining'] ));
				$date2 = date('d-m-Y',strtotime( $row['paid_date'] ));

				    echo "
					<tr>

						<td>" .  $sno . "</td>";					
						echo "<td>" . "<a href='index.php?vis=member_info&name=".$msgid."'>".$row1['name'] . " / " . $row1['newid']."</a> <br> <span>(".$row1['contact'].")</span></td>";
						echo "<td>" . $row['sub_type_name'] . " / " . $row2['name'] . "</td>";
						echo "<td style='white-space:nowrap'>" . $date2 . " / <br>" . $date1 . "</td>";
						echo "<td>" . ($row3['rate']-$row['dis'])."<br><span  style='white-space:nowrap'>(".$row3['rate']. " - " .$row['dis']. ")</span></td>";
						echo "<td>" . $row['paid'] . "</td>";
						echo "<td>" . $row['bal'] . "</td>";
						if($row['is_combo_member'] && $row['branch_id']!=$_SESSION['branch_id']){
							echo "<td><form action='index.php?vis=read_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='View' class='btn btn-info btn-sm pull-left'/></form></td>";
						} else{
							echo "<td><form action='deactive_member.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' onclick='return confirm(\"Are you sure you want to make this member inactive?\");' value='Make inactive ' class='btn btn-success btn-sm pull-left'/></form><form action='index.php?vis=read_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='View' class='btn btn-info btn-sm pull-left'/></form><form action='index.php?vis=edit_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' style='color:black' value='Edit' class='btn btn-warning btn-sm pull-left'/></form><form action='del_member.php' method='post' onSubmit='return ConfirmDelete();' hidden><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' onclick='return confirm(\"Are you sure you want to delete this member?\");' value='Delete ' class='btn btn-danger btn-sm pull-left'/></form></td>";
						}
						echo" 

					</tr>";
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