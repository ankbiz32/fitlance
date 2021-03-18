<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from expance ORDER BY id DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th>Item</th>
		<th>Price</th>
		<th>Date</th>
		</tr>
  ';
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$msgid = $row['id'];
	$date = $row['date'];
	$date1 = date('d-m-Y', strtotime( $row['date'] ));
   $output .= '
    <tr> 
	<td>'.$row["item"].'</td> 
	<td>'.$row["price"].'</td>
	<td>'.$date1.'</td>
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
