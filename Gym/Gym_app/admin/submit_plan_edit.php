<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['p_id'])) {
    
    $name    = rtrim($_POST['name']);
    $days    = rtrim($_POST['days']);
    $rate    = rtrim($_POST['rate']);
    $p_id = $_POST['p_id'];
    $insert_by = $_SESSION['id'];
    mysqli_query($con, "UPDATE mem_types SET name='$name', rate='$rate', days='$days',insert_by='$insert_by' WHERE mem_type_id='$p_id'");
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
    
}
?>
