<?php
if (isset($_POST['name'])) {  ?>
<b>Trainer Name : -  <?php
$stafid = $_POST['name'];
	$query  = "select * from trainer_pay WHERE staff_id='$stafid'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$id = $row['staff_id'];
			$query  = "select * from staff_data WHERE staffid='$id'";
			$result = mysqli_query($con, $query);
			$sno    = 1;
				if (mysqli_affected_rows($con) == 1) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$name = $row['name'];
						echo $name;
					}
				}
			}
		}
?></b>
<hr />
		<table class="table table-bordered datatable">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Trainer Name / Trainer ID</th>
					<th>Email / Mobile No.</th>
					<th>Gender / Age </th>
					<th>Designation</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$query2 = "select * from staff_data WHERE staffid='$stafid'";
			//echo $query2 ;
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
			$query3 = "select * from designation WHERE id='".$row2['designation']."'";
			//echo $query3; 
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
			echo "<tr><td>" . $sno . "</td>";
			echo "<td>" . $row2['name'] . " / " . $row2['staffid'] . "</td>";
			echo "<td>" . $row2['email'] . " / " . $row2['mobile'] . "</td>";
			echo "<td>" . $row2['gender']. " / " . $row2['age'] . "</td>";
			echo "<td>" . $row3['name'] . "</td>";
			?>
			</tbody>
		</table>
	<b>Monthly Member</b>
	<hr />
		<table class="table table-bordered datatable">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Member ID / Member Name</th>
					<th>Payment</th>
					<th>Percent</th>
					<th>Trainer payment</th>
					<th>Session</th>
					<th>Join Date / Expiry Date </th>
					<th>Action </th>
				</tr>
			</thead>
			<tbody>
			<?php
			//$date  = date('Y-m');
			$query = "select * from trainer_pay WHERE exp_time>0 AND staff_id='$stafid'";
			//echo $query;
			$result = mysqli_query($con, $query);
			$sno    = 1;
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$stafid = $row['staff_id'];
						$query21  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
						//echo $query2;
						$result21 = mysqli_query($con, $query21);
						$row21 = mysqli_fetch_array($result21, MYSQLI_ASSOC);
						    $msgid = $row['id'];
							$date1 = date('d-m-Y',strtotime( $row['join_date'] ));
							$date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));
							echo "<tr><td>" . $sno . "</td>";
							echo "<td>" . $row['member_id'] . " / " . $row['member_name'] . "</td>";
							echo "<td>" . $row['total'] . "</td>";
							echo "<td>40%</td>";
							echo "<td>" . $row['total']*0.4 . "</td>";
							echo "<td>" . $row21['name'] . "</td>";
							echo "<td>" . $date1 . " / " . $date2 . "</td>";
							$sno++;
							echo "<td><form action='index.php?vis=trainer_pay' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Trainer Payment' class='btn btn-info'/></form></td></tr>";
							$stafid = 0;
					}
				}
			?>
			</tbody>
			</table>

<?php
}else {
echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}       
?>   
<script>
function calc() {
  var i = document.getElementById("input").value;
  var p = document.getElementById("percent").value;
  var o = (i/100) * p;
  document.getElementById("output").value = o;
}
</script>