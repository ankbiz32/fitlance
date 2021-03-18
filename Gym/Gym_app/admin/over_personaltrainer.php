<style>
.hed{
padding-left:10px; 
font-weight:bolder; 
color:#960;
}
</style>
<?php
if (isset($_POST['dayf'])) {
?>
		<h4 class="hed">Members</h4>
		<hr / >
		<?php
		    $from2 = $_POST['dayf'].'-'.$_POST['monthf'].'-'.$_POST['yearf'];
		    $from1 = date('d-m-Y',strtotime($from2));
		    $to2   = $_POST['dayt'].'-'.$_POST['montht'].'-'.$_POST['yeart'];
		    $to1   = date('d-m-Y',strtotime($to2));
			$from  = date('Y-m-d',strtotime($from1));
			$to    = date('Y-m-d',strtotime($to1));
		?>	
		Members From :
		<?php
		 $date1 = date('d-m-Y',strtotime($from ));
		 $date2 = date('d-m-Y',strtotime($to ));
		    echo $date1;
		?>   To : <?php
		    echo $date2;
		?>
		<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Member ID </th>
						<th>Member Name </th>
						<th>Trainer ID </th>
						<th>Trainer Name</th>
						<th>Join On</th>
					</tr>
				</thead>
				<tbody>
				<?php   
				    $query  = "select * from trainer_pay WHERE join_date BETWEEN '$from' AND '$to'";
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    if (mysqli_affected_rows($con) != 0) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$date1 = date('d-m-Y',strtotime( $row['join_date'] ));
				            echo "<tr><td>" . $sno . "</td>";
				            echo "<td>" . $row['member_id'] . "</td>";
							echo "<td>" . $row['member_name'] . "</td>";
				            echo "<td>" . $row['staff_id'] . "</td>";
							echo "<td>" . $row['staff_name'] . "</td>";
				            echo "<td>" . $date1 . "</td>";
				            $sno++;
				        }
				        
				    }
				    
				?>									
				</tbody>
			</table>
							
			<h4>Total Members in This Date Range : <?php echo $sno - 1; ?></h4><br /><hr />

			<?php
			$from2 = $_POST['dayf'].'-'.$_POST['monthf'].'-'.$_POST['yearf'];
			$from1 = date('d-m-Y',strtotime($from2));
			$to2   = $_POST['dayt'].'-'.$_POST['montht'].'-'.$_POST['yeart'];
			$to1   = date('d-m-Y',strtotime($to2));
			$from  = date('Y-m-d',strtotime($from1));
			$to    = date('Y-m-d',strtotime($to1));
			?>
			Members Payments :
			<?php
			$date1 = date('d-m-Y',strtotime( $from ));
			$date2 = date('d-m-Y',strtotime( $to ));
			echo $date1;
			?>   To : <?php
			echo $date2;
			?>

			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Member ID / Member Name </th>
						<th>Trainer ID / Trainer Name</th>
						<th>Join On</th>
						<th>Total / Paid</th>
						<th>Expiry</th>
					</tr>
				</thead>
				<tbody>
					<?php
					    $query  = "select * from trainer_pay WHERE join_date BETWEEN '$from' AND '$to'";
					    $result = mysqli_query($con, $query);
					    $sno    = 1;
					    $total  = 0;
					    if (mysqli_affected_rows($con) != 0) {
					        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$date1 = date('d-m-Y',strtotime( $row['expiry'] ));
			                $date2 = date('d-m-Y',strtotime( $row['join_date'] ));
					            echo "<tr><td>" . $sno . "</td>";
					            echo "<td>" . $row['member_id'] . " / " . $row['member_name'] . "</td>";
				                echo "<td>" . $row['staff_id'] . " / " . $row['staff_name'] . "</td>";
				                echo "<td>" . $date2 . "</td>";
					            echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
					            echo "<td>" . $date1 . "</td>";
					            //echo "<td>" . $row['paid_date'] . "</td>";
					            //echo "<td>" . $row['invoice'] . "</td>";
					            $total = $total + $row['total'];
					            $sno++;
					            
					        }
					        
					        
					    }
					    
					?>										
				</tbody>
			</table>
				<h4>Total Payments in This Date Range : <?php echo $sno - 1; ?></h4>
				<h4>Total Income in This Date Range : <?php echo $total;?></h4>
					
<?php
}else{
 echo "<meta http-equiv='refresh' content='0; url=index.php?vis=over_members_month'>";
}

?>


