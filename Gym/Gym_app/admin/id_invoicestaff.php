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
			<a href="index.php?vis=staff_details"><img src="<?php echo $img_location; ?>"></a>
			</div>
			<h2><?php echo $name;?></h2>
			<h3>Mobile:<?php echo $contact;?></h3>
			<div class="qr-code">
				<img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&size=100x100" alt="" title="HELLO" width="50" height="50" />
			</div>
			<h3><?php echo $website; ?></h3>
			<hr>
			<p><?php echo $address;?></p>
			<p>Ph: <?php echo $mobile;?> | Email: <?php echo $email;?></p>

		</div>
	</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
function generateBarCode()
{
//var nric = $('#text').val();
var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + nric + '&size=50x50';
$('#barcode').attr('src', url);
}
</script>
<style>
body {
	background-color: #d7d6d3;
	font-family:'verdana';
}
.id-card-holder {
	width: 245px;
	padding: 4px;
	margin: 0 auto;
	border-radius: 5px;
	position: relative;
}
.id-card {
	background-color: #fff;
	padding: 10px;
	border-radius: 10px;
	text-align: center;
	box-shadow: 0 0 1.5px 0px #b9b9b9;
}
.id-card img {
	margin: 0 auto;
}
.header img {
	width: 100px;
	margin-top: 15px;
}
.photo img {
	width: 80px;
	margin-top: 15px;
}
h2 {
	font-size: 15px;
	margin: 5px 0px;
}
h3 {
	font-size: 12px;
	margin: 7px 0px;
	font-weight: 300;
}
.qr-code img {
	width: 50px;
}
p {
	font-size: 8px;
	margin: 2px;
}
.id-card-tag-strip {
	width: 0px;
	height: 40px;
   
}
</style>