<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from staff_data  ORDER BY name DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Name / Staff ID</th>
        <th>Email / Join Date </th>
        <th>Address / Contact</th>
        <th>Designation </th>
		<th>Insert By</th>
		</tr>
  ';
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		    $id = $row['insert_by'];
		    $query2 = "select * from auth_user WHERE id='$id'";
			$result2 = mysqli_query($con, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			$idd = $row['designation'];
		    $query3 = "select * from designation WHERE id='$idd'";
			$result3 = mysqli_query($con, $query3);
			$row3 = mysqli_fetch_assoc($result3);
			$stafid = $row['staffid'];
			$date1 = date('d-m-Y',strtotime( $row['date'] ));
   $output .= '
    <tr> 
	<td>'.$row["name"]. " / " .$stafid.'</td> 
	<td>'.$row["email"]. " / " .$date1.'</td>
	<td>'.$row["address"]. " / " .$row["mobile"].'</td>
	<td>'.$row3["name"].'</td>
	<td>'.$row2["name"].'</td>
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
