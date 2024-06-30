<?php
    if($_POST['sub']){
        $addrs = $_POST['address'];
        $geo_location = $_POST['geo_location'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $alter_phone = $_POST['alter_phone'];;
        $landmark = $_POST['landmark'];
        session_start();
        $user_id = $_SESSION['user_id'];
 
        require_once "../db/dbconnect.php";
        $qry = "INSERT INTO address VALUES ('', $user_id, '$addrs', '$geo_location', '$name', '$phone', '$alter_phone', '$landmark')";
        $res = $conn->query($qry);

        if($res){
            header("location:../services.php?");
        }else{
            echo "<h2 class='text-center'>Error || 404</h2>";
        }
    }else{
        echo "<h2 class='text-center'>Error || 404</h2>";
    }
?>