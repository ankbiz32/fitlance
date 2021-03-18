<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
  $query = "select * from subsciption WHERE bal>0 ORDER BY bal DESC";
  $result = mysqli_query($con, $query);
  $income = 0;
    if (mysqli_affected_rows($con) != 0) {
 //$query  = "select * from user_data ORDER BY joining DESC";
 //$result = mysqli_query($con, $query);
// if(mysqli_num_rows($result) > 0)
 //{
   $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Invoice</th>
		<th>Name / Member ID</th>
		<th>Contact</th>
		<th>Plan Name / Rate</th>
		<th>Discount / Total</th>
		<th>Paid / Balance</th>
		<th>Join Date / Expiry Date</th>
		<th>Date of Payment</th>
		<th>Action</th>
		</tr>
    ';
		 
	    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$msgid   = $row['mem_id'];
		$sub_type = $row['sub_type'];
		$query1  = "select * from user_data WHERE newid='$msgid'";
		$result1 = mysqli_query($con, $query1);
			if (mysqli_affected_rows($con) == 1) {
				while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				$query11 = "select * from mem_types WHERE mem_type_id='$sub_type'";
				//echo $query11;
				$result11 = mysqli_query($con, $query11);
				$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));
				$date3 = date('d-m-Y',strtotime( $row['pay_date'] ));
			    $output .= '
			    <tr> 
			    <td>'. $row['invoice'] .'</td> 
			    <td>'. $row['name']. " / " .  $msgid.'</td> 
			    <td>'. $row1['contact'] .'</td>
			    <td>'. $row['sub_type_name'] .  " / " .  $row11['rate'] .'</td>
			    <td>'. $row['dis'] . " / " . $row['total'] .'</td>
				<td>'. $row['paid'] . " / ". $row['bal'] . '</td>
				<td>'. $date1 . " / " . $date2 .'</td>
				<td>'. $date3 .'</td>
			    </tr>
		        ';
				}
			}
	    }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
