<?php
include 'db_conn.php';
$msgid = $_POST['name'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "UPDATE user_data SET is_active ='1' WHERE newid='$msgid'");
    mysqli_query($con, "UPDATE subsciption SET is_active ='1' WHERE mem_id='$msgid'");
    mysqli_query($con, "UPDATE freeze SET is_active ='1' WHERE mem_id='$msgid'");
    mysqli_query($con, "UPDATE payment SET is_active ='1' WHERE mem_id='$msgid'");
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem_inactive'>";
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem_inactive'>";
}
mysqli_close($con);

?>