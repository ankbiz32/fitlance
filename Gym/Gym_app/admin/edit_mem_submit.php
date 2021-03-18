<?php
require 'db_conn.php';
page_protect();
    if (isset($_POST['p_id'])) {
		$mem_type = $_POST['mem_type'];
		$query1 = "select * from mem_types WHERE mem_type_id='$mem_type'";
		$result1 = mysqli_query($con, $query1);
		if (mysqli_affected_rows($con) == 1) {
			while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				$name_type = $row1['name'];
				$details   = $row1['details'];
				$days      = $row1['days'];
				$rate      = $row1['rate'];
			}
		}
    $invoice      = rtrim($_POST['invoice']);
		$joindate2    = $_POST['dayj'].'-'.$_POST['monthj'].'-'.$_POST['yearj'];
		$joindate1    = date('d-m-Y',strtotime($joindate2));
		$workout_time = rtrim($_POST['workout_time']);
		$full_name    = rtrim($_POST['p_name']);
		$email        = rtrim($_POST['email']);
		$address      = rtrim($_POST['add']);
		$zipcode      = rtrim($_POST['zipcode']);    
		$birthdate2   = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$birthdate1   = date('d-m-Y',strtotime($birthdate2));
		$contact      = rtrim($_POST['contact']);
		$sex          = rtrim($_POST['sex']);
		$activity     = rtrim($_POST['activity']);
		$curr_date    = date('Y-m-d');
		$landline     = rtrim($_POST['landline']);
		$mod_date     = strtotime($joindate1 . "+ $days days");
		$expiry       = date("Y-m-d", $mod_date);
		$wait         = "no";
		$time         = $days * 86400;
		$exp_time     = $time + strtotime($joindate1);
		$insert_by    = $_SESSION['id']; 
		$bank_id      = $_POST['bank'];
		$payment_method = $_POST['payment_method'];
		$chequeno     = $_POST['chequeno'];
		$dis          = $_POST['dis'];
		$total        = $_POST['total'];
		$paid         = $_POST['paid'];
		$bal          = $_POST['bal'];
		
		$joindate     = date('Y-m-d',strtotime($joindate1));
		$birthdate    = date('Y-m-d',strtotime($birthdate1));
		$date1        = date('d-m-Y',strtotime($curr_date));
		$p_id         = $_POST['p_id'];
		
		mysqli_query($con, "UPDATE user_data SET name='$full_name',address='$address',zipcode='$zipcode',birthdate='$birthdate',contact='$contact',email='$email',curr_date='$curr_date',landline='$landline',joining='$joindate',workout_time_id='$workout_time',sex='$sex' WHERE newid=$p_id");
		
		$to_date1     = strtotime($to_date);
		$expiry       = $expiry ;
		$expiry1      = date('d-m-Y',strtotime( $expiry ));
		$total = $total - $dis;
			
		mysqli_query($con, "UPDATE subsciption SET sub_type='$mem_type',sub_type_name='$name_type',paid_date='$joindate',total='$total',dis='$dis',paid='$paid',bal='$bal',expiry='$expiry',payment_method='$payment_method',cheque_no='$chequeno',bank_id='$bank_id',pay_date='$curr_date' WHERE mem_id=$p_id AND invoice='".$invoice."'");
		mysqli_query($con, "UPDATE payment SET sub_type='$mem_type',sub_type_name='$name_type',total='$total',dis='$dis',paid='$paid',bal='$bal',expiry='$expiry',payment_method='$payment_method',cheque_no='$chequeno',bank_id='$bank_id',pay_date='$curr_date' WHERE mem_id=$p_id AND invoice='".$invoice."'");
		//echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
	} else {
		echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
	}
	$query2 = "select * from card ";
	//echo $query2;
	$result2 = mysqli_query($con, $query2);
	if (mysqli_affected_rows($con) != 0) {
		while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
			$name_company = $row2['name'];
			$email_company = $row2['email'];
			$address_company = $row2['address'];
			$mobile_company = $row2['mobile'];
			$website = $row2['website'];
			$img_location = $row2['img_location'];
		}
	}
