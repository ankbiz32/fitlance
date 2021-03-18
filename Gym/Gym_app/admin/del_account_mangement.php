<?php
include 'db_conn.php';
$stafid = $_POST['name'];
if (strlen($stafid) > 0) {
    mysqli_query($con, "DELETE FROM expance WHERE id='$stafid'");
    echo "<html><head><script>alert('Expanse Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=account_mangement'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=account_mangement'>";
}
mysqli_close($con);
?>