<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
a {color: #2652a5;}
</style>
	<a href="index.php?vis=view_staff" class="btn btn-default">← Back</a> <br> <br>
	<?php 
	if (isset($_POST['name'])) { ?>
	<b>Staff Details of : -  <?php
	$id     = $_POST['name'];
	$query  = "select * from staff_data WHERE staffid='$id'";
	$result = mysqli_query($con, $query);
	if (mysqli_affected_rows($con) != 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$name = $row['name'];
			echo strtoupper($name);
		}
	}
	?></b>
	<hr />

	<div class="table-responsive">
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>Staff Name / Id</th>
				<th>Address / Contact</th>
				<th>Sex / Designation</th>
				<th>Join On</th>
			</tr>
		</thead>
		<tbody>
		<?php
		    $query  = "select * from staff_data WHERE staffid='$id'";
		    $result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['staffid'];

				$query2  = "select * from designation WHERE id='".$row['designation']."'";
				$result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_array($result2);
   
					$date1 = date('d-m-Y',strtotime( $row['date'] ));
					echo "<tr><td>" . $row['name'] . " / " . $row['staffid'] . "</td>";
					echo "<td>" . $row['address'] . " / " . $row['mobile'] . "</td>";
					echo "<td>" . $row['gender'] . " / " . $row2['name'] . "</td>";
					echo "<td>" . $date1 . "</td></tr>";
				}
			}
		?>	
		</tbody>
	</table>
	</div>

	<b>Staff Payment Details of : -  <?php
	$id     = $_POST['name'];
	$query  = "select * from staff_pay WHERE staffid='$id'";
	$result = mysqli_query($con, $query);
	if (mysqli_affected_rows($con) != 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$name = $row['name'];
			echo strtoupper($name);
		}
	}
	?></b>
	<hr />

	<div class="table-responsive" style="">
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Staff Name / Id</th>
				<th>Payment Date</th>
				<th>Total</th>
				<th>Paid / Balance</th>
				<th>Payment Method</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$staffid  = $_POST['name'];
			$query  = "select * from staff_pay WHERE staff_id='$staffid' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['invoice'];

				$date3 = date('d-m-Y',strtotime( $row['paid_date'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['name'] . " / " . $staffid. "</td>";
					echo "<td>" . $date3 . "</td>";
					echo "<td>" . $row['total'] . "</td>";
					echo "<td>" . $row['paid'] . " / " . $row['paybalance'] . "</td>";
					echo "<td>" . $row['payment_method']  . "</td>";
				$sno++;
					echo "<td>
						<form action='?vis=edit_staffpay' method='post'><input type='hidden' name='name' value='" . $row['id'] . "'/><input style='color:black' type='submit' value='Edit payment ' class='btn btn-warning btn-sm'/></form>
						<form action='staff_invoice.php' method='post'><input type='hidden' name='staff_id' value='" . $staffid . "'/><input type='hidden' name='id' value='" . $row['id'] . "'/><input type='submit' value='Print Invoice ' class='btn btn-info btn-sm'/></form>
					</td></tr>";

				$msgid = 0;
				}
			}
		?>							
		</tbody>
	</table>
	</div>

<?php
}else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}       
?>  