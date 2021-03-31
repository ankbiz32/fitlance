<?php
require 'db_conn.php';
session_start();
if (isset($_POST['name'])) {
    $invoice = $_POST['name'];
    $query = "select * from subsciption WHERE invoice='$invoice'";
    $result = mysqli_query($con, $query);
    if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $memid         = $row['mem_id'];
            $full_name     = $row['name'];
            $sub_type_name = $row['sub_type_name'];
            $total         = $row['total'];
            $paid          = $row['paid'];
			      $bal           = $row['bal'];
			      $dis           = $row['dis'];
            $expiry        = $row['expiry'];
            $date          = $row['paid_date'];
			$bank_id = $row['bank_id'];
			$cheque_no = $row['cheque_no'];
			$payment_method = $row['payment_method'];
			$date1 = date('d-m-Y',strtotime( $row['expiry'] ));
            $query1  = "select * from user_data WHERE newid='$memid'";
            $result1 = mysqli_query($con, $query1);
            if (mysqli_affected_rows($con) == 1) {
                while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                    $sex    = $row1['sex'];
                    $email = $row1['email'];
                    $address = $row1['address'];
					$birthdate = $row1['birthdate'];
					$zipcode = $row1['zipcode'];
					$contact = $row1['contact'];
					$joindate = $row1['joining'];
					$curr_date = $row1['curr_date'];
					$p_id = $row1['newid'];
					$question_1  = rtrim($row1['question_1']);
                    $question_2  = rtrim($row1['question_2']);
                    $question_3  = rtrim($row1['question_3']);
                    $question_4  = rtrim($row1['question_4']);
                    $question_5  = rtrim($row1['question_5']);
                    $question_6 = explode(',', $row1['question_6']);
                    $question_7  = rtrim($row1['question_7']);
                    $question_8  = rtrim($row1['question_8']);
                    $question_9  = rtrim($row1['question_9']);
                    $question_10 = rtrim($row1['question_10']);
                    $question_11 = rtrim($row1['question_11']);
                    $question_12 = explode(',', $row1['question_12']); 
                    $question_13 = rtrim($row1['question_13']);
					$insert_by = rtrim($row1['insert_by']);
					$workout_time = rtrim($row1['workout_time_id']);
					$date2 = date('d-m-Y',strtotime( $row1['birthdate'] ));
					$date3 = date('d-m-Y',strtotime( $row1['joining'] ));
					$date4 = date('d-m-Y',strtotime( $row1['curr_date'] ));
                }
            }
        }
    }
    $query2 = "select * from mem_types WHERE name='$sub_type_name'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_affected_rows($con) == 1) {
        while ($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $name_type = $row2['name'];
            $details   = $row2['details'];
            $days      = $row2['days'];
			$rate      = $row2['rate'];
        }
    }
	$query3 = "select * from freeze WHERE mem_id='$p_id'";
    $result3 = mysqli_query($con, $query3);
    if (mysqli_affected_rows($con) == 1) {
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $from_date = $row3['from_date'];
            $to_date   = $row3['to_date'];
            $comment   = $row3['comment'];
        }
    }
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_mem'>";
    
}
 $query2 = "select * from card where branch_id='$_SESSION[branch_id]' ";
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
	    <a href="javascript:void();" onClick="printbody()">Print</a> | <a href="index.php?vis=view_mem">Back</a>
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
                <td><span><?php echo $date4; ?></span></td>
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
				<td><?php echo $date3;?></td>
              </tr>
              <tr>
				<th>Address</th>
				<td><?php echo $address;?></td>
				<th>Pin Code</th>
				<td><?php echo $zipcode;?></td>
              </tr>
              <tr>
				<th>Birth Date</th>
				<td><?php echo $date2;?></td>
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
				<td><span><?php echo $date1; ?></span></td>
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
                <td><span><?php echo $date3.' To '.$date1; ?></span></td>
              </tr>
			  <tr>
                <th><span>Membership Freeze Period</span></th>
                <td><span><?php echo $from_date2.' To '.$to_date2; ?></span></td>
              </tr>
              <tr>
                <th><span>Receipt Comment</span></th>
                <td><span><?php echo $comment; ?></span></td>
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