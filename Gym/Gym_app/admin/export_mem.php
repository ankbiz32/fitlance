<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from user_data ORDER BY joining DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Membership Expiry</th>
		<th>Name / Member ID</th>
		<th>Address / Contact</th>
		<th>Join Date / Plan</th>
		<th>Total / Paid</th>
		<th>Balance</th>
		<th>Gender / Workout Time</th>
		</tr>
  ';
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		  $msgid   = $row['newid'];
		  $id = $row['insert_by'];
		  $query11  = "select * from auth_user WHERE id='$id'";
		  //echo $query11;
		  $query2  = "select * from workout_time WHERE id='".$row['workout_time_id']."'";
		  $result2 = mysqli_query($con, $query2);
		  $row2 = mysqli_fetch_assoc($result2);
		  $result11 = mysqli_query($con, $query11);
			if (mysqli_affected_rows($con) == 1) {
			  while ($row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC)) {
			  $name = $row11['name'];
			  
			  $query1  = "select * from subsciption WHERE mem_id='$msgid' AND renewal='yes'";
			  $result1 = mysqli_query($con, $query1);
			  $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
			  $date1 = date('d-m-Y',strtotime( $row1['expiry'] ));
			  $date2 = date('d-m-Y',strtotime( $row['joining'] ));
			 // echo "<tr><td>" . $date1 . "</td>";
			  $expiry        = $row1['expiry'];
			  $sub_type_name = $row1['sub_type_name'];
   $output .= '
    <tr> 
	<td>'.$date1.'</td> 
	<td>'.$row["name"]. " / " .$row["newid"].'</td> 
	<td>'.$row["address"]. " / " .$row["contact"].'</td>
	<td>'.$date2. " / " .$row1["sub_type_name"].'</td>
	<td>'.$row1["total"]. " / " .$row1["paid"].'</td>
	<td>'.$row1["bal"].'</td>
	<td>'.$row["sex"]. " / " .$row2["newid"].'</td>
    </tr>
   ';
  } } } 
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}
?>
