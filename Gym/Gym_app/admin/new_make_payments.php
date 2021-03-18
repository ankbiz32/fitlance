<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['p_id']) && isset($_POST['mem_type']) && isset($_POST['total']) && isset($_POST['paid'])) {
	function getRandomWord($len = 3)
	{
		$word = array_merge(range('a', 'z'), range('0', '9'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}
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
	$invoice   = substr(time(), 2, 10) . getRandomWord();
	$query2 = "select * from subsciption WHERE invoice=".$invoice;
	$result2 = mysqli_query($con, $query2);
	if (mysqli_num_rows($result2) == 0){
		$p_id = $_POST['p_id'];
		$full_name = $_POST['p_name'];
		$paiddate3 = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	    $paiddate2 = date('d-m-Y',strtotime($paiddate3));
		$pay_date2 = $_POST['dayp'].'-'.$_POST['monthp'].'-'.$_POST['yearp'];
	    $pay_date1 = date('d-m-Y',strtotime($pay_date2));
		$total     = $_POST['total'];
		$paid      = $_POST['paid'];
		$dis       = $_POST['dis'];
		$insert_by = $_SESSION['id']; 
		$bank_id = $_POST['bank'];
		$paymentdata= $_POST['paymentdata'];
		$chequeno= $_POST['chequeno'];
		$total = $total - $dis;
		$curr_date = date('Y-m-d');
		$date1 = date('d-m-Y',strtotime($curr_date));
		$paiddate1 = date('Y-m-d',strtotime($paiddate2));
		$pay_date = date('Y-m-d',strtotime($pay_date1));
		$mod_date  = strtotime($paiddate1 . "+ $days days");
		$expiry    = date("Y-m-d", $mod_date);
		$wait      = "no";
		$time      = $days * 86400;
		$exp_time = $time + strtotime($paiddate1);
		$expiry1 = date('d-m-Y',strtotime($expiry));
		$query1 = "select * from user_data WHERE newid='$p_id'";
		$result1 = mysqli_query($con, $query1);
		if (mysqli_affected_rows($con) == 1) {
			while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				$email     = $row1['email'];
				$joindate  = $row1['joining'];
				$address   = $row1['address'];
				$zipcode   = $row1['zipcode'];
				$birthdate = $row1['birthdate'];
				$sex       = $row1['sex'];
				$contact   = $row1['contact'];
				$birthdate1 = date('d-m-Y',strtotime($birthdate));
			}
		}
		$bal = $total - $paid;
		mysqli_query($con, "UPDATE subsciption SET renewal='no' WHERE mem_id=$p_id");
		mysqli_query($con, "UPDATE payment SET renewal='no' WHERE mem_id=$p_id");
		mysqli_query($con, "INSERT INTO subsciption (mem_id,bank_id,name,sub_type,paid_date,total,paid,dis,expiry,invoice,sub_type_name,bal,exp_time,payment_method,cheque_no,renewal,curr_date,pay_date,insert_by)
		VALUES ('$p_id','$bank_id','$full_name','$mem_type','$paiddate1','$total','$paid','$dis','$expiry','$invoice','$name_type','$bal','$exp_time','$paymentdata','$chequeno','yes','$curr_date','$pay_date','$insert_by')");

        mysqli_query($con, "INSERT INTO payment (mem_id,bank_id,name,sub_type,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,payment_method,cheque_no,renewal,pay_date,insert_by)
	    VALUES ('$p_id','$bank_id','$full_name','$mem_type','$total','$paid','$dis','$total_dis','$expiry','$invoice','$name_type','$bal','$paymentdata','$chequeno','yes','$pay_date','$insert_by')");
        //print_r($_POST);
		echo "<head><script>alert('Member Added ,Member Id : $p_id');</script></head></html>";
		}else
		{
		echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=payments'>";
		}
}
	$query2 = "select * from card";
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
	<a href="index.php?vis=view_mem"><h1>Invoice (New Month Payment)</h1></a>
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
	<td><?php $query  = "select * from auth_user WHERE id=$insert_by";
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
	<td><?php echo $paiddate2;?></td>
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
	<th><span>Renewal Date</span></th>
	<td><span><?php echo $expiry1; ?></span></td>
	<th><span>Membership Type</span></th>
	<td><span><?php echo $name_type; ?></span></td>
	</tr>
	<tr>
	<th><span>Mobile No :</span></th>
	<td><span><?php echo $contact; ?></span></td>
	<th><span>Cheque No :</span></th>
	<td><span><?php echo $chequeno; ?></span></td>
	</tr>
	<tr>
	<th><span>Pay Month:</span></th>
	<td><span><?php echo $pay_date1; ?></span></td>
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
	<td><span><?php echo $paiddate2.' To '.$expiry1; ?></span></td>
	</tr>
	</table>
	<table class="balance">
	<tr>
	<th><span>Total</span></th>
	<td><span data-prefix>Rs.</span><span><?php echo $rate; ?></span></td>
	</tr>
	<tr>
	<tr>
	<th><span>Discount</span></th>
	<td><span data-prefix>Rs.</span><span><?php echo $dis; ?></span></td>
	</tr>
	<tr>
	<th><span>Payment Mode</span></th>
	<td><span><?php echo $paymentdata; ?></span></td>
	</tr>
	<tr>
	<th><span>Paid</span></th>
	<td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
	</tr>
	<tr>
	<th><span>Due</span></th>
	<td><span data-prefix>Rs.</span><span><?php echo $total - $paid;; ?></span></td>
	</tr>
	</table>
	</article>
	<br>
	<center><h3>Website : <b><?php echo $website;?></b></h3></center>
	</body>
	</html>