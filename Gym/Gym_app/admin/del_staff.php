<?php
include 'db_conn.php';
$stafid = $_POST['name'];
if (strlen($stafid) > 0) {
    mysqli_query($con, "UPDATE staff_data SET is_active ='0' WHERE staffid='$stafid'");
    echo "<html><head><script>alert('Staff Member Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
}
mysqli_close($con);
?>