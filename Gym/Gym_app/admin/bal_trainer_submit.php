<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['invoice'])) {
  $invoice = $_POST['invoice'];
  $paidamt    = rtrim($_POST['paid']);
  $total   = rtrim($_POST['total']);
  $lastamount = rtrim($_POST['lastamount']);
  $paid     = $lastamount + $paidamt;
  $bal     = $total - $paid;
  mysqli_query($con, "UPDATE dietpayment SET bal='$bal',paid='$paid',total='$total'  WHERE invoice='$invoice'");
  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid'>";
} else {
  echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid'>";
    
}
?>
