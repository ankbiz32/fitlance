<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['p_id'])) {
    $name    = rtrim($_POST['name']);
    $days    = rtrim($_POST['days']);
    $rate    = rtrim($_POST['rate']);
    $p_id = $_POST['p_id'];
	$insert_by = $_SESSION['id'];
    mysqli_query($con, "INSERT INTO mem_types (mem_type_id,name,days,rate,insert_by)
VALUES ('$p_id','$name','$days','$rate','$insert_by')");
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
    
}
?>
