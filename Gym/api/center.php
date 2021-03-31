

    <div class="row">
        <div class="col-sm-3">			
        <div class="tile-stats tile-red">
        <div class="icon"><i class="entypo-users"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <h2>Paid Income This Month</h2><br>	
            <?php
            $date  = date('Y-m');
            $query = "select * from subsciption WHERE  paid_date LIKE '$date%' AND branch_id='$_SESSION[branch_id]' ";
            $result  = mysqli_query($con, $query);
            $revenue = 0;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $revenue = $row['paid'] + $revenue;
                }
            }
            echo $revenue;
            ?>
        </div>
        </div>
        </div>

        <div class="col-sm-3">			
        <div class="tile-stats tile-green">
        <div class="icon"><i class="entypo-chart-bar"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <h2>Total <br>Members</h2><br>	
            <?php
            $date  = date('Y-m');
            $query = "select COUNT(*) from user_data WHERE wait='no' AND branch_id='$_SESSION[branch_id]' ";
            $result = mysqli_query($con, $query);
            $i      = 1;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo $row['COUNT(*)'];
                }
            }
            $i = 1;
            ?>
        </div>
        </div>
        </div>	

        <div class="col-sm-3">			
        <div class="tile-stats tile-aqua">
        <div class="icon"><i class="entypo-mail"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <h2>Joined This Month</h2><br>	
            <?php
            $date  = date('Y-m');
            $query = "select COUNT(*) from user_data WHERE joining LIKE '$date%' AND branch_id='$_SESSION[branch_id]'";
            $result = mysqli_query($con, $query);
            $i      = 1;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo $row['COUNT(*)'];
                }
            }
            $i = 1;
            ?>
        </div>
        </div>			
        </div>

        <div class="col-sm-3">			
        <div class="tile-stats tile-blue">
        <div class="icon"><i class="entypo-rss"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <h2>Income This Month</h2><br>	
            <?php
            $date  = date('Y-m');
            $query = "select * from subsciption WHERE  paid_date LIKE '$date%' AND branch_id='$_SESSION[branch_id]'";
            $result  = mysqli_query($con, $query);
            $revenue = 0;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $revenue = $row['total'] + $revenue;
                }
            }
            echo $revenue;
            ?>
        </div>
        </div>
        </div>

        <div class="col-sm-3">			
        <div class="tile-stats tile-blue">
        <div class="icon"><i class="entypo-rss"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <h2>Balance This Month</h2><br>	
            <?php
            $date  = date('Y-m');
            $query = "select * from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_SESSION[branch_id]' ";
            $result  = mysqli_query($con, $query);
            $revenue = 0;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $revenue = $row['bal'] + $revenue;
                }
            }
            echo $revenue;
            ?>
        </div>
        </div>
        </div>

        <div class="col-sm-3">			
        <div class="tile-stats tile-aqua">
        <div class="icon"><i class="entypo-rss"></i></div>
        <div class="num" data-postfix="" data-duration="1500" data-delay="0">
            <a href="?vis=birthday_view"><h2>Today Member Birthday</h2></a><br>	
            <?php
            $query = "SELECT COUNT(*) FROM user_data WHERE MONTH(birthdate)= MONTH(NOW()) AND DAY(birthdate)=DAY(NOW()) AND branch_id='$_SESSION[branch_id]' ";
            //echo $query;
            $result  = mysqli_query($con, $query);
            $i       = 1;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $name = $row['name'];
                    echo $row['COUNT(*)'];
                }
            }
            else{
                echo '0';
            }
            $i = 1;
            ?>
        </div>
        </div>
        </div>
    </div>
    <hr />

    <h4 class="hed">Todays Follow Up</h4>
    <hr />
    <div class="table-responsive">
	<table class="table table-bordered datatable" id="table-1">
		<thead>
			<tr>
				<th>S.No</th>
				<th>Name</th>
				<th>Address / Contact</th>
				<th>Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
        $currentdate = date('Y/m/d'); 
        $echo . $currentdate;
        $query = "SELECT * FROM `follow` WHERE '$currentdate' =joining AND branch_id='$_SESSION[branch_id]' ORDER BY id DESC";
		$result = mysqli_query($con, $query);
		$sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$msgid = $row['id'];
					$joining = $row['joining'];
					$status = $row['status'];
					$date1 = date('d-m-Y', strtotime( $row['joining'] ));
					echo "<tr><td>" . $sno . "</td>";
					echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['address'] . " / " . $row['contact'] . "</td>";
					echo "<td>" . $date1 . "</td>";
                    if($status == 0){
						echo"<td><form action='index.php?vis=add_member' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Add Member' class='btn btn-info btn-sm pull-left'/></form>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit='return ConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}else{
						echo"<td><input type='submit' value='Transfer Member' class='btn btn-success btn-sm pull-left'/>
						<form action='index.php?vis=edit_follow' method='post'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Edit' class='btn btn-warning btn-sm pull-left'/></form>
						<form action='del_follow.php' method='post' onSubmit=' returnConfirmDelete();'><input type='hidden' name='name' value='" . $msgid . "'/><input type='submit' value='Delete 'class='btn btn-danger btn-sm pull-left'/></form>
						</td></tr>";
					}
					$sno++; 
					$msgid = 0;
				}
			}
		?>									
		</tbody>
	</table>
    </div>


