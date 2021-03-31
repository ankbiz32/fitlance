<?php
require 'db_conn.php';
session_start();
if (isset($_POST['name'])) {
	$urlredirect = $_POST['redirect'];
    $invoice = $_POST['name'];
    $query = "select * from trainer_pay WHERE invoice='$invoice'";
	//echo $query;
    $result = mysqli_query($con, $query);
    if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $member_id   = $row['member_id'];
            $member_name = $row['member_name'];
            $staff_id    = $row['staff_id'];
            $staff_name  = $row['staff_name'];
            $trainer_type_id = $row['trainer_type_id'];
			$payment_method = $row['payment_method'];
            $bank_id     = $row['bank_id'];
			$join_date   = $row['join_date'];
			$cheque_no   = $row['cheque_no'];
			$total       = $row['total'];
			$paid        = $row['paid'];
			$paybalance  = $row['paybalance'];
			$insert_by   = $row['insert_by'];
			$join_date1 = date('d-m-Y',strtotime( $join_date ));
        }
    }
	$query3 = "select * from trainer_types WHERE staff_type_id='$trainer_type_id'";
	//echo $query3;
    $result3 = mysqli_query($con, $query3);
    if (mysqli_affected_rows($con) == 1) {
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $time  = $row3['time'];
        }
    }
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
    
}
 $query2 = "select * from card where branch_id='$_SESSION[branch_id]' ";
//  echo $query2;exit;
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
	    <a href="javascript:void();" onClick="printbody()">Print</a> | <?php if($urlredirect == 'detalis'){ ?> <a href="index.php?vis=trainer_details">Back</a> <?php }else{ ?>
        <a href="index.php?vis=trainer_list">Back</a> <?php } ?> 
		<header>
			<a href="index.php?vis=trainer_details"><h1>Invoice (Trainer Assign)</h1></a>
			<address>
				<p><?php echo $name_company; ?></p>
				<p style="width: 230px;"><?php echo $address_company;?></p>
				<p>Phone : <?php echo $mobile_company;?></p><p>Email : <?php echo $email_company;?></p><br>
			</address>
            <span><img src="<?php echo $img_location; ?>" width="150px"></span>
            </header>
		<article>
		<div id="barcodeTarget" class="barcodeTarget" style="width:100px; height:100px;"></div> <canvas id="canvasTarget"></canvas></span>
			<table class="meta">
				<tr>
					<th><span>Invoice #</span></th>
					<td><span><?php echo $invoice; ?></span></td>
				</tr>
				<tr>
					<th><span>Date</span></th>
					<td><span><?php echo $join_date1; ?></span></td>
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
					<td><?php echo $member_id;?></td>
					<th>Member Name</th>
					<td><?php echo strtoupper($member_name);?></td>
				</tr>
				<tr>
					<th>Trainer ID</th>
					<td><?php echo $staff_id;?></td>
					<th>Trainer Name</th>
					<td><?php echo strtoupper($staff_name);?></td>
				</tr>
				<tr>
				<th>Session Slot</th>
				<td><?php echo $time; ?></td>
				<th>Cheque No</th>
				<td><?php echo $cheque_no;?></td>
				</tr>
				<tr>
				<th>Bank Name</th>
				<td><?php $query3  = "select * from bank_name WHERE id=$bank_id";
					$result3 = mysqli_query($con, $query3);
					$row3 = mysqli_fetch_assoc($result3);
					echo $row3['bank_name']; ?></td>
				</tr>
			</table>
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
			<br><br><br><br>
		</article>
		<br>
	<header>
			<address style="font-size:16px;">
				<h2>Customer Signature</h2>
			</address>
		<span><p>For  <?php echo $name_company; ?></p></span>	 
    </header>
		<br>
		<center><h3>Website : <b><?php echo $website;?></b></h3></center>
	</body>
</html>
