<?php
require 'db_conn.php';
session_start();
if (isset($_POST['name'])) {
    $invoice = $_POST['name'];
    $query = "select * from trainer WHERE invoice='$invoice'";
	//echo $query;
    $result = mysqli_query($con, $query);
    if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $trainer_id   = $row['trainer_id'];
            $trainer_name = $row['trainer_name'];
            $designation  = $row['designation'];
            $paid_date1    = $row['paid_date'];
            $total_amount = $row['total_amount'];
			$percentage   = $row['percentage'];
			$bal          = $row['bal'];
            $paid         = $row['paid'];
			$insert_by    = $row['insert_by'];
			$paid_date = date('d-m-Y',strtotime($paid_date1));
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
	    <a href="javascript:void();" onClick="printbody()">Print</a> | <a href="index.php?vis=view_trainerpay">Back</a>
		<header>
			<a href="index.php?vis=view_trainerpay"><h1>Invoice (Trainer Payment)</h1></a>
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
                <td><span><?php echo $paid_date; ?></span></td>
              </tr>
			</table>	
			<table>
				<tr>
					<th>Trainer ID</th>
					<td><?php echo $trainer_id; ?></td>
					<th>Trainer Name</th>
					<td><?php echo $trainer_name; ?></td>
				</tr>
				<tr>
					<th>Designation</th>
					<td><?php $query = "select * from designation WHERE id=$designation";
						$result = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result);
						echo $row['name']; ?></td>
				</tr>
			</table>
			<br>
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $total_amount; ?></span></td>
				</tr>
				<tr>
					<th><span>percentage</span></th>
					<td><span><?php echo $percentage;?></span><span data-prefix>%</span></td>
				</tr>
				<tr>
					<th><span>Amount</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
				</tr>
				<tr>
					<th><span>Due</span></th>
					<td><span data-prefix>Rs.</span><span><?php echo $bal; ?></span></td>
				</tr>
			</table>
		</article>
		<br>
		<center><h3>Website :  <b><?php echo $website;?></b></h3></center>
	</body>
</html>