<?php
    session_start();
    if(isset($_POST['sub'])){
        require_once "../db/dbconnect.php";
        $msg = $_POST["message"];
        $sp_id = $_POST["sp_id"];
        $user_id = $_SESSION["user_id"];
        // $date = date("Y-M-D H:i:s");
        $service_id = $_POST["service_id"];

        $sql = "INSERT INTO messages VALUES ('', $sp_id, $user_id, '$msg', TIMESTAMP(NOW()), 'user' )" ;
        if($conn->query($sql)){
            header("location:../single_book_details.php?id=$service_id");
        }
    }
?>