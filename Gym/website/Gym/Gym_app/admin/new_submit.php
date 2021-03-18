<?php
require 'db_conn.php';
page_protect();
if (isset($_POST['p_name']) && isset($_POST['mem_type']) && isset($_POST['total']) && isset($_POST['age']) && isset($_POST['paid'])) {
    function getRandomWord($len = 3)
    {
        $word = array_merge(range('a', 'z'), range('0', '9'));
        shuffle($word);
        return substr(implode($word), 0, $len);
    }
    $mem_type = $_POST['mem_type'];
    $query1 = "select * from mem_types WHERE mem_type_id='$mem_type'";
    //echo $query;
    $result1 = mysqli_query($con, $query1);
    if (mysqli_affected_rows($con) == 1) {
        while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
            
            $name_type = $row1['name'];
            $details   = $row1['details'];
            $days      = $row1['days'];
        }
    }
	
	$query2 = "select * from user_data WHERE newid=".$_POST['p_id'];
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) == 0){
		$invoice   = substr(time(), 2, 10) . getRandomWord();
		$p_id = $_POST['p_id'];
		$date      = $_POST['date'];
		$age       = rtrim($_POST['age']);
		$full_name = rtrim($_POST['p_name']);
		$email     = rtrim($_POST['email']);
		$address   = rtrim($_POST['add']);
		$zipcode   = rtrim($_POST['zipcode']);    
		$birthdate   = $_POST['birthdate'];
		$contact   = rtrim($_POST['contact']);
		$sex       = rtrim($_POST['sex']);
		$height    = rtrim($_POST['height']);
		$weight    = rtrim($_POST['weight']);
		$nationality    = rtrim($_POST['nationality']);
		$facebookaccount    = rtrim($_POST['facebookaccount']);
		$twitteraccount    = rtrim($_POST['twitteraccount']);
		$contactperson    = rtrim($_POST['contactperson']);
		$previousgym    = rtrim($_POST['previousgym']);
		$yearstraining    = rtrim($_POST['yearstraining']);
		$proof = $_POST['proof'];
		$total     = $_POST['total'];
		$paid      = $_POST['paid'];
		$mod_date  = strtotime($date . "+ $days days");
		$expiry    = date("Y-m-d", $mod_date);
		$wait      = "no";
		$time      = $days * 86400;
		$exp_time = $time + strtotime($date);
	   
		mysqli_query($con, "INSERT INTO user_data (wait,newid,name,address,zipcode,birthdate,contact,email,height,weight,nationality,facebookaccount,twitteraccount,contactperson,previousgym,yearstraining,joining,age,proof,sex)VALUES('$wait',$p_id,'$full_name','$address','$zipcode','$birthdate','$contact','$email','$height', '$weight','$nationality','$facebookaccount','$twitteraccount','$contactperson','$previousgym','$yearstraining','$date','$age', '$proof','$sex')");
		$bal = $total - $paid;
		mysqli_query($con, "INSERT INTO subsciption (mem_id,name,sub_type,paid_date,total,paid,expiry,invoice,sub_type_name,bal,exp_time,renewal)
	VALUES ('$p_id','$full_name','$mem_type','$date','$total','$paid','$expiry','$invoice','$name_type','$bal','$exp_time','yes')");
		echo "<head><script>alert('Member Added ,Member Id :$p_id');</script></head></html>";
	}else
	{
	   echo "<head><script>alert('Member Id already exists, Check Again');</script></head></html>";
       echo "<meta http-equiv='refresh' content='0; url=index.php?vis=new_entry'>";
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
			<a href="index.php?vis=new_entry"><h1>Invoice (New Registration)</h1></a>
			<address>
				<p>Orange Fitness</p>
				<p>Plot No-160/1, 2nd Floor Above Pantaloons <br> Gupta Tower Temple Road <br> Civil Line Nagpur - 440001</p>
				<p>Phone:+91 - 8308119449 </p><p>www.orangefitness.com (orangefitness@gmail.com)</p><br><p><div id="barcodeTarget" class="barcodeTarget"></div>
                <canvas id="canvasTarget"></canvas> </span>
			</address>
            <span><img alt="Orange Fitness" src="../../img/logo.png" width="250" height="150">
            </header>
            <article>
            <table class="meta">
            <img alt="" src="pic1.jpg" width="100" height="100">	<tr>
            <th><span>Invoice #</span></th>
            <td><span><?php
            echo $invoice;
            ?></span></td>
            </tr>
            <tr>
            <th><span>Date</span></th>
            <td><span><?php
            echo $date;
            ?></span></td>
            </tr>
            <tr>
            <th><span>Member ID / Reg ID</span></th>
            <td><?php
            $regid = substr($p_id, 6, 10);
            echo $p_id . " / " . $regid;
            ?></span></td>
			</tr>
			</table>	
            <table class="meta">
            <tr>
            <th><span>Name</span></th>
            <td><span><?php
            echo $full_name;
            ?></span></td>
            </tr>
            <tr>
            <th><span>Age, Sex</span></th>
            <td><span><?php
            echo $age . " / " . $sex;
            ?></span></td>
            </tr>
            <tr>
            <th><span>Height / Weight</span></th>
            <td><?php
            echo $height . "  FEET / " . $weight . " Kg";
            ?></span></td>
            </tr>
            </table>	
            <table class="inventory">
            <thead>
            <tr>
            <th><span>Membership Type</span></th>
            <th><span>Details</span></th>
            <th><span>Subscription Expiry</span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
            <td><span><?php
            echo $name_type;
            ?></span></td>
            <td><span><?php
            echo $details . " For " . $days;
            ?></span></td>
            <td><span><?php
            echo $expiry;
            ?></span></td>
            </tr>
            </tbody>
            </table>
            <table class="balance">
            <tr>
            <th><span>Total</span></th>
            <td><span data-prefix>Rs.</span><span><?php
            echo $total;
            ?></span></td>
            </tr><tr>
            <th><span>Paid</span></th>
            <td><span data-prefix>Rs.</span><span><?php
            echo $paid;
            ?></span></td>
            </tr><tr>
            <th><span>Due</span></th>
            <td><span data-prefix>Rs.</span><span><?php
            echo $total - $paid;
            ?></span></td>
            </tr>
            </table>
		</article>
		<aside>
			<h1><span>Additional Notes</span></h1>
			<div>
				<p>1) This is a temporary receipt,please collect your original receipt with-in 7 days from the date of this receipt.</br></br>
                2) It is a mandatory to have original receipt for any further communication with Orange Fitness.</br></br>
                3) No disputes or arguments will be entertained without proof of the original receipt.</br></br>
                4) Management reserves the right to admission.</br></br>
                5) We assume that members have read all rules and regulation goveming the operations of the club.</br></br>
                6) Freezing Facility is subject to additional charges.</br></br></p>
			</div>
		</aside><center><br><br><a href="index.php?vis=view_mem">Orange Fitness Gym ( www.orangefitness.com )</a></center>
	</body>
</html>