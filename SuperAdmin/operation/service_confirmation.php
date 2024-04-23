<?php
    require_once "..\Database\db_connection.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sp_id = $_GET['sp_id'];
        $qry1 = "UPDATE service_service_provider SET status = 'YES' WHERE service_id = $id AND sp_id = $sp_id";
        $qry2 = "UPDATE services SET s_status = 'YES' WHERE service_id = $id";
        if($conn->query($qry1) && $conn->query($qry2)){
            header("location:../component/service_confirm.php");
        }else{
            echo "Error | 404";
        }
    }else{
        echo "Error | 404";
        echo "Page Not Found";
    }
?>