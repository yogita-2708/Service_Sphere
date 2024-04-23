<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM serviceprovider WHERE sp_id = $id ";
        if($conn->query($qry)){
            header("location:service_provider.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:service_provider.php");
    }

?>