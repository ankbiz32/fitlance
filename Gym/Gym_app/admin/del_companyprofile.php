<?php
include 'db_conn.php';
$id = $_POST['name'];
if (strlen($id) > 0) {
    mysqli_query($con, "DELETE FROM card WHERE id='$id'");
    echo "<html><head><script>alert('Company profile Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=company'>";
}
mysqli_close($con);
?>

