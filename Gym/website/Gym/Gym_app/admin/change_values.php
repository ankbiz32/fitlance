<h3>Membership Plan</h3>
<hr />
<table class="table table-bordered datatable" id="table-1">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Membership ID</th>
            <th>Plan name</th>
            <th>Details</th>
            <th>Days</th>
            <th>Rate</th>
            <th></th>
        </tr>
    </thead>		
        <tbody>
            <?php
            $query  = "select * from mem_types ORDER BY rate DESC";
            $result = mysqli_query($con, $query);
            $sno    = 1;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $msgid = $row['mem_type_id'];
                    echo "<tr><td>" . $sno . "</td>";
                    echo "<td>" . $row['mem_type_id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['details'] . "</td>";
                    echo "<td>" . $row['days'] . "</td>";
                    echo "<td>" . $row['rate'] . "</td>";
                    $sno++;
                    echo "<td><form action='?vis=edit_plan' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit Plan ' class='btn btn-info pull-left'/></form><form action='del_plan.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete Plan' class='btn btn-danger pull-left'/></form></td></tr>";
                    $msgid = 0;
                }
            }
            ?>																
        </tbody>
</table>
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


				