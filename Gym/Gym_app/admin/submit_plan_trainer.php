<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['staff_type_id'])) {
    
    $name   = rtrim($_POST['name']);
    $day    = rtrim($_POST['day']);
    $time   = rtrim($_POST['time']);
    $staff_type_id = $_POST['staff_type_id'];
    $insert_by = $_SESSION['id'];
    mysqli_query($con, "INSERT INTO trainer_types (staff_type_id,name,day,time,insert_by)VALUES('$staff_type_id','$name','$day','$time','$insert_by')");
    //print_r($_POST);
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_tranier_plan'>";
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_tranier_plan'>";
    
}
?>