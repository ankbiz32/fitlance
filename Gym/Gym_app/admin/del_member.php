<?php
include 'db_conn.php';
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "UPDATE user_data SET is_active ='0', is_deleted ='1' WHERE newid='$msgid'");
    mysqli_query($con, "UPDATE subsciption SET is_active ='0', is_deleted ='1' WHERE mem_id='$msgid'");
    mysqli_query($con, "UPDATE freeze SET is_active ='0' WHERE mem_id='$msgid'");
    mysqli_query($con, "UPDATE payment SET is_active ='0' WHERE mem_id='$msgid'");
    echo "<html><head><script>alert('Member Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
}
mysqli_close($con);

?>