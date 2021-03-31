<?php
include 'db_conn.php';
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "UPDATE follow SET is_active ='0' WHERE id='$msgid'");
    echo "<html><head><script>alert('Follow up Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=follow_up'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=follow_up'>";
}
mysqli_close($con);

?>