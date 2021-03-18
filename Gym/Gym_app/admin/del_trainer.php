<?php
include 'db_conn.php';
$stafid = $_POST['name'];
$urlredirect = $_POST['redirect'];
if (strlen($stafid) > 0) {
    mysqli_query($con, "DELETE FROM trainer_pay WHERE id='$stafid'");
    echo "<html><head><script>alert('trainer Deleted');</script></head></html>";
    if($urlredirect == 'detalis'){
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_details'>";
    }else{
        echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_lists'>";
    }
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
    if($urlredirect == 'detalis'){
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_details'>";
    }else{
        echo "<meta http-equiv='refresh' content='0; url=index.php?vis=trainer_lists'>";
    }
   
}
mysqli_close($con);
?>