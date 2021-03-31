<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['invoice'])) {
    $memid = $_POST['invoice'];
	$query = "select * from trainer_pay WHERE invoice='$memid'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) != 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$member_id   = $row['member_id'];
				$member_name = $row['member_name'];
				$staff_id    = $row['staff_id'];
				$staff_name  = $row['staff_name'];
			}
		}
  $invoice = $_POST['invoice'];
  $paidamt    = rtrim($_POST['paid']);
  $total   = rtrim($_POST['total']);
  $lastamount = rtrim($_POST['lastamount']);
  $curr_date1 = rtrim($_POST['curr_date']);
  $paid     = $lastamount + $paidamt;
  $paybalance     = $total - $paid;
  $insert_by = $_SESSION['id'];
  $payment_method = rtrim($_POST['payment_method']);
  $cheque_no = rtrim($_POST['cheque_no']);
  $bank_id = rtrim($_POST['bank_id']);
  $curr_date = date('Y-m-d',strtotime($curr_date1));
  mysqli_query($con, "UPDATE trainer_pay SET paybalance='$paybalance',paid='$paid',total='$total',curr_date='$curr_date',payment_method='$payment_method',bank_id='$bank_id',cheque_no='$cheque_no',insert_by='$insert_by' WHERE invoice='$invoice'");
  //echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid_trainer'>";
} else {
  echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
  echo "<meta http-equiv='refresh' content='0; url=index.php?vis=unpaid_trainer'>";
    
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
    </script>
	</head>
	<body>
		<header>
			<a href="index.php?vis=unpaid_trainer"><h1>Invoice (Trainer Payment)</h1></a>
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
                <td><span><?php echo $curr_date1; ?></span></td>
              </tr>
			</table>	
			<table>
				<tr>
					<th>Trainer ID</th>
					<td><?php echo $staff_id; ?></td>
					<th>Trainer Name</th>
					<td><?php echo $staff_name; ?></td>
				</tr>
				<tr>
					<th>Member ID</th>
					<td><?php echo $member_id;?></td>
					<th>Member Name</th>
					<td><?php echo strtoupper($member_name);?></td>
				</tr>
			</table>
			<br>
			<table class="balance">
              <tr>
                <th><span>Total</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $total; ?></span></td>
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
                <th><span>Due</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paybalance; ?></span></td>
              </tr>
            </table>
		</article>
		<br>
		<center><h3>Website :  <b><?php echo $website;?></b></h3></center>
	</body>
</html>