<?php
include 'db_conn.php';
$stafid = $_POST['name'];
if (strlen($stafid) > 0) {
    mysqli_query($con, "DELETE FROM trainer_types WHERE staff_type_id='$stafid'");
    echo "<html><head><script>alert('trainer plan Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_tranier_plan'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_tranier_plan'>";
}
mysqli_close($con);
?>