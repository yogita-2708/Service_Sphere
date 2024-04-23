<?php
    if($_POST['sub']){
        $address_id = $_POST['address'];
        $start_otp = $_POST['start_otp'];
        $slot = $_POST['slot'];
        $start_time = 0;
        $end_time = 0;
        $date = date('Y-m-d');
        $end_otp = null;
        $total_price = $_POST['total_price'];
        session_start();
        $user_id = $_SESSION['user_id'];
        $sp_id = $_POST['sp_id'];
        $service_id = $_POST['service_id'];
        require_once "../db/dbconnect.php";
        $qry = "INSERT INTO booking VALUES ('', $user_id, $service_id, '$date', '$start_time', '$end_time', '$start_otp', '$end_otp', $address_id, $total_price, $slot, $sp_id)";
        $res = $conn->query($qry);

        if($res){
            header("location:../services.php?");
        }else{
            echo "<h2 class='text-center'>Error || 404</h2>";
            echo $conn->error;
        }
    }else{
        echo "<h2 class='text-center'>Error || 404</h2>";
        echo $conn->error;
    }
?>