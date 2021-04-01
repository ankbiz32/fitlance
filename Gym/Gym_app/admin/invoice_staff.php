<?php
require 'db_conn.php';
if (isset($_POST['name'])) {
    $paid_date;
    $name;
    $staff_id;
    $total;
    $paid;
    $workingday;
    $payableday;
    $invoice = $_POST['name'];
    $query1 = "select * from staff_pay WHERE invoice='$invoice'";
    //echo $query1;
    $result1 = mysqli_query($con, $query1);
    
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            $staff_id      = $row1['staff_id'];
            $name          = $row1['name'];
            $workingday    = $row1['workingday'];
            $total         = $row1['total'];
            $paid          = $row1['paid'];
            $payableday    = $row1['payableday'];
            $paid_date     = $row1['paid_date'];
            $paid_date1 = date('d-m-Y',strtotime($paid_date));
            $query11  = "select * from staff_data WHERE staffid='$staff_id'";
			//echo $query11;
            $result11 = mysqli_query($con, $query11);
            if (mysqli_affected_rows($con) == 1) {
                while ($row11 = mysqli_fetch_array($result11, MYSQLI_ASSOC)) {
					$name      = $row11['name'];
					$email     = $row11['email'];
					$address   = $row11['address'];
					$mobile    = $row11['mobile'];
					$age       = $row11['age'];
					$gender    = $row11['gender'];
					$designation   = $row11['designation'];
					$salary    = $row11['salary'];
					//$bank_name = $row11['bank_name'];
					$branch_name  = $row11['branch_name'];
					$bank_acc  = $row11['bank_acc'];
					$ifsc_code = $row11['ifsc_code'];
					$micr_code = $row11['micr_code'];
					$date      = $row11['date'];
					$id = $row11['bank_name'];
			        $date1 = date('d-m-Y',strtotime($date));
				$query12  = "select * from bank_name WHERE id='$id'";
				//echo $query12;
				$result12 = mysqli_query($con, $query12);
					if (mysqli_affected_rows($con) == 1) {
						while ($row12 = mysqli_fetch_array($result12, MYSQLI_ASSOC)) {
							$bank_name = $row12['bank_name'];
						}
					}
                }
            }
        }
    }
} else {
    echo "<meta http-equiv='refresh' content='0; url=index.php?vis=staff_details'>";
    
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
			<a href="index.php?vis=staff_details"><h1>Invoice Staff Payments (Re-Print Slip)</h1></a>
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
                <th><span>Staff ID </span></th>
                <td><?php echo $staff_id; ?></span></td>
              </tr>
			</table>	
            <table>
              <tr>
                <th>Name</th>
                <td><?php echo $name;?></td>
                <th>Email</th>
                <td><?php echo $email;?></td>
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
                <th><span>Join Date</span></th>
                <td><span><?php echo $date1; ?></span></td>
              </tr>
            </table>
			<table>
              <tr>
              <th>Bank Name</th>
              <td><?php echo $bank_name;?></td>
              <th>Branch Name</th>
              <td><?php echo $branch_name;?></td>
              </tr>
              <tr>
              <th>Account No.</th>
              <td><?php echo $bank_acc;?></td>
              <th>IFSC Code</th>
              <td><?php echo $ifsc_code;?></td>
              </tr>
              <tr>
              <th>MICR Code</th>
              <td><?php echo $micr_code;?></td>
              </tr>
            </table>
			<table class="balance">
              <tr>
                <th><span>Total Salary</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $total; ?></span></td>
              </tr>
              <tr>
                <th><span>Paid Salary</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
              </tr>
			  <tr>
                <th><span>Net Payment</span></th>
                <td><span data-prefix>Rs.</span><span><?php echo $paid; ?></span></td>
             </tr>
            </table>
		</article>
		<br><br>
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
