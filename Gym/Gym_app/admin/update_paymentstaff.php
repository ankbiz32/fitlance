<?php
require 'db_conn.php';
page_protect();
session_start();
if (isset($_POST['id']) && isset($_POST['staff_id'])) {
	$id = $_POST['id'];
	$query  = "select * from staff_pay WHERE id='$id'";
	//echo $query;
	$result = mysqli_query($con, $query);
    if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $name      = $_POST['name'];
            $paid_date1 = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
            $total      = $_POST['total'];
            $paid       = $_POST['paid'];
            $paybalance = $total - $paid;
            $insert_by  = $_SESSION['id'];
            $paid_date = date('Y-m-d',strtotime($paid_date1));
        }
		mysqli_query($con, "UPDATE staff_pay SET paybalance='$paybalance',paid='$paid',total='$total',paid_date='$paid_date',insert_by='$insert_by' WHERE id='$id'");
		//print_r($_POST);
		echo "<head><script>alert('Payment updated :$name');</script></head></html>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_staff'>";
    }
    else{
		echo "<head><script>alert('Record not found');</script></head></html>";
        echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_staff'>";
    }
} 
else {
    echo "<head><script>alert('Some error occured, Check Again');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_staff'>";
}

?>
