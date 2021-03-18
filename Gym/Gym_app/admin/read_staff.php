<?php if (isset($_POST['name'])) { ?>
<b>Details of : - <?php 
	$id  = $_POST['name'];
	$query  = "select * from staff_data WHERE staffid='$id'";
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$name = $row['name'];
			echo strtoupper($name);
		  }
		}
	?>
</b><hr />
<div class="table-responsive">
  <table class="table table-bordered datatable" id="table-1">
    <thead>
      <tr>
        <th>Name / Staff ID</th>
        <th>Email / Join Date </th>
        <th>Address / Contact</th>
        <th>Age / Gender</th>
        <th>Designation </th>
		<th>Insert By</th>
		<th></th>
      </tr>
    </thead>
    <tbody>
	  <?php
		$query  = "select * from staff_data WHERE staffid='$id'";
		$result = mysqli_query($con, $query);
		$sno    = 1;
		  if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id = $row['insert_by'];
			$query11  = "select * from auth_user WHERE id='$id'";
			$result11 = mysqli_query($con, $query11);
			$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
			$idd = $row['designation'];
		    $query3 = "select * from designation WHERE id='$idd'";
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_assoc($result3); 
			$date1 = date('d-m-Y',strtotime( $row['date'] ));
			  echo "<td>" . $row['name'] . " / " . $row['staffid'] . "</td>";
			  echo "<td>" . $row['email'] . " / " . $date1 . "</td>";
			  echo "<td>" . $row['address'] . " / " . $row['mobile'] . "</td>";
			  echo "<td>" . $row['age'] . " / " . $row['gender'] . "</td>";
			  echo "<td>" . $row3['name'] . "</td>";
			  echo "<td>" . $row11['name'] . "</td>";
			  echo "<td><form action='id_invoicestaff.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Print ID Card' class='btn btn-info btn-sm pull-left'/></form></td></tr>";
			}
		  }
      ?>
    </tbody>
  </table>
</div>

<b>Details of Payments: - <?php 
	$id  = $_POST['name'];
	$query  = "select * from staff_data WHERE staffid='$id'";
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
		  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$name = $row['name'];
			echo strtoupper($name);
		  }
		}
	?>
</b><hr />

<div class="table-responsive">
  <table class="table table-bordered datatable" id="table-1">
    <thead>
      <tr>
        <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>Staff ID</th>
          <th>Payment Date</th>
          <th>Total  / Paid</th>
          <th>Invoice</th>
          <th style="width: 280px !important;">Action</th>
      </tr>
    </thead>
    <tbody>
	  <?php 
		$staffid  = $_POST['name'];
		$query  = "select * from staff_pay WHERE staff_id='$staffid'";
		//echo $query;
		$result = mysqli_query($con, $query);
		$sno    = 1;
		
		  if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  $stafid = $row['invoice'];
			  $date2 = date('d-m-Y',strtotime( $row['paid_date'] ));
			  echo "<td>" . $sno . "</td>";
			  echo "<td>" . $row['name'] . "</td>";
			  echo "<td>" . $row['staff_id'] . "</td>";
			  echo "<td>" .  $date2 . "</td>";
			  echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
			  echo "<td>" . $row['invoice'] . "</td>";
			  $sno++;
			  echo "<td><form action='invoice_staff.php' method='post'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Print Invoice ' class='btn btn-info btn-sm pull-left'/></form><form action='del_invoicestaff.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $stafid . "'/><input type='submit' value='Delete Invoice ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
			  $stafid = 0;
			}
		  }
      ?>
    </tbody>
  </table>
</div>
<?php
}else {
	echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
}       
?> 












