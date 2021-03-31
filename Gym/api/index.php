<?php
    require 'db_conn.php';
    integrity_check($con);
    $mount=$_POST['func'];
    unset($_POST['func']);
    $mount($con);
    
    // ------------------------------- Add your functions here -----------------------------

    function login($con){
        $resp['status']='success';
        $resp['data']='';
        $resp=json_encode($resp);
        echo $resp;
    }

    function dashboard($con){
        $date  = date('Y-m');
        $resp['data']=array();
        
        $query = "select * from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' ";
        $result  = mysqli_query($con, $query);
        $revenue = 0;
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue = $row['paid'] + $revenue;
            }
            $resp['data']['month_revenue']=$revenue;
        }

        $query = "select COUNT(*) from user_data WHERE wait='no' AND branch_id='$_POST[branch_id]' ";
        $result  = mysqli_query($con, $query);
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo $row['COUNT(*)'];
            }
            $resp['data']['month_revenue']=$revenue;
        }

        $query = "select * from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' ";
        $result  = mysqli_query($con, $query);
        $revenue = 0;
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue = $row['paid'] + $revenue;
            }
            $resp['data']['month_revenue']=$revenue;
        }

        $query = "select * from subsciption WHERE paid_date LIKE '$date%' AND branch_id='$_POST[branch_id]' ";
        $result  = mysqli_query($con, $query);
        $revenue = 0;
        if (mysqli_affected_rows($con) != 0) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $revenue = $row['paid'] + $revenue;
            }
            $resp['data']['month_revenue']=$revenue;
        }

        $resp['status']='success';
        $resp=json_encode($resp);
        echo $resp;
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