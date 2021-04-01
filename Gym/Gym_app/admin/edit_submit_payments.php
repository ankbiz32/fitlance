<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['invoice']) && isset($_POST['date'])) {
    
    $invoice   = $_POST['invoice'];
    $pay_date2  =  $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
	$pay_date1 = date('d-m-Y',strtotime($pay_date2));
    $total     = rtrim($_POST['total']);
    $paid      = rtrim($_POST['paid']);
    $mem_type1 = $_POST['mem_type'];
	$paymentdata = $_POST['paymentdata'];
	if(!empty($_POST['chequeno'])){$chequeno = $_POST['chequeno']; }
    $bal       = $total - $paid;
	$pay_date = date('Y-m-d',strtotime($pay_date1));
    $query1 = "select * from mem_types WHERE mem_type_id='$mem_type1'";
    //echo $query1;
    $result1 = mysqli_query($con, $query1);
		if (mysqli_affected_rows($con) == 1) {
			while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
				$mem_type = $row1['name'];
				$sub_type = $row1['mem_type_id'];
				$days     = $row1['days'];
			}
		}
		
	$query  = "select * from user_data ORDER BY joining DESC";
    $result = mysqli_query($con, $query);
    $sno    = 1;
	if (mysqli_affected_rows($con) != 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$msgid   = $row['newid'];
		$id = $row['role'];
		
		$query11  = "select * from auth_user WHERE id='$id'";
		//echo $query11;
		$result11 = mysqli_query($con, $query11);
			if (mysqli_affected_rows($con) == 1) {
				while ($row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC)) {
					$name = $row11['name'];
				}
			}
		}
	}
		
	$p_id = $_POST['invoice'];
	$query11  = "select * from user_data WHERE newid=".$_POST['p_id'];
	//echo $query11;
    $result11 = mysqli_query($con, $query11);
		if (mysqli_affected_rows($con) == 1) {
			while ($row1 = mysqli_fetch_array($result11, MYSQLI_ASSOC)) {
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
			}
		}
    $mod_date = strtotime($pay_date . "+ $days days");
    $expiry   = date("Y-m-d", $mod_date);
    $time     = $days * 86400;
    $exp_time = $time + strtotime($pay_date);
    mysqli_query($con, "UPDATE subsciption SET paid_date='$pay_date', total='$total', paid='$paid', sub_type_name='$mem_type', bal='$bal', sub_type='$sub_type', expiry='$expiry', exp_time='$exp_time',payment_method='$paymentdata',cheque_no='$chequeno' WHERE invoice='$invoice'");
	
	
	$query2 = "select * from subsciption WHERE invoice='$invoice'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_affected_rows($con) == 1) {
        while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            $full_name     = $row['name'];
            $sub_type_name = $row['sub_type_name'];
            $total         = $row['total'];
            $paid          = $row['paid'];
            $expiry        = $row['expiry'];
            $date          = $row['paid_date'];
			$bank_id = $row['bank_id'];
			$cheque_no = $row['cheque_no'];
			$payment_method = $row['payment_method'];
        }
    }
	$query3 = "select * from freeze WHERE mem_id='$p_id'";
    $result3 = mysqli_query($con, $query3);
    if (mysqli_affected_rows($con) == 1) {
        while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
            $from_date = $row3['from_date'];
            $to_date   = $row3['to_date'];
            $comment      = $row3['comment'];
        }
    }
} else {
    echo "<head><script>alert('Profile NOT Updated, Check Again');</script></head></html>";
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
    </script>
	</head>
	<body>
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
                <td><span><?php echo $curr_date; ?></span></td>
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
				<td><?php echo $joindate;?></td>
              </tr>
              <tr>
				<th>Address</th>
				<td><?php echo $address;?></td>
				<th>Pin Code</th>
				<td><?php echo $zipcode;?></td>
              </tr>
              <tr>
				<th>Birth Date</th>
				<td><?php echo $birthdate;?></td>
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
				<td><span><?php echo $mem_type; ?></span></td>
              </tr>
			  <tr>
				<th><span>Renewal Date</span></th>
				<td><span><?php echo $expiry; ?></span></td>
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
			<table class="balanceleft" style="float:left;width:50%;">
              <tr>
                <th><span>Membership Period</span></th>
                <td><span><?php echo $joindate.' To '.$expiry; ?></span></td>
              </tr>
			  <tr>
                <th><span>Membership Freeze Period</span></th>
                <td><span><?php echo $from_date1.' To '.$to_date1; ?></span></td>
              </tr>
              <tr>
                <th><span>Receipt Comment</span></th>
                <td><span><?php echo $comment; ?></span></td>
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
                <td><span data-prefix>Rs.</span><span><?php echo $total - $paid; ?></span></td>
              </tr>
            </table>
		</article>
		<aside>
			<div>
				<p style="font-size:10px">1. Has your doctor ever said that you have a heart condition and that you should only do physical activity prescribed by a doctor?. <input type="checkbox" name="question_1" value="Yes" <?php if($question_1=='Yes'){echo'checked';}?> > Yes <input type="checkbox" name="question_1" value="No" <?php if($question_1=='No'){echo'checked';}?>> No</br></br>
                2. Do you know of any other reason why you should not do physical activity? If YES ,please give details below.<span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_2;?></span></br></br>
                3. Are you pregnant?. <input type="checkbox" name="question_3" value="Yes" <?php if($question_3=='Yes'){echo'checked';}?> > Yes <input type="checkbox" name="question_3" value="No" <?php if($question_3=='No'){echo'checked';}?>> No</br></br>
                4. Have you gone through any surgery in the last 3 months?If yes give details below. <span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_4;?></span></br></br>
                5. Are you currently on medication for blood pressure or a heart condition? If you please give details of the medication. <span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_5;?></span></br></br> 
                6. Do you currently have or had any of the health conditions mentioned below?
                <?php foreach($question_6 as $val)
				{
				 echo' <input type="checkbox" value="'.$val.'" checked > '.$val.' ';
				}
				?>
                 </br></br>
                7. IF you are presently taking any medication please give details of their names and the conditions they are taken for below. <input type="checkbox" name="question_7" value="Yes" <?php if($question_7=='Yes'){echo'checked';}?> > Yes <input type="checkbox" name="question_7" value="No" <?php if($question_7=='No'){echo'checked';}?>> No</br></br>
                8. Please give details of your physicians name and contact details below. <span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_8;?></span></br></br> 
                9. Does your physician know that you are participating in an exercise program? <span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_9;?></span></br></br>
                10. Have you ever had a physical injury due to an acccident? If you please give details below. <span style="border-bottom:1px solid #333; color:#063;"><?php echo $question_10;?></span></br></br>
                11. Please give the date and the details of your most recent health check-up below.
                <span style="border-bottom:1px solid #333; color:#063;"><?php  echo $question_11;?></span></br></br>
                12.Do you currently have or had health condition mentioned below.
                <?php foreach($question_12 as $val)
				{
				 echo' <input type="checkbox" value="'.$val.'" checked > '.$val.' ';
				}
				?>
                </br></br>
                13.Other's please explain. <span style="border-bottom:1px solid #333; color:#063;"><?php  echo $question_13;?></span>
                </p>
			</div>
		</aside>
		<br>
		<center><h3>Website : <b>www.orangefitness.co.in</b> </h3></center>
	</body>
</html>