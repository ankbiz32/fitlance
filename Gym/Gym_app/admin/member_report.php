<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
  <h4 class="hed">Member Report</h4>
  <div class="col-sm-12" style="padding-bottom:30px;">
  <input type="button" class="btn btn-sm btn-danger pull-right" value="Print" onclick="javascript:printDiv('printablediv')" />
  <form method="post" action="export_reportmem.php"><input type="submit" name="export" class="btn btn-sm btn-info pull-right" value="Export To Excel" /></form>
  </div>
  <hr />
  
<div class="table-responsive" id="printablediv">
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No.</th>
				<th> Member ID</th>
				<th> Member Name</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from user_data ORDER BY name DESC";
		//echo $query;
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['newid'];
				echo "<tr><td>" . $sno . "</td>";
				echo "<td>" . $row['newid'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				$sno++;
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
});
</script>
<link rel="stylesheet" href="../../vishnu/js/select2/select2-bootstrap.css"  id="style-resource-1">
<link rel="stylesheet" href="../../vishnu/js/select2/select2.css"  id="style-resource-2">

<script src="../../vishnu/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../../vishnu/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="../../vishnu/js/select2/select2.min.js" id="script-resource-9"></script>
<script language="javascript" type="text/javascript">
	function printDiv(divID) {
		var divElements = document.getElementById(divID).innerHTML;
		var oldPage = document.body.innerHTML;
		document.body.innerHTML = "<html><head><title></title></head><body>" + 
	    divElements + "</body>";
		window.print();
		document.body.innerHTML = oldPage;
	}
</script>
