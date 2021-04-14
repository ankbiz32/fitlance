<?php
    require 'db_conn.php';
    integrity_check($con);
    $mount=$_POST['func'];
    unset($_POST['func']);
    $mount($con);
    
    // ------------------------------- Add your functions here -----------------------------

    function login($con){
        $sql          = "SELECT * FROM auth_user WHERE login_id='$_POST[username]' and pass_key='$_POST[pwd]'";
        $result       = mysqli_query($con, $sql);
        $info         = mysqli_fetch_assoc($result);

        $resp['status']='success';
        $resp['data']=$info;
        $resp=json_encode($resp);
        echo $resp;
    }

    function dashboard($con){
        $date  = date('Y-m');
        $resp['data']=array();
        
        $query = "select * from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND renewal='yes' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        $revenue=$rev_paid=$rev_bal = 0;
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['bal'] ;
            }
            $resp['data']['month_revenue']=$revenue;
            $resp['data']['month_paid']=$rev_paid;
            $resp['data']['month_bal']=$rev_bal;
        }
        else{
            $resp['data']['month_revenue']=0;
            $resp['data']['month_paid']=0;
            $resp['data']['month_bal']=0;
        }
        
        $query = "select * from trainer_pay WHERE join_date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND renewal='yes' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        $revenue=$rev_paid=$rev_bal = 0;
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['paybalance'] ;
            }
            $resp['data']['month_revenue_pt']=$revenue;
            $resp['data']['month_paid_pt']=$rev_paid;
            $resp['data']['month_bal_pt']=$rev_bal;
        }
        else{
            $resp['data']['month_revenue_pt']=0;
            $resp['data']['month_paid_pt']=0;
            $resp['data']['month_bal_pt']=0;
        }
        
        // $query = "select COUNT(*) from user_data WHERE joining LIKE '$date%' AND branch_id='$_SESSION[branch_id]' AND is_active='1' AND is_deleted='0'";
        $query = "select COUNT(*) from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND renewal='yes' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resp['data']['month_joining_mem']=$row['COUNT(*)'];
            }
        }
       
        $query = "select COUNT(*) from trainer_pay WHERE join_date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND renewal='yes' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $resp['data']['month_joining_pt']=$row['COUNT(*)'];
            }
        }
       
        $query = "select * from trainer WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $comission =0 ;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $comission += $row['paid'] ;
            }
            $resp['data']['comission_paid']=$comission;
        }
        else{
            $resp['data']['comission_paid']=0;
        }
       
        $query = "select * from expance WHERE date LIKE '$date%' AND branch_id='$_POST[branch_id]' AND is_active='1' ";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $exp =0 ;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $exp += $row['price'] ;
            }
            $resp['data']['expenses']=$exp;
        }
        else{
            $resp['data']['expenses']=0;
        }

        $resp['data']['date']=date('F-Y');
        $resp['status']='success';
        $resp=json_encode($resp);
        echo $resp;
    }

    function members($con){
        $resp['data']=array();
        
        $query = "select * from subsciption where renewal='yes' AND is_active='1' AND is_deleted='0' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $query1  = "select * from user_data WHERE newid='$row[mem_id]' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));

                $resp['data'][$c]['id']=$row['mem_id'];
                $resp['data'][$c]['name']=$row1['name'];
                $resp['data'][$c]['contact']=$row1['contact'];
                $resp['data'][$c]['balance']=$row['bal'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function memberDetails($con){
        $resp['data']=array();
        $id=$_POST['id'];
        
        $querym = "select * from user_data WHERE newid='$id'";
        $resultm  = mysqli_query($con, $querym);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($rowm = mysqli_fetch_array($resultm, MYSQLI_ASSOC)) {
                $query2  = "select * from workout_time WHERE id='".$rowm['workout_time_id']."'";
				$result2 = mysqli_query($con, $query2);
				$row2 = mysqli_fetch_array($result2);

                $resp['data']['mem_details'][$c]['id']=$id;
                $resp['data']['mem_details'][$c]['name']=$rowm['name'];
                $resp['data']['mem_details'][$c]['contact']=$rowm['contact'];
                $resp['data']['mem_details'][$c]['address']=$rowm['address'];
                $resp['data']['mem_details'][$c]['gender']=$rowm['sex'];
                $resp['data']['mem_details'][$c]['workout_time']=$row2['name'];
                $resp['data']['mem_details'][$c]['join_date']=date('d-m-Y',strtotime( $rowm['joining'] ));

                $c++;
            }

            $query  = "select * from subsciption WHERE mem_id='$id' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
                $c=0;
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $query3  = "select * from mem_types WHERE mem_type_id ='".$row['sub_type']."' AND is_active='1'";
                    $result3 = mysqli_query($con, $query3);
                    $row3 = mysqli_fetch_assoc($result3);

                    $date2 = date('d-m-Y',strtotime( $row['expiry'] ));
                    $date3 = date('d-m-Y',strtotime( $row['paid_date'] ));
                    $date4 = date('d-m-Y',strtotime( $row['pay_date'] ));
                    
                    $resp['data']['mem_plan'][$c]['plan_name']=$row['sub_type_name'];
                    $resp['data']['mem_plan'][$c]['join_date']=$date3;
                    $resp['data']['mem_plan'][$c]['exp_date']=$date2;
                    $resp['data']['mem_plan'][$c]['rate']=$row3['rate'];
                    $resp['data']['mem_plan'][$c]['disc']=$row['dis'];
                    $resp['data']['mem_plan'][$c]['paid']=$row['paid'];
                    $resp['data']['mem_plan'][$c]['bal']=$row['bal'];
                    $resp['data']['mem_plan'][$c]['payment_date']=$date4;

                    $c++;
				}
            }

            $query  = "select * from trainer_pay WHERE member_id='$id' AND is_active='1' ORDER BY id DESC";
			$result = mysqli_query($con, $query);
			if (mysqli_affected_rows($con) != 0) {
                $c=0;
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
                    $result2 = mysqli_query($con, $query2);
                    $row2 = mysqli_fetch_assoc($result2);
    
                    $date2 = date('d-m-Y',strtotime( $row['join_date'] ));
                    $date3 = date('d-m-Y',strtotime( $row['paid_date'] ));
                    $date4 = date('d-m-Y',strtotime( $row['expiry_date'] ));

                    $resp['data']['trainer'][$c]['name']=$row['staff_name'];
                    $resp['data']['trainer'][$c]['id']=$row['staff_id'];
                    $resp['data']['trainer'][$c]['plan_name']=$row2['name'];
                    $resp['data']['trainer'][$c]['plan_time']=$row2['time'];
                    $resp['data']['trainer'][$c]['join_date']=$date2;
                    $resp['data']['trainer'][$c]['exp_date']=$date4;
                    $resp['data']['trainer'][$c]['total']=$row['total'];
                    $resp['data']['trainer'][$c]['paid']=$row['paid'];

                    $c++;
				}
            }

            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function membersFilter($con){
        $resp['data']=array();
        $from=date('Y-m-d', strtotime($_POST["from"]));
        $to=date('Y-m-d', strtotime($_POST["to"]));

        if($_POST['type']=='joining_date'){
            $query = "select * from subsciption where renewal='yes' AND is_active='1' AND paid_date BETWEEN '$from' AND '$to'  AND is_deleted='0' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        } else{
            $query = "select * from subsciption where renewal='yes' AND is_active='1' AND expiry BETWEEN '$from' AND '$to'  AND is_deleted='0' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        }
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $query1  = "select * from user_data WHERE newid='$row[mem_id]' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));

                $resp['data'][$c]['id']=$row['mem_id'];
                $resp['data'][$c]['name']=$row1['name'];
                $resp['data'][$c]['contact']=$row1['contact'];
                $resp['data'][$c]['balance']=$row['bal'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;
                $c++;
            }
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function trainersAssigned($con){
        $resp['data']=array();
        
        $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND is_deleted='0' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        $revenue = 0;
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                
                $msgid = $row['invoice'];
                $date1 = date('d-m-Y',strtotime( $row['join_date'] ));
                $date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));

                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['mem_id']=$row['member_id'];
                $resp['data'][$c]['pt_name']=$row['staff_name'];
                $resp['data'][$c]['balance']=$row['paybalance'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function trainersFilter($con){
        $resp['data']=array();
        $from=date('Y-m-d', strtotime($_POST["from"]));
        $to=date('Y-m-d', strtotime($_POST["to"]));

        if($_POST['type']=='joining_date'){
            $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND is_deleted='0' AND branch_id = '$_POST[branch_id]' AND join_date BETWEEN '$from' AND '$to' ORDER BY id DESC";
        } else{
            $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND is_deleted='0' AND branch_id = '$_POST[branch_id]' AND expiry_date BETWEEN '$from' AND '$to' ORDER BY id DESC";
        }
        
        $result  = mysqli_query($con, $query);
        $revenue = 0;
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $query2  = "select * from trainer_types WHERE staff_type_id='".$row['trainer_type_id']."'";
                $result2 = mysqli_query($con, $query2);
                $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
                
                $date1 = date('d-m-Y',strtotime( $row['join_date'] ));
                $date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));

                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['mem_id']=$row['member_id'];
                $resp['data'][$c]['pt_name']=$row['staff_name'];
                $resp['data'][$c]['balance']=$row['paybalance'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function expenses($con){
        $resp['data']=array();
        
		$query  = "select * from expance where branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $date1 = date('d-m-Y', strtotime( $row['date'] ));
                $resp['data'][$c]['item']=$row['item'];
                $resp['data'][$c]['cost']=$row['price'];
                $resp['data'][$c]['date']=$date1;

                $c++;
            }
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function commission($con){
        $resp['data']=array();
        
		$query  = "select * from trainer where branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $date = date('d-m-Y',strtotime( $row['paid_date'] ));

                $resp['data'][$c]['id']=$row['id'];
                $resp['data'][$c]['pt_name']=$row['trainer_name'];
                $resp['data'][$c]['pt_id']=$row['trainer_id'];
                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['pay_date']=$date;

                $c++;
            }
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function commissionDetail($con){
        $resp['data']=array();
        $id=$_POST['id'];
		$query  = "select * from trainer where branch_id = '$_POST[branch_id]' AND id='$id' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $date = date('d-m-Y',strtotime( $row['paid_date'] ));

                $resp['data'][$c]['pt_name']=$row['trainer_name'];
                $resp['data'][$c]['pt_id']=$row['trainer_id'];
                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['mem_id']=$row['member_id'];
                $resp['data'][$c]['sess_name']=$row['session_name'];
                $resp['data'][$c]['sess_from']=$row['session_from'];
                $resp['data'][$c]['sess_to']=$row['session_to'];
                $resp['data'][$c]['total']=$row['total_amount'];
                $resp['data'][$c]['percent']=$row['percentage'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['invoice']=$row['invoice'];
                $resp['data'][$c]['pay_date']=$date;
                
                $c++;
            }
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function commissionFilter($con){
        $resp['data']=array();
        
        $from=date('Y-m-d', strtotime($_POST["from"]));
        $to=date('Y-m-d', strtotime($_POST["to"]));

        $query  = "select * from trainer where branch_id = '$_POST[branch_id]' AND paid_date BETWEEN '$from' AND '$to' ORDER BY id DESC";
        
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $date = date('d-m-Y',strtotime( $row['paid_date'] ));

                $resp['data'][$c]['id']=$row['id'];
                $resp['data'][$c]['pt_name']=$row['trainer_name'];
                $resp['data'][$c]['pt_id']=$row['trainer_id'];
                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['pay_date']=$date;

                $c++;
            }
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }


    function membersMonthRev($con){
        $resp['data']=array();
        $revenue=$rev_paid=$rev_bal = 0;
        $date  = date('Y-m');
        $query  = "select * from subsciption where renewal='yes' AND is_active='1' AND is_deleted='0' AND paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['bal'] ;

                $query1  = "select * from user_data WHERE newid='$row[mem_id]' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));

                $resp['data'][$c]['id']=$row['mem_id'];
                $resp['data'][$c]['name']=$row1['name'];
                $resp['data'][$c]['contact']=$row1['contact'];
                $resp['data'][$c]['total']=$row['total'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['balance']=$row['bal'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['month_revenue']=$revenue;
            $resp['month_paid']=$rev_paid;
            $resp['month_bal']=$rev_bal;
            $resp['month']=date('F-Y');
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function trainersMonthRev($con){
        $resp['data']=array();
         $date  = date('Y-m');
     //   $date  = '2021-03';
        $revenue=$rev_paid=$rev_bal = 0;
        $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND join_date LIKE '$date%' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['paybalance'] ;
        
                $date1 = date('d-m-Y',strtotime( $row['join_date'] ));
                $date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));

                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['mem_id']=$row['member_id'];
                $resp['data'][$c]['pt_name']=$row['staff_name'];
                $resp['data'][$c]['total']=$row['total'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['balance']=$row['paybalance'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['month_revenue_pt']=$revenue;
            $resp['month_paid_pt']=$rev_paid;
            $resp['month_bal_pt']=$rev_bal;
            $resp['month']=date('F-Y');
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function expensesMonth($con){
        $resp['data']=array();
        $date  = date('Y-m');
		$query  = "select * from expance where branch_id = '$_POST[branch_id]' AND date LIKE '$date%' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $exp =0 ;
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $exp += $row['price'] ;

                $date1 = date('d-m-Y', strtotime( $row['date'] ));
                $resp['data'][$c]['item']=$row['item'];
                $resp['data'][$c]['cost']=$row['price'];
                $resp['data'][$c]['date']=$date1;

                $c++;
            }
            $resp['total_expenses']=$exp;
            $resp['month']=date('F-Y');
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function commissionMonth($con){
        $resp['data']=array();
        $dateM  = date('Y-m');
        $comission =0 ;
		$query  = "select * from trainer where branch_id = '$_POST[branch_id]' AND paid_date LIKE '$dateM%'  ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $comission += $row['paid'] ;

                $date = date('d-m-Y',strtotime( $row['paid_date'] ));

                $resp['data'][$c]['id']=$row['id'];
                $resp['data'][$c]['pt_name']=$row['trainer_name'];
                $resp['data'][$c]['pt_id']=$row['trainer_id'];
                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['pay_date']=$date;

                $c++;
            }
            $resp['total_comission']=$comission;
            $resp['month']=date('F-Y');
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function membersMonthRevfilter($con){
        $resp['data']=array();
        $revenue=$rev_paid=$rev_bal = 0;
        $frm='01-'.$_POST['from'];
        $date  = date('Y-m' , strtotime($frm));
        $query  = "select * from subsciption where renewal='yes' AND is_active='1' AND is_deleted='0' AND paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['bal'] ;

                $query1  = "select * from user_data WHERE newid='$row[mem_id]' AND is_active='1'";
				$result1 = mysqli_query($con, $query1);
				$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
				
				$date1 = date('d-m-Y',strtotime( $row['paid_date'] ));
				$date2 = date('d-m-Y',strtotime( $row['expiry'] ));

                $resp['data'][$c]['id']=$row['mem_id'];
                $resp['data'][$c]['name']=$row1['name'];
                $resp['data'][$c]['contact']=$row1['contact'];
                $resp['data'][$c]['total']=$row['total'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['balance']=$row['bal'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;
                
                $c++;

            }
            $resp['month_revenue']=$revenue;
            $resp['month_paid']=$rev_paid;
            $resp['month_bal']=$rev_bal;
            $resp['month']=date('F-Y' , strtotime($date));
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function trainersMonthRevfilter($con){
        $resp['data']=array();
        $frm='01-'.$_POST['from'];
        $revenue=$rev_paid=$rev_bal = 0;
        $date  = date('Y-m' , strtotime($frm));
        $query  = "select * from trainer_pay where renewal='yes' AND is_active='1' AND join_date LIKE '$date%' AND branch_id = '$_POST[branch_id]' ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue += $row['total'] ;
                $rev_paid += $row['paid'];
                $rev_bal += $row['paybalance'] ;

                $date1 = date('d-m-Y',strtotime( $row['join_date'] ));
                $date2 = date('d-m-Y',strtotime( $row['expiry_date'] ));

                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['mem_id']=$row['member_id'];
                $resp['data'][$c]['pt_name']=$row['staff_name'];
                $resp['data'][$c]['total']=$row['total'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['balance']=$row['paybalance'];
                $resp['data'][$c]['join_date']=$date1;
                $resp['data'][$c]['exp_date']=$date2;

                $c++;
            }
            $resp['month_revenue_pt']=$revenue;
            $resp['month_paid_pt']=$rev_paid;
            $resp['month_bal_pt']=$rev_bal;
            $resp['month']=date('F-Y' , strtotime($date));
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }

    function commissionMonthfilter($con){
        $resp['data']=array();
        $frm='01-'.$_POST['from'];
        $comission =0 ;
        $dateM  = date('Y-m' , strtotime($frm));
		$query  = "select * from trainer where branch_id = '$_POST[branch_id]' AND paid_date LIKE '$dateM%'  ORDER BY id DESC";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            $c=0;
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $comission += $row['paid'] ;

                $date = date('d-m-Y',strtotime( $row['paid_date'] ));

                $resp['data'][$c]['id']=$row['id'];
                $resp['data'][$c]['pt_name']=$row['trainer_name'];
                $resp['data'][$c]['pt_id']=$row['trainer_id'];
                $resp['data'][$c]['mem_name']=$row['member_name'];
                $resp['data'][$c]['paid']=$row['paid'];
                $resp['data'][$c]['pay_date']=$date;

                $c++;
            }
            $resp['total_comission']=$comission;
            $resp['month']=date('F-Y' , strtotime($dateM));
            $resp['count']=count($resp['data']);
            $resp['status']='success';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='No data found';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }
   
    // ------------------------------- //Add your functions above ----------------------------- //
    function integrity_check($con)
    {
        if (isset($_POST['username'])){
            $user_id_auth = mysqli_real_escape_string($con, $_POST['username']);
            $pass_key     = mysqli_real_escape_string($con, $_POST['pwd']);
            $sql          = "SELECT * FROM auth_user WHERE login_id='$user_id_auth' and pass_key='$pass_key'";
            $result       = mysqli_query($con, $sql);
            $count        = mysqli_num_rows($result);
            $info         = mysqli_fetch_assoc($result);

            $login_id     = $info['login_id'];
            $branch_id    = $info['branch_id'];
            $name         = $info['name'];

            if(!$count){
                $resp['status']='error';
                $resp['error_msg']='Invalid Username or Password';
                $resp=json_encode($resp);
                echo $resp;
                exit;
            }
        }
        else{
            $resp['status']='error';
            $resp['error_msg']='Bad request';
            $resp=json_encode($resp);
            echo $resp;
            exit;
        }
    }
?>