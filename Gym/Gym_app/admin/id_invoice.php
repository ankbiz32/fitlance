<?php
require 'db_conn.php';
if (isset($_POST['name'])) {
      $newid = $_POST['name'];
	  $query  = "select * from user_data WHERE newid ='$newid'";
	  //echo $query;
	  $result = mysqli_query($con, $query);
      if (mysqli_affected_rows($con) == 1) {
         while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				   $newid    = $row['newid'];
				   $name     = $row['name'];
				   $contact  = $row['contact'];
		   }
		 }
	 $query2 = "select * from card ";
	 //echo $query2;
     $result2 = mysqli_query($con, $query2);
     if (mysqli_affected_rows($con) != 0) {
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $name_company = $row2['name'];
            $email = $row2['email'];
            $address = $row2['address'];
			$mobile = $row2['mobile'];
			$website = $row2['website'];
            $img_location = $row2['img_location'];
        }
     }

}else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
    
}
?>
<div class="id-card-tag-strip"></div>
<div class="id-card-hook"></div>
<div class="id-card-holder">
	<div class="id-card">
		<div class="header">
		<h2 style="color:#0062C4; font-size:18px;"><?php echo $name_company;?></h2>
		<a href="index.php?vis=view_mem"><img src="<?php echo $img_location; ?>"></a>
		</div>
		<h2><?php echo $name;?></h2>
		<h3>Mobile:<?php echo $contact;?></h3>
		<div class="qr-code">
			<img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $newid;?>&size=100x100" alt="" title="HELLO" width="50" height="50" />
		</div>
		<h3><?php echo $website; ?></h3>
		<hr>
		<p><?php echo $address;?></p>
		<p>Ph: <?php echo $mobile;?> | Email: <?php echo $email;?></p>

	</div>
</div>
<link rel="stylesheet" href="qr.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

