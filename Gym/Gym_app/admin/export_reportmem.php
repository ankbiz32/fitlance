<?php
require 'db_conn.php';
$output = '';
if(isset($_POST["export"]))
{
 $query  = "select * from user_data ORDER BY name DESC";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
		<tr>  
		<th> Member ID</th>
		<th> Member Name</th>
		</tr>
  ';
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$msgid = $row['newid'];
   $output .= '
    <tr> 
	<td>'.$row["newid"].'</td> 
	<td>'.$row["name"].'</td>
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
