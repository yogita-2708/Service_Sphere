<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $spid = $_GET['spid'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM service_service_provider WHERE service_id = $id AND sp_id=$spid";
        if($conn->query($qry)){
            header("location:service_list.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:service_list.php");
    }

?>