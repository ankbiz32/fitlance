<?php
require 'db_conn.php';
page_protect();

if (isset($_POST['p_id'])) {
    if($_POST['is_combo']){
        $combo='1';
    }else{
        $combo='0';
    }
    $name    = rtrim($_POST['name']);
    $days    = rtrim($_POST['days']);
    $rate    = rtrim($_POST['rate']);
    $p_id = $_POST['p_id'];
	$branch_id = $_SESSION['branch_id'];
	$insert_by = $_SESSION['id'];
    mysqli_query($con, "INSERT INTO mem_types (mem_type_id,name,days,rate,is_combo,insert_by,branch_id)
VALUES ('$p_id','$name','$days','$rate','$combo','$insert_by','$branch_id')");
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_plan'>";
    
}
?>
