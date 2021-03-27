    <div class="col-md-12 col-sm-12 clearfix">
    <ul class="list-inline links-list pull-left">
        <li><a href="?vis=new_entry" class="btn btn-success btn-sm">+ Add new member</a></li>
        <li><a href="?vis=view_mem" class="btn btn-info btn-sm">Active Members</a></li>
        <li><a href="?vis=view_mem_inactive" class="btn btn-success btn-sm">Inactive Members</a></li>
        <li><a href="?vis=unpaid" class="btn btn-info btn-sm">Pending payments of members</a></li>
        <li><a href="?vis=sub_end" class="btn btn-success btn-sm">Ending Membership</a></li>
        <li><a href="?vis=add_enquiry2" class="btn btn-info btn-sm">Enquiry Form</a></li>
        <!-- <li><a href="?vis=view_renewal" class="btn btn-success btn-sm">Renewal Membership</a></li> -->
        <li><a href="?vis=unpaid_trainer" class="btn btn-info btn-sm">Due Payments of Personal Trainers</a></li>
    </ul>
    <!-- <ul class="list-inline links-list pull-left">
        <li><a href="?vis=renewal_trainer" class="btn btn-success btn-sm">Renewal Personal Trainers</a></li>
    </ul> -->
    </div>
    <hr />

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
            $query = "select COUNT(*) from user_data WHERE wait='no'";
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
            $query = "select COUNT(*) from user_data WHERE joining LIKE '$date%'";
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
            $query = "select * from subsciption WHERE  paid_date LIKE '$date%'";
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
            $query = "select * from subsciption WHERE paid_date LIKE '$date%'";
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
            $query = "SELECT COUNT(*) FROM user_data WHERE MONTH(birthdate)= MONTH(NOW()) AND DAY(birthdate)=DAY(NOW());";
            //echo $query;
            $result  = mysqli_query($con, $query);
            $i       = 1;
            if (mysqli_affected_rows($con) != 0) {
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $name = $row['name'];
                    echo $row['COUNT(*)'];
                }
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
        $query = "SELECT * FROM `follow` WHERE '$currentdate' =joining  ORDER BY id DESC";
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

<style>
.hed{padding-left:10px; font-weight:bolder; color:#960;}
</style>

<script type="text/javascript">
jQuery(document).ready(function($)
{
	$("#table-1").dataTable({
		"sPaginationType": "bootstrap",
		"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"bStateSave": true
	});
	
	$(".dataTables_wrapper select").select2({
		minimumResultsForSearch: -1
	});
});
</script>

<link rel="stylesheet" href="../../vishnu/js/select2/select2-bootstrap.css"  id="style-resource-1">
<link rel="stylesheet" href="../../vishnu/js/select2/select2.css"  id="style-resource-2">
<script src="../../vishnu/js/jquery.dataTables.min.js" id="script-resource-7"></script>
<script src="../../vishnu/js/dataTables.bootstrap.js" id="script-resource-8"></script>
<script src="../../vishnu/js/select2/select2.min.js" id="script-resource-9"></script>



