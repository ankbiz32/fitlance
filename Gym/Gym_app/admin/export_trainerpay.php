<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from trainer ORDER BY trainer_name DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Name / Staff ID</th>
		<th>Designation</th>
		<th>Total Amount</th>
		<th>Percentage</th>
		<th>Paid Amount</th>
		<th>Paid Date </th>
		</tr>
  ';
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$msgid = $row['invoice'];
			$query3 = "select * from designation WHERE id='".$row['designation']."'";
			//echo $query3; 
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
			$date = date('d-m-Y',strtotime( $row['paid_date'] ));
   $output .= '
    <tr> 
	<td>'.$row["trainer_name"]. " / " .$row["trainer_id"].'</td> 
	<td>'.$row3["name"].'</td>
	<td>'.$row["total_amount"].'</td>
	<td>'.$row["percentage"].'</td>
	<td>'.$row["paid"].'</td>
	<td>'.$date.'</td>
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
