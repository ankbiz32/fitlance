<style>
        tfoot th{
            color:#111 !important;
            font-size:12px !important;
        }
    </style>
    <div class="table-responsive">
	<div style="display:flex">
        <div class="col-sm-8">
                <?php if(isset($_GET['mnth']) && isset($_GET['yr'])){
                    $m=$_GET['mnth'];
                    $y=$_GET['yr'];
                    $d=$y.'-'.$m.'-01';
                        echo'<h4 class="hed">Income for month '.date('F-Y', strtotime("$d"));
                    }
                    else{
                        echo'<h4 class="hed">Income for month '.date('F-Y');
                    }
                ?>
            </h4>
            <p>From PT payments</p>
            <br>
            <form action='index.php' method='get'>
                <span>Filter by joining date for month: &emsp;</span>
                <input type="hidden" name="vis" value="paid_income_month_pt">
                <select name="mnth" id="">
                    <?php if(!isset($_GET['mnth'])){ ?>
                        <option value="<?php echo date('m')?>" selected hidden><?php echo date('F')?></option>
                    <?php }?>
                    <option value="01" <?=isset($_GET['mnth']) && $_GET['mnth']=='01'?' selected':''?>>January</option>
                    <option value="02" <?=isset($_GET['mnth']) && $_GET['mnth']=='02'?' selected':''?>>February</option>
                    <option value="03" <?=isset($_GET['mnth']) && $_GET['mnth']=='03'?' selected':''?>>March</option>
                    <option value="04" <?=isset($_GET['mnth']) && $_GET['mnth']=='04'?' selected':''?>>April</option>
                    <option value="05" <?=isset($_GET['mnth']) && $_GET['mnth']=='05'?' selected':''?>>May</option>
                    <option value="06" <?=isset($_GET['mnth']) && $_GET['mnth']=='06'?' selected':''?>>June</option>
                    <option value="07" <?=isset($_GET['mnth']) && $_GET['mnth']=='07'?' selected':''?>>July</option>
                    <option value="08" <?=isset($_GET['mnth']) && $_GET['mnth']=='08'?' selected':''?>>August</option>
                    <option value="09" <?=isset($_GET['mnth']) && $_GET['mnth']=='09'?' selected':''?>>September</option>
                    <option value="10" <?=isset($_GET['mnth']) && $_GET['mnth']=='10'?' selected':''?>>October</option>
                    <option value="11" <?=isset($_GET['mnth']) && $_GET['mnth']=='11'?' selected':''?>>November</option>
                    <option value="12" <?=isset($_GET['mnth']) && $_GET['mnth']=='12'?' selected':''?>>December</option>
                </select>
                <select name="yr" id="">
                    <?php if(!isset($_GET['yr'])){ ?>
                        <option value="<?php echo date('Y')?>" selected hidden><?php echo date('Y')?></option>
                    <?php }?>
                    <option value="2015" <?=isset($_GET['yr']) && $_GET['yr']=='2015'?' selected':''?>>2015</option>
                    <option value="2016" <?=isset($_GET['yr']) && $_GET['yr']=='2016'?' selected':''?>>2016</option>
                    <option value="2017" <?=isset($_GET['yr']) && $_GET['yr']=='2017'?' selected':''?>>2017</option>
                    <option value="2018" <?=isset($_GET['yr']) && $_GET['yr']=='2018'?' selected':''?>>2018</option>
                    <option value="2019" <?=isset($_GET['yr']) && $_GET['yr']=='2019'?' selected':''?>>2019</option>
                    <option value="2020" <?=isset($_GET['yr']) && $_GET['yr']=='2020'?' selected':''?>>2020</option>
                    <option value="2021" <?=isset($_GET['yr']) && $_GET['yr']=='2021'?' selected':''?>>2021</option>
                    <option value="2022" <?=isset($_GET['yr']) && $_GET['yr']=='2022'?' selected':''?>>2022</option>
                    <option value="2023" <?=isset($_GET['yr']) && $_GET['yr']=='2023'?' selected':''?>>2023</option>
                    <option value="2024" <?=isset($_GET['yr']) && $_GET['yr']=='2024'?' selected':''?>>2024</option>
                    <option value="2025" <?=isset($_GET['yr']) && $_GET['yr']=='2025'?' selected':''?>>2025</option>
                </select>
                <input type='submit' value='Submit' class='btn btn-green btn-sm '/>
                <a class="btn btn-sm btn-blue" href="index.php?vis=paid_income_month_pt">Reset</a>
            </form>
        </div>
    </div>
	<hr />
	<table class="table table-bordered datatable" id="table-12">
		<thead>
			<tr>
                <th>S.No.</th>
                <th>Member Name / ID</th>
                <th>Trainer Name / ID</th>
                <th style="width:100px;">Join Date/ <br>Expiry Date </th>
                <th>Session</th>
                <th>Payable</th>
                <th>Paid</th>
                <th>Balance</th>
			</tr>
		</thead>
		<tbody>
		<?php
            if(isset($_GET['mnth']) && isset($_GET['yr'])){
                $m=$_GET['mnth'];
                $y=$_GET['yr'];
                $d=$y.'-'.$m;
                $date  = $d;
            }
            else{
                $date  = date('Y-m');
            }
            $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND paid_date LIKE '$date%' AND branch_id = '$_SESSION[branch_id]' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
		    $sno    = 1;
			if (mysqli_affected_rows($con) != 0) {
                $total=$paid=$bal=0; 
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $stafid = $row['id'];
                    $id = $row['insert_by'];
                    $query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
                    $result2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                    $msgid = $row['invoice'];
                    $date1 = date('d-m-Y',strtotime( $row['join_date'] ));
                    $date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));
                    echo "<tr><td>" . $sno . "</td>";
                    echo "<td>" . $row['member_name'] . " / " . $row['member_id'] . "</td>";
                    echo "<td>" . $row['staff_name'] . " / " . $row['staff_id'] . "</td>";
                    echo "<td style='white-space:nowrap'>" . $date1 . " / <br>" . $date2 . "</td>";
                    echo "<td>" . $row2['name']. "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td>" . $row['paid'] . "</td>";
                    echo "<td>" . $row['paybalance'] . "</td>";
                    $total+=$row['total'];
                    $paid+=$row['paid'];
                    $bal+=$row['paybalance'];
                    $sno++;

				}
                echo "
                <tfoot>
                <tr>
                    <th></th>";					
                    echo "<th><strong>TOTAL</strong></th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "<th></th>";
                    echo "<th><strong>".$total."</strong></th>";
                    echo "<th><strong>".$paid."</strong></th>";
                    echo "<th><strong>".$bal."</strong></th>";
                    echo" 
                </tr>
                </tfoot>";
			}

        ?>
		</tbody>
	</table>
	</div>
	
<script type="text/javascript">
jQuery(document).ready(function($)
{
$("#table-12").dataTable({
    "sPaginationType": "bootstrap",
    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "bStateSave": true,
    'dom': 'Brtip',
    'buttons': [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ]
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