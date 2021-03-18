<?php
include 'db_conn.php';
page_protect();
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "DELETE FROM healthstatus WHERE id='$msgid'");
    echo "<html><head><script>alert('Health Status Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_health'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_health'>";
}
?>

