<?php
include 'db_conn.php';
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "DELETE FROM subsciption WHERE invoice='$msgid'");
    mysqli_query($con, "DELETE FROM payment WHERE invoice='$msgid'");
    echo "<html><head><script>alert('Invoice Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
mysqli_close($con);

?>