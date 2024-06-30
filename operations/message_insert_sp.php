<?php
    session_start();
    if(isset($_POST['sub'])){
        require_once "../db/dbconnect.php";
        $msg = $_POST["message"];
        $user_id = $_POST["user_id"];
        $sp_id = $_SESSION["sp_id"];
        // $date = date("Y-M-D H:i:s");
        $service_id = $_POST["service_id"];

        $sql = "INSERT INTO messages VALUES ('', $sp_id, $user_id, '$msg', TIMESTAMP(NOW()), 'sp' )" ;
        if($conn->query($sql)){
            header("location:../Service_Provider/booked_customer_single.php?id=$service_id");
        }
    }
?>