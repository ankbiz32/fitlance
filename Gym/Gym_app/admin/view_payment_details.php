<?php 
if (isset($_POST['name'])) { ?>
<b>Details of : -  <?php
$invoice     = $_POST['name'];
$query  = "select * from subsciption WHERE invoice='$invoice'";
//echo $query;
$result = mysqli_query($con, $query);
	if (mysqli_affected_rows($con) != 0) {
	  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$mem_id = $row['mem_id'];
		//echo strtoupper($mem_id);
		$query1  = "select * from user_data WHERE newid='$mem_id'";
		$result1 = mysqli_query($con, $query1);
		  if (mysqli_affected_rows($con) == 1) {
			while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				$name = $row['name'];
		        echo strtoupper($name);
			}
		  } 
      }
	}
?></b>
<hr />
<h4>Payment Information:</h4>
<hr />
<table class="table table-bordered table-striped">
	<tr>
		<th><b>Payment Date</b></th>
		<th><b>Membership Type / Rate</b></th>
		<th><b>Discount</b></th>
		<th><b>Total / Paid</b></th>
		<th><b>Balance</b></th>
		<th><b>Payment Method</b></th>
	</tr>
	<?php
	$query  = "select * from payment WHERE invoice='$invoice'";
	$result = mysqli_query($con, $query);
	$sno    = 1;
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$query1 = "select * from mem_types where mem_type_id ='".$row['sub_type']."'";
		$result1 = mysqli_query($con, $query1);
		$row1 = mysqli_fetch_array($result1);
		$date1 = date('d-m-Y',strtotime( $row['pay_date'] ));
		echo'<tr>';
		echo"<td>". $date1 ."</td>";
		echo"<td>".$row1['name'].  " / " .  $row1['rate'] . "</td>";"</td>";
		echo"<td>".$row['dis']."</td>";
		echo"<td>".$row['total']. " / " .$row['paid']."</td>";
		echo"<td>".$row['bal']."</td>";
		echo"<td>".$row['payment_method']."</td>";
		echo'</tr>';
		$sno++;
	}
	?>
</table>

<button type="button" class="btn btn-secondary" onclick="history.back()">← Go back</button>	
<?php
} else {
  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=payments'>";
}
?>