<?php
include 'db_conn.php';
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "DELETE FROM designation WHERE id='$msgid'");
    echo "<html><head><script>alert('Designation Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=designation_details'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=designation_details'>";
}
mysqli_close($con);
?>