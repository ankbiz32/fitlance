<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['staff_id'])) {
	function getRandomWord($len = 3)
		{
			$word = array_merge(range('a', 'z'), range('0', '9'));
			shuffle($word);
			return substr(implode($word), 0, $len);
		}
	$staffid = $_POST['staff_id'];
	$query  = "select * from staff_data WHERE staffid='$staffid'";
	//echo $query;
	$result = mysqli_query($con, $query);
		if (mysqli_affected_rows($con) == 1) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$name      = $row['name'];
				$email     = $row['email'];
				$address   = $row['address'];
				$mobile    = $row['mobile'];
				$age       = $row['age'];
				$gender    = $row['gender'];
				$designation = $row['designation'];
				$branch_name = $row['branch_name'];
				$bank_acc  = $row['bank_acc'];
				$ifsc_code = $row['ifsc_code'];
				$micr_code = $row['micr_code'];
				$date      = $row['date'];
				$bank_name = $row['bank_name'];
			    $date1 = date('d-m-Y',strtotime($date));
			}
		}
		$invoice    = substr(time(), 2, 10) . getRandomWord();
		$name       = rtrim($_POST['name']);
		$staff_id   = rtrim($_POST['staff_id']);
		$paid_date1 = $_POST['day'].'-'.$_POST['month'].'-'.$_POST['year'];
		$total      = $_POST['total'];
		$paid       = $_POST['paid'];
		$paybalance = $total - $paid;
		$bank_id    = $_POST['bank_id'];
		$payment_method = $_POST['payment_method'];
		$cheque_no  = $_POST['cheque_no'];
		$insert_by  = $_SESSION['id'];
		$paid_date = date('Y-m-d',strtotime($paid_date1));
		mysqli_query($con, "INSERT INTO staff_pay (staff_id,name,paid_date,total,paid,payment_method,cheque_no,bank_id,invoice,insert_by,paybalance)VALUES('$staff_id','$name','$paid_date','$total','$paid','$payment_method','$cheque_no','$bank_id','$invoice','$insert_by','$paybalance')");
		//print_r($_POST);
		echo "<head><script>alert('Payment Added:$name');</script></head></html>";
	} else {
		echo "<head><script>alert('Payment NOT Added, Check Again');</script></head></html>";
		echo "<meta http-equiv='refresh' content='0; url=index.php?vis=view_staff'>";
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
	    <a href="javascript:void();" onClick="printbody()">Print</a> 
		<header>
			<a href="index.php?vis=view_staff"><h1>Invoice (Staff Payments)</h1></a>
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
                <th><span>Paid Date</span></th>
                <td><span><?php echo $paid_date1; ?></span></td>
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
                 <th><span>Staff ID </span></th>
                 <td><?php echo $staffid; ?></span></td>
                 <th>Name</th>
                 <td><?php echo $name;?></td>
              </tr>
			  <tr>
			     <th>Email</th>
                 <td><?php echo $email;?></td>
				 <th><span>Join Date</span></th>
                 <td><span><?php echo $date1; ?></span></td>
			  </tr>
              <tr>
                <th>Address</th>
                <td><?php echo $address;?></td>
                <th>Contact No.</th>
                <td><?php echo $mobile;?></td>
              </tr>
              <tr>
                <th>Gender</th>
                <td><?php echo $gender;?></td>
                <th><span>Age</span></th>
                <td><span><?php echo $age; ?></span></td>
              </tr>
              <tr>
                <th><span>Designation</span></th>
                <td><span><?php $query2  = "select * from designation WHERE id=$designation";
					$result2 = mysqli_query($con, $query2);
					$row2 = mysqli_fetch_assoc($result2);
					echo $row2['name']; ?></span></td>
				<th>Bank Name</th>
				<td><?php $query3  = "select * from bank_name WHERE id=$bank_name";
						$result3 = mysqli_query($con, $query3);
						$row3 = mysqli_fetch_assoc($result3);
						echo $row3['bank_name']; ?></td>
               
              </tr>
            </table>
			<table>
              <tr>
				  <th>Branch Name</th>
				  <td><?php echo $branch_name;?></td>
				  <th>Account No.</th>
				  <td><?php echo $bank_acc;?></td>
              </tr>
              <tr>
				  <th>IFSC Code</th>
				  <td><?php echo $ifsc_code;?></td>
				  <th>MICR Code</th>
				  <td><?php echo $micr_code;?></td>
              </tr>
			  <tr>
                <th><span>Cheque No.</span></th>
                <td><span><?php echo $cheque_no; ?></span></td>
              </tr>
              <tr>
                <th><span>Bank Name</span></th>
                <td><span><?php $query4  = "select * from bank_name WHERE id=$bank_id";
						$result4 = mysqli_query($con, $query4);
						$row4 = mysqli_fetch_assoc($result4);
						echo $row4['bank_name']; ?></span></td>
              </tr>
            </table>
			<table class="balance">
			  <tr>
                <th><span>Payment Mode</span></th>
                <td><span><?php echo $payment_method; ?></span></td>
              </tr>
              <tr>
                <th><span>Total Salary</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $total; ?></span></td>
              </tr>
              <tr>
                <th><span>Paid Salary</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
              </tr>
			  <tr>
                <th><span>Due</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paybalance; ?></span></td>
              </tr>
            </table>
		</article>
		<br><br>
		<header>
			<address style="font-size:16px;">
				<h2>Customer Signature</h2>
			</address>
			<span><p>For Global Fun & Fitness</p><p align="center"><?php echo $name_company; ?></p></span>
		</header>
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