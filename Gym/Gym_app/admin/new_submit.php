<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['p_name']) && isset($_POST['mem_type']) && isset($_POST['total']) && isset($_POST['paid'])) {
	function getRandomWord($len = 3)
	{
		$word = array_merge(range('a', 'z'), range('0', '9'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}
	function new_register($message,$contact){
		$AUTH_KEY = "72cb95dfd3a1f683269b32882788116";
		$message = "YOUR%20REGISTRATION%20HAS%20BEEN%20SUCCESSFUL..!";
		$senderId = "DEMOOS";
		$routeId = "1";
		//$mobileNos  = "8975687500";
		$smsContentType ="english";
		$url = "http://msg.smscluster.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$AUTH_KEY."&message=".$message."&senderId=".$senderId."&routeId=".$routeId."&mobileNos=".$contact."&smsContentType=".$smsContentType."";
		//echo $url;
		$ch = curl_init();
		$timeout = 30;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTIONTIMEOUT,$timeout);
		$response =curl_exec($ch);
		curl_close($ch);
		//echo $response;
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

    $query2 = "select * from user_data WHERE newid=".$_POST['p_id'];
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
		$invoice       = substr(time(), 2, 10) . getRandomWord();
		$p_id          = $_POST['p_id'];
		$full_name     = rtrim($_POST['p_name']);
		$address       = rtrim($_POST['add']);
		$zipcode       = rtrim($_POST['zipcode']);  
		$birthdate2    = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$birthdate1    = date('d-m-Y',strtotime($birthdate2));
		$contact       = rtrim($_POST['contact']);
		$email         = rtrim($_POST['email']);
		$landline      = rtrim($_POST['landline']);
		$joindate2     = $_POST['dayj'].'-'.$_POST['monthj'].'-'.$_POST['yearj'];
		$joindate1     = date('d-m-Y',strtotime($joindate2));
		$workout_time  = rtrim($_POST['workout_time']);
		$sex           = rtrim($_POST['sex']);
		$activity      = rtrim($_POST['activity']);
		$curr_date     = date('Y-m-d');
		$total         = $_POST['total'];
		$paid          = $_POST['paid'];
		$dis           = $_POST['dis'];
		$bal           = $_POST['bal'];
		$mod_date      = strtotime($joindate1 . "+ $days days");
		$expiry        = date("Y-m-d", $mod_date);
		$wait          = "no";
		$time          = $days * 86400;
		$exp_time      = $time + strtotime($joindate1);
		$insert_by     = $_SESSION['id']; 
		$bank          = $_POST['bank'];
		$paymentdata   = $_POST['paymentdata'];
		$chequeno      = $_POST['chequeno'];

		$joindate  = date('Y-m-d',strtotime($joindate1));
		$birthdate = date('Y-m-d',strtotime($birthdate1));
		$date1     = date('d-m-Y',strtotime($curr_date));
        mysqli_query($con,"INSERT INTO user_data (wait,newid,name,address,zipcode,birthdate,contact,email,curr_date,landline,joining,workout_time_id,sex,activity,insert_by)VALUES('$wait','$p_id','$full_name','$address','$zipcode','$birthdate','$contact','$email','$curr_date','$landline','$joindate','$workout_time','$sex','$activity',$insert_by)");
		//print_r($_POST);
		$total = $total - $dis;
		$expiry = $expiry ;
		$expiry1 = date('d-m-Y',strtotime( $expiry ));
			
	  mysqli_query($con, "INSERT INTO subsciption (mem_id,bank_id,name,sub_type,paid_date,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,exp_time,payment_method,cheque_no,renewal,curr_date,pay_date,insert_by)
	VALUES ('$p_id','$bank_id','$full_name','$mem_type','$joindate','$total','$paid','$dis','$total_dis','$expiry','$invoice','$name_type','$bal','$exp_time','$paymentdata','$chequeno','yes','$curr_date','$curr_date','$insert_by')");
	
	  mysqli_query($con, "INSERT INTO payment (mem_id,bank_id,name,sub_type,total,paid,dis,total_dis,expiry,invoice,sub_type_name,bal,payment_method,cheque_no,renewal,pay_date,insert_by)
	VALUES ('$p_id','$bank_id','$full_name','$mem_type','$total','$paid','$dis','$total_dis','$expiry','$invoice','$name_type','$bal','$paymentdata','$chequeno','yes','$curr_date','$insert_by')");
    
		if (!empty($_POST['trainer_name']) && !empty($_POST['trainer_type_id']) && !empty($_POST['totalt']) && !empty($_POST['paidt'])) {

			$staffid = $_POST['trainer_name'];
			$query3 = "select * from staff_data WHERE staffid='$staffid'";
			$result3 = mysqli_query($con, $query3);
			if (mysqli_affected_rows($con) == 1) {
				while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
					$name_staff   = $row3['name'];
				}
			}

			$staff_type = $_POST['trainer_type_id'];
			$query11 = "select * from trainer_types WHERE staff_type_id='$staff_type'";
			//echo $query1;
			$result11 = mysqli_query($con, $query11);
			if (mysqli_affected_rows($con) == 1) {
				while ($row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC)) {
					$name    = $row11['name'];
					$time    = $row11['time'];
					$day     = $row11['day'];
				}
			}

			$trainer_name = rtrim($_POST['trainer_name']);
			$trainer_type_id  = rtrim($_POST['trainer_type_id']);
			$date2    = $_POST['dayt'].'-'.$_POST['montht'].'-'.$_POST['yeart'];
			$date1    = date('d-m-Y',strtotime($date2));
			$payment_method_tr = $_POST['payment_methodt'];
			$total_tr = $_POST['totalt'];
			$paid_tr = $_POST['paidt'];
			$paybalance = $total_tr - $paid_tr;
			$cheque_no_tr = $_POST['cheque_not'];
			$bank_id_tr = $_POST['bank_idt'];
			$invoice_tr   = substr(time(), 2, 10) . getRandomWord();
			$insert_by = $_SESSION['id'];
			$date = date('Y-m-d',strtotime($date1));
			$mod_date  = strtotime($date . "+ $day day");
			$expiry_tr   = date("Y-m-d", $mod_date);
			$wait      = "no";
			$time      = $day * 86400;
			$exp_time_tr = $time + strtotime($date);
			//$expiry = date('Y-m-d',strtotime($expiry));
			//echo $expiry_date;

			mysqli_query($con, "INSERT INTO trainer_pay (member_id,member_name,staff_id,staff_name,trainer_type_id,bank_id,paid_date,join_date,payment_method,expiry_date,cheque_no,total,paid,invoice,paybalance,expiry,exp_time,insert_by)
		        VALUES('$p_id','$full_name','$trainer_name','$name_staff','$trainer_type_id','$bank_id_tr','$date','$date','$payment_method_tr','$expiry_tr','$cheque_no_tr','$total_tr','$paid_tr','$invoice_tr','$paybalance','$expiry_tr','$exp_time_tr','$insert_by')");
		}
	    echo "<head><script>alert('Member Added ,Member Id : $p_id');</script></head></html>";
		  new_register($message,$contact);
	}else
	{
	     echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
       echo "<meta http-equiv='refresh' content='0; url=index.php?vis=new_entry'>";
	}
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
                <td><span><?php echo $paymentdata; ?></span></td>
              </tr>
              <tr>
                <th><span>Paid</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
              </tr>
              <tr>
                <th><span>Balance</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $total - $paid; ?></span></td>
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