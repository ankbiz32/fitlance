<?php
if (isset($_POST['name'])) {  ?>
<b>Member Name : -  <?php
    $msgid = $_POST['name'];
	$query  = "select * from trainer_pay WHERE id='$msgid'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			            $stafid = $row['id'];
						$staff_id = $row['staff_id'];
						$member_id = $row['member_id'];
						$member_name = $row['member_name'];
						echo $member_name;
			}
		}
?></b>
<?php 
$query22 = "select * from trainer WHERE trainer_id='$staff_id'";
//echo $query22;
$result22 = mysqli_query($con, $query22);
$sno    = 1;
if (mysqli_affected_rows($con) == 1) {
while ($row22 = mysqli_fetch_array($result22, MYSQLI_ASSOC)) { 
$percentage = $row22['percentage'];
//echo $percentage;
}
}
?>
<?php
$months = array(1 =>'January',2 =>'February',3 =>'March',4 =>'April',5 =>'May',6 =>'June',7 =>'July',8 =>'August',9 =>'September',10 =>'October',11 =>'November',12 =>'December');
$days = range(1,31);
$years = range (1960, 2030);
$currentDay = date('d');
$currentMonth = date('F');
$currentYear = date('Y');
?>
<hr />
	<form action="submit_trainerpay.php" enctype="multipart/form-data" method="POST" role="form" onkeyup="calc()" class="form-horizontal form-groups-bordered">
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
			$query2 = "select * from staff_data WHERE staffid='$staff_id'";
			//echo $query2 ;
			$sno    = 1;
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
	<input type='hidden' name='main_id' value='<?php echo $msgid?>'>
		<table class="table table-bordered datatable">
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Member ID / Member Name</th>
					<th>Payment</th>
					<th>Session</th>
					<th>Join Date / Expiry Date </th>
				</tr>
			</thead>
			<tbody>
			<?php
			//$date  = date('Y-m');
			$query = "select * from trainer_pay WHERE id='$msgid'";
			//echo $query;
			$result = mysqli_query($con, $query);
			$sno    = 1;
				if (mysqli_affected_rows($con) != 0) {
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						//$stafid = $row['id'];
						$query21  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
						//echo $query2;
						$result21 = mysqli_query($con, $query21);
						$row21 = mysqli_fetch_array($result21, MYSQLI_ASSOC);
						
							$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
							$date2 = date('d-m-Y',strtotime( $row['expiry'] ));
							echo "<tr><td>" . $sno . "</td>";
							echo "<td><input type='hidden' name='member_id' value='".$row["member_id"]."'><input type='hidden' name='member_name' value='".$row["member_name"]."'>" . $row['member_id'] . " / " . $row['member_name'] . "</td>";
							echo "<td>" . $row['total'] . "</td>";
							echo "<td><input type='hidden' name='session_name' value='".$row21["name"]."'>" . $row21['name'] . "</td>";
							echo "<td><input type='hidden' name='session_from' value='".$date1."'><input type='hidden' name='session_to' value='".$date2."'>" . $date1 . " / " . $date2 . "</td>";
							$totol = $totol + $row['total'];
							$sno++;
							$stafid = 0;
					}
				}
			?>
			    <tr>
					<td></td>
					<td>Total Amount</td>
					<td><input type="text" name="total_amount" class="form-control" id="input" value="<?php echo $totol; ?>" readonly="readonly"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>Percentage</td>
					<td><input type="text" name="percentage" id="percent"  class="form-control"  value="<?php echo $percentage; ?>" ></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>Paid Amount</td>
					<td><input type="text" name="paid" id="output" class="form-control" readonly="readonly"></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td>Date</td>
					<td><!--<input type="text" name="paid_date" class="form-control datepicker" data-format="dd-mm-yyyy" required="required">-->
					<?php echo "<select name='day'>"; foreach($days as $valued) { if($valued == $currentDay){ $default = 'selected="selected"'; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; } else { $default=''; echo '<option '.$default.' value="'.$valued.'">'.$valued.'</option>\n'; }} echo '</select> &nbsp; ';
						echo "<select name='month'>"; foreach($months as $num => $name) { if($name==$currentMonth){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; } else { $default1 = ''; echo '<option '.$default1.' value="'.$num.'">'.$name.'</option>\n'; }} echo '</select> &nbsp; ';
						echo "<select name='year'>"; foreach($years as $valuey) { if($valuey==$currentYear){ $default1 = 'selected="selected"'; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';} else { $default1 = ''; echo '<option '.$default1.' value="'.$valuey.'">'.$valuey.'</option>\n';}} echo '</select>'; ?>
					</td>
					<td></td>
					<td></td>
				</tr>	
			</tbody>
		</table>
		<input type="hidden" name="trainer_id" class="form-control" value="<?php echo $row2['staffid']; ?>">
		<input type="hidden" name="trainer_name" class="form-control" value="<?php echo $row2['name']; ?>">
		<input type="hidden" name="designation" class="form-control" value="<?php echo $row2['designation'];?>">
		<input type="hidden" name="total_amount" class="form-control" value="<?php echo $totol;?>">
		<br />
		<div class="form-group">					 
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
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