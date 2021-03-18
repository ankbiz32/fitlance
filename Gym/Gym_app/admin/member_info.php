<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
a {color: #2652a5;}
</style>
    <?php 
    if (isset($_GET['name'])) { ?>
    <b>Member Details of : -  <?php
    $id     = $_GET['name'];
    $query  = "select * from user_data WHERE newid='$id'";
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
                <th>Member Name / Id</th>
                <th>Address / Contact</th>
                <th>Email / Birth Date</th>
                <th>Sex / Workout Time</th>
                <th>Join On</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $query  = "select * from user_data WHERE newid='$id'";
            $result = mysqli_query($con, $query);
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $newid = $row['insert_by'];
                $msgid = $row['newid'];

                $query1  = "select * from auth_user WHERE id='$newid'";
                $result1 = mysqli_query($con, $query1);

                $query2  = "select * from workout_time WHERE id='".$row['workout_time_id']."'";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_array($result2);

                    $date1 = date('d-m-Y',strtotime( $row['joining'] ));
                    $date2 = date('d-m-Y',strtotime( $row['birthdate'] ));
                    echo "<tr><td>" . $row['name'] . " / " . $row['newid'] . "</td>";
                    echo "<td>" . $row['address'] . " / " . $row['contact'] . "</td>";
                    echo "<td>" . $row['email'] . " / " . $date2 . "</td>";
                    echo "<td>" . $row['sex'] . " / " . $row2['name'] . "</td>";
                    echo "<td>" . $date1 . "</td></tr>";
                }
            }
        ?>	
        </tbody>
    </table>
    </div>

    <b>Membership Plan Details of : -  <?php
	$id     = $_GET['name'];
	$query  = "select * from user_data WHERE newid='$id'";
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
				<th>Member Name / Id</th>
				<th>Membership Plan</th>
				<th>Join Date / Expiry Date</th>
				<th>Total / Discount</th>
				<th>Paid / Balance</th>
				<th>Payment Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$memid  = $_GET['name'];
			$query  = "select * from subsciption WHERE mem_id='$memid' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['invoice'];

				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));
				$date3 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date4 = date('d-m-Y',strtotime( $row['pay_date'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['name'] . " / " . $memid. "</td>";
					echo "<td>" . $row['sub_type_name'] . "</td>";
					echo "<td>" . $date3 . " / " . $date2 . "</td>";
					echo "<td>" . $row['total'] . " / " . $row['dis'] . "</td>";
					echo "<td>" . $row['paid'] . " / " . $row['bal'] . "</td>";
					echo "<td>" . $date4  . "</td></tr>";
				$sno++;
				$msgid = 0;
				}
			}
		?>							
		</tbody>
	</table>
	</div>

	<b>Personal Trainer Details of : -  <?php
	$id     = $_GET['name'];
	$query  = "select * from user_data WHERE newid='$id'";
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
				<th>Member Name / Id</th>
				<th>Trainer Name / Id</th>
				<th>Trainer Plan</th>
				<th>Join Date</th>
				<th>Total / Paid</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$memid  = $_GET['name'];
			$query  = "select * from trainer_pay WHERE member_id='$memid' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$msgid = $row['invoice'];

				$query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
			    $result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_assoc($result2);

				$date2 = date('d-m-Y',strtotime( $row['join_date'] ));
				$date3 = date('d-m-Y',strtotime( $row['paid_date'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['member_name'] . " / " . $memid. "</td>";
					echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
					echo "<td>" . $row2['name'] . " / " . $row2['time'] . "</td>";
					echo "<td>" . $date2  . "</td>";
					echo "<td>" . $row['total'] . " / " . $row['paid'] . "</td></tr>";
				$sno++;
				$msgid = 0;
				}
			}
		?>							
		</tbody>
	</table>
	</div>


<?php } ?>