?>
<!doctype html>
	<head>
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="style.css">
		<script src="script.js"></script>
 		<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
    	<script type="text/javascript" src="jquery-barcode.js"></script>
    	<script type="text/javascript">
      function generateBarcode(){
        var value = "<?php echo $invoice;?>";
        var btype = "code128";
        var renderer = "css";
		var quietZone = false;
        if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')){
          quietZone = true;
        }
        var settings = {
          output:renderer,
          bgColor: $("#bgColor").val(),
          color: $("#color").val(),
          moduleSize: $("#moduleSize").val(),
          posX: $("#posX").val(),
          posY: $("#posY").val(),
          addQuietZone: $("#quietZoneSize").val()
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
        } else {
          $("#canvasTarget").hide();
          $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
      }
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }
      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }
      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
      });
      function printbody() {
    		window.print();
		}
    </script>
	</head>
	<body>
	    <a href="javascript:void();" onClick="printbody()">Print</a> | <?php echo "<form action='index.php?vis=edit_member' method='post' id='hed'><input type='hidden' name='name' value='" . $p_id . "'/><button type='submit' class='hed_btn'>Back</button></form>" ?>
		<header>
			<a href="index.php?vis=view_mem"><h1>Invoice (New Registration)</h1></a>
			<address>
				<p><?php echo $name_company; ?></p>
				<p style="width: 230px;"><?php echo $address_company;?></p>
				<p>Phone : <?php echo $mobile_company;?></p><p>Email : <?php echo $email_company;?></p><br>
			</address>
            <span><img src="<?php echo $img_location; ?>" width="150px"></span>
        </header>
        <article>
		   <div id="barcodeTarget" class="barcodeTarget" style="width:100px; height:100px;"></div><canvas id="canvasTarget"></canvas>
            <table class="meta">
              <tr>
                <th><span>Invoice #</span></th>
                <td><span><?php echo $invoice; ?></span></td>
              </tr>
              <tr>
                <th><span>Date</span></th>
                <td><span><?php echo $date1; ?></span></td>
              </tr>
              <tr>
                <th><span>Inserted By</span></th>
                <td><span><?php $query  = "select * from auth_user WHERE id=$insert_by";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					echo $row['name']; ?></span></td>
              </tr>
			</table>	
            <table>
               <tr>
				<th>Member ID</th>
				<td><?php echo $p_id;?></td>
				<th>Name</th>
				<td><?php echo $full_name;?></td>
              </tr>
			  <tr>
				<th>Email</th>
				<td><?php echo $email;?></td>
				<th>Join Date</th>
				<td><?php echo $joindate1;?></td>
              </tr>
              <tr>
				<th>Address</th>
				<td><?php echo $address;?></td>
				<th>Pin Code</th>
				<td><?php echo $zipcode;?></td>
              </tr>
              <tr>
				<th>Birth Date</th>
				<td><?php echo $birthdate1;?></td>
				<th><span>Gender</span></th>
				<td><span><?php echo $sex; ?></span></td>
              </tr>
              <tr>
				<th><span>Preferred Workout Time</span></th>
				<td><span><?php $query2  = "select * from workout_time WHERE id=$workout_time";
					$result2 = mysqli_query($con, $query2);
					$row2 = mysqli_fetch_assoc($result2);
					echo $row2['name']; ?></span></td>
				<th><span>Membership Type</span></th>
				<td><span><?php echo $name_type; ?></span></td>
              </tr>
			  <tr>
				<th><span>Renewal Date</span></th>
				<td><span><?php echo $expiry1; ?></span></td>
				<th><span>Cheque No :</span></th>
				<td><span><?php echo $chequeno; ?></span></td>
              </tr>
			  <tr>
			    <th><span>Mobile No :</span></th>
				<td><span><?php echo $contact; ?></span></td>
				<th><span>Bank Name</span></th>
				<td><span><?php $query3  = "select * from bank_name WHERE id=$bank_id";
					$result3 = mysqli_query($con, $query3);
					$row3 = mysqli_fetch_assoc($result3);
					echo $row3['bank_name']; ?></span></td>
              </tr>
            </table>
			<table class="balanceleft" style="float:left;width:50%;">
              <tr>
                <th><span>Membership Period</span></th>
                <td><span><?php echo $joindate1.' To '.$expiry1; ?></span></td>
              </tr>
            </table>
            <table class="balance">
              <tr>
                <th><span>Total</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $rate; ?></span></td>
              </tr>
			  <tr>
                <th><span>Discount</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $dis;?></span></td>
              </tr>
			  <tr>
                <th><span>Payment Mode</span></th>
                <td><span><?php echo $payment_method; ?></span></td>
              </tr>
              <tr>
                <th><span>Paid</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
              </tr>
              <tr>
                <th><span>Balance</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $bal; ?></span></td>
              </tr>
            </table>
		</article>
		<br>
		<center><h3>Website : <b><?php echo $website;?></b></h3></center>
	</body>
</html>
<style>
#hed {
display: inline-block;
}
.hed_btn {
background: transparent;
}
</style>
