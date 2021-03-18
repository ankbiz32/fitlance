			<b>Details of : -  <?php
			$id     = $_POST['name'];
			$query  = "select * from user_data WHERE newid='$id'";
			//echo $query;
			$result = mysqli_query($con, $query);

			if (mysqli_affected_rows($con) != 0) {
			    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			        $name = $row['name'];
			        echo strtoupper($name);
			    }
			}
			?></b>

		<hr />
		<div class="table-responsive">
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>Image</th>
					<th>Membership ID</th>
					<th>Name</th>
					<th>Age / Sex</th>
					<th>Join On</th>
				</tr>
			</thead>
				<tbody>
					<?php
					$query  = "select * from user_data WHERE newid='$id'";
					//echo $query;
					$result = mysqli_query($con, $query);
					if (mysqli_affected_rows($con) != 0) {
					    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	        
					        
					        
					        echo "<tr><td><img src='" . $row['pic_add'] . "'></td>";
					        echo "<td>" . $row['newid'] . "</td>";
					        echo "<td>" . $row['name'] . "</td>";
					        echo "<td>" . $row['age'] . " / " . $row['sex'] . "</td>";
					        echo "<td>" . $row['joining'] . "</td></tr>";
					    }

					}
					?>								
				</tbody>
		</table>
        </div>
				<b>Details of : -  <?php
				$id     = $_POST['name'];
				$query  = "select * from user_data WHERE newid='$id'";
				//echo $query;
				$result = mysqli_query($con, $query);

				if (mysqli_affected_rows($con) != 0) {
				    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				        $name = $row['name'];
				        echo strtoupper($name);
				    }
				}
				?></b>
                <hr />
        <div class="table-responsive">
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
					<th>S.No</th>
					<th>Name</th>
					<th>Membership</th>
					<th>Payment Date</th>
					<th>Total  / Paid</th>
					<th>Invoice</th>
					<th>Membership Expiry</th>
					<th style="width: 280px !important;">Action</th>
				</tr>
			</thead>
				<tbody>
					<?php
						$memid  = $_POST['name'];
						$query  = "select * from subsciption WHERE mem_id='$memid'";
						//echo $query;
						$result = mysqli_query($con, $query);
						$sno    = 1;

						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						        $msgid = $row['invoice'];
						        echo "<td>" . $sno . "</td>";
						        echo "<td>" . $row['name'] . "</td>";
						        echo "<td>" . $row['sub_type_name'] . "</td>";
						        echo "<td>" . $row['paid_date'] . "</td>";
						        echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td>";
						        echo "<td>" . $row['invoice'] . "</td>";
						        echo "<td>" . $row['expiry'] . "</td>";
						        
						        $sno++;
						        
						        echo "<td><form action='gen_invoice.php' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Print Invoice ' class='btn btn-info btn-sm pull-left'/></form><form action='index.php?vis=edit_invoice' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit Invoice ' class='btn btn-warning btn-sm pull-left'/></form><form action='del_invoice.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete Invoice ' class='btn btn-danger btn-sm pull-left'/></form></td></tr>";
						        $msgid = 0;
						    }
						    
						}

					?>							
				</tbody>
		</table>
        </div>
             <b>Health Status of : -   <?php
				$id     = $_POST['name'];
				$query  = "select * from user_data WHERE newid='$id'";
				//echo $query;
				$result = mysqli_query($con, $query);

				if (mysqli_affected_rows($con) != 0) {
				    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				        $name = $row['name'];
				        echo strtoupper($name);
				    }
				}
				?></b>
                <hr />
        <div class="table-responsive">
		<table class="table table-bordered datatable" id="table-1">
			<thead>
				<tr>
				<th>#</th>
                <th>Date</th>
                <th>Body Fat</th>
                <th>Water</th>
                <th>Muscle</th>
                <th>Calorie</th>
                <th>Bone</th>
                <th>Remarks</th>
				</tr>
			</thead>
				<tbody>
					<?php
					$memid  = $_POST['name'];
						$query  = "select * from healthstatus as health join user_data as users on users.id=health.id";
						//echo $query;
						$result = mysqli_query($con, $query);
						$sno    = 1;

						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						        $msgid = $row['hs_id'];
								echo "<tr>";
						        echo "<td>" . $sno . "</td>";
								echo "<td>" . $row['date1'] . "</td>";
						        echo "<td>" . $row['bodyfat'] . "</td>";
						        echo "<td>" . $row['water'] . "</td>";
						        echo "<td>" . $row['muscle'] . "</td>";
						        echo "<td>" . $row['calorie'] . "</td>";
						        echo "<td>" . $row['bone'] . "</td>";
						        echo "<td>" . $row['remarks'] . "</td>";
						        echo "</tr>";
						        $sno++;
						        $msgid = 0;
						    }
						    
						}

					?>							
				</tbody>
		</table>
        </div>
        
    

