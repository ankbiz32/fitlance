<div class="table-responsive">
<h4>Company Profile</h4>
<div class="col-sm-12" style="padding-bottom:15px;"><a href="?vis=attaindance" class="btn btn-sm btn-info pull-right">Add Company Profile</a></div>
<hr />
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>Sr.No</th>
				<th>Company Name</th>
				<th>Address</th>
				<th>Mobile</th>
				<th>E-Mail</th>
				<th>Website</th>
				<th style="width: 200px !important;">Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$query  = "select * from card ORDER BY id DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['id']; 
				echo "<tr><td>" . $sno. "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['mobile'] . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['website'] . "</td>";
				$sno++;
				echo "<td><form action='?vis=edit_companyprofile' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit ' class='btn btn-info btn-sm pull-left'/></form><form action='del_companyprofile.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' onclick='return confirm(\"Are you sure you want to delete this data?\");' value='Delete' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
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
			




<!--			<h2>Company Profile</h2>
			<div class="col-sm-12"><a href="?vis=attaindance" class="btn btn-sm btn-danger pull-right">Add Company Profile</a></div>
		</div>
		<hr />
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
				<div class="header"><h2>Company Profile</h2></div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
								<thead>
									<tr>
										<th>Sr.No</th>
										<th>Company Name</th>
										<th>Address</th>
										<th>Mobile</th>
										<th>E-Mail</th>
										<th>Website</th>
										<th style="width: 200px !important;">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$query  = "select * from card ORDER BY id DESC";
									$result = mysqli_query($con, $query);
									$sno    = 1;
										if (mysqli_affected_rows($con) != 0) {
											while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
											$msgid = $row['id']; 
											echo "<tr><td>" . $sno. "</td>";
											echo "<td>" . $row['name'] . "</td>";
											echo "<td>" . $row['address'] . "</td>";
											echo "<td>" . $row['mobile'] . "</td>";
											echo "<td>" . $row['email'] . "</td>";
											echo "<td>" . $row['website'] . "</td>";
											$sno++;
											echo "<td><form action='?vis=edit_companyprofile' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit ' class='btn btn-primary btn-xs pull-left'/></form><form action='del_companyprofile.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete' class='btn btn-danger btn-xs pull-left'/></form></td></tr>";
											$msgid = 0;
											}
										}
									?>											
								</tbody>
							</table>
 						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<script src="../../assets/plugins/bootstrap/js/bootstrap.js"></script>
<script src="../../assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="../../assets/js/pages/tables/jquery-datatable.js"></script>
-->