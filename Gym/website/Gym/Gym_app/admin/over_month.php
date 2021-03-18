<?php
if (isset($_POST['from'])) {
?>
		<h3>Members</h3>
		<hr / >
		<?php
		    $from = $_POST['from'];
		    $to   = $_POST['to'];
		?>	
		Members From :
		<?php
		    echo $from;
		?>   To : <?php
		    echo $to;
		?>
		<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Membership ID</th>
						<th>Name</th>
						<th>Age / Sex</th>
						<th>Join On</th>
					</tr>
				</thead>
				<tbody>
				<?php   
				    $query  = "select * from user_data WHERE joining BETWEEN '$from' AND '$to'";
				    //echo $query;
				    $result = mysqli_query($con, $query);
				    $sno    = 1;
				    
				    if (mysqli_affected_rows($con) != 0) {
				        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				            
				            
				            
				            echo "<tr><td>" . $sno . "</td>";
				            echo "<td>" . $row['newid'] . "</td>";
				            echo "<td>" . $row['name'] . "</td>";
				            echo "<td>" . $row['age'] . " / " . $row['sex'] . "</td>";
				            echo "<td>" . $row['joining'] . "</td>";
				            $sno++;
				        }
				        
				    }
				    
				?>									
				</tbody>
			</table>
							
			<h4>Total Members in This Date Range : <?php echo $sno - 1; ?></h4>

			<?php
				    $from = $_POST['from'];
				    $to   = $_POST['to'];
			?>

			Members Payments :<?php
				    echo $from;
				?>   To : <?php
				    echo $to;
			?>

			<table class="table table-bordered datatable" id="table-1">
				<thead>
					<tr>
						<th>S.No</th>
						<th>Membership ID</th>
						<th>Name</th>
						<th>Age / Sex</th>
						<th>Join On</th>
                        <th>Expiry</th>
                        <th>Invoice No</th>
					</tr>
				</thead>
				<tbody>
					<?php
					    
					    
					    $query  = "select * from subsciption WHERE paid_date BETWEEN '$from' AND '$to'";
					    //echo $query;
					    $result = mysqli_query($con, $query);
					    $sno    = 1;
					    $total  = 0;
					    if (mysqli_affected_rows($con) != 0) {
					        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					            
					            
					            
					            echo "<tr><td>" . $sno . "</td>";
					            echo "<td>" . $row['mem_id'] . "</td>";
					            echo "<td>" . $row['name'] . "</td>";
					            echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
					            echo "<td>" . $row['expiry'] . "</td>";
					            echo "<td>" . $row['paid_date'] . "</td>";
					            echo "<td>" . $row['invoice'] . "</td>";
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
}

?>


