<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from trainer_pay ORDER BY member_name DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Member Name / Member ID</th>
		<th>Trainer Name / Trainer ID</th>
        <th>Join Date </th>
        <th>Total / Paid</th>
		<th>Balance</th>
		<th>Session / Insert By</th>
		<th>Invoice</th>
		</tr>
  ';
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    $stafid = $row['id'];
			$id = $row['insert_by'];
			$query11  = "select * from auth_user WHERE id='$id'";
			$result11 = mysqli_query($con, $query11);
			$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
			$query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
					$name = $row11['name'];
					$msgid = $row['invoice'];
					$date1 = date('d-m-Y',strtotime( $row['join_date'] ));
   $output .= '
    <tr> 
	<td>'.$row["member_name"]. " / " .$row["member_id"].'</td> 
	<td>'.$row["staff_name"]. " / " .$row["staff_id"].'</td>
	<td>'.$date1.'</td>
	<td>'.$row2["name"]. " / " .$row11["name"].'</td>
	<td>'.$row["total"]. " / " .$row["paid"].'</td>
	<td>'.$row["paybalance"].'</td>
	<td>'.$row["invoice"].'</td>
    </tr>
   ';
  } 
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
