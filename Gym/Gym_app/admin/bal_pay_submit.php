<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['invoice'])) {
	$memid = $_POST['name'];
	$query = "select * from subsciption WHERE name='$memid'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			  $msgid = $row['mem_id'];
				$sub_type = $row['sub_type'];
				$sub_type_name = $row['sub_type_name'];
				$total         = $row['total'];
				$paid          = $row['paid'];
				$dis           = $row['dis'];
				$expiry        = $row['expiry'];
				$date          = $row['paid_date'];
				$bank_id = $row['bank_id'];
				$cheque_no = $row['cheque_no'];
				$payment_method = $row['payment_method'];
				$expiry1 = date('d-m-Y',strtotime($expiry));
				$query11 = "select * from mem_types WHERE mem_type_id='$sub_type'";
				//echo $query11;
				$result11 = mysqli_query($con, $query11);
				$row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC);
				$rate = $row11['rate'];
				$query1 = "select * from user_data WHERE newid='$msgid'";
				//echo $query1;
				$result1 = mysqli_query($con, $query1);
				if (mysqli_affected_rows($con)!= 0) {
					while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
						$mem_id  = $row1['newid'];
						$sex    = $row1['sex'];
						$email = $row1['email'];
						$name  = $row1['name'];
						$address = $row1['address'];
						$birthdate = $row1['birthdate'];
						$zipcode = $row1['zipcode'];
						$contact = $row1['contact'];
						$joindate = $row1['joining'];
						$workout_time_id = $row1['workout_time_id'];
						$joindate1 = date('d-m-Y',strtotime($joindate));
						$birthdate1 = date('d-m-Y',strtotime($birthdate));
					}
				}
			}
		}


	$invoice = $_POST['invoice'];
	$msgid    = rtrim($_POST['mem_id']);
	$full_name   = rtrim($_POST['name']);
	$sub_type = rtrim($_POST['sub_type']);
	$sub_type_name   = rtrim($_POST['sub_type_name']);
	$paidamt    = rtrim($_POST['paid']);
	$total   = rtrim($_POST['total']);
	$lastamount = rtrim($_POST['lastamount']);
	$pay_date2 =  $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	$pay_date1 = date('d-m-Y',strtotime($pay_date2));
	$paid     = $lastamount + $paidamt;
	$bal     = $total - $paid;
	$insert_by = $_SESSION['id'];
	$payment_method = rtrim($_POST['payment_method']);
	$cheque_no = rtrim($_POST['cheque_no']);
	$bank_id = rtrim($_POST['bank_id']);
	$pay_date = date('Y-m-d',strtotime($pay_date1));

	mysqli_query($con, "UPDATE subsciption SET bal='$bal',paid='$paid',total='$total',pay_date='$pay_date',payment_method='$payment_method',bank_id='$bank_id',cheque_no='$cheque_no',insert_by='$insert_by' WHERE invoice='$invoice'");

	mysqli_query($con, "INSERT INTO payment (mem_id,bank_id,name,sub_type,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,payment_method,cheque_no,renewal,pay_date,insert_by)
	VALUES ('$msgid','$bank_id','$full_name','$sub_type','$total','$paidamt','$dis','$total_dis','$expiry','$invoice','$sub_type_name','$bal','$payment_method','$cheque_no','no','$pay_date','$insert_by')");
	//print_r($_POST);
	
} else {
echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid'>";

}
 $query2 = "select * from card where branch_id = '$_SESSION[branch_id]' ";
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
	    <a href="javascript:void();" onClick="printbody()">Print</a> 
	    <header>
			<a href="index.php?vis=unpaid"><h1>Invoice (Payment)</h1></a>
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
                <td><span><?php echo $pay_date1; ?></span></td>
              </tr>
              <tr>
                <th><span>Inserted By</span></th>
                <td><?php $query  = "select * from auth_user WHERE id=$insert_by";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					echo $row['name']; ?></span></td>
              </tr>
			</table>	
            <table>
               <tr>
				<th>Member ID</th>
				<td><?php echo $msgid;?></td>
				<th>Name</th>
				<td><?php echo $name;?></td>
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
				<td><span><?php $query2  = "select * from workout_time WHERE id=$workout_time_id";
					$result2 = mysqli_query($con, $query2);
					$row2 = mysqli_fetch_assoc($result2);
					echo $row2['name']; ?></span></td>
				<th><span>Membership Type</span></th>
				<td><span><?php echo $sub_type_name; ?></span></td>
              </tr>
			  <tr>
				<th><span>Renewal Date</span></th>
				<td><span><?php echo $expiry1; ?></span></td>
				<th><span>Cheque No :</span></th>
				<td><span><?php echo $cheque_no; ?></span></td>
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
