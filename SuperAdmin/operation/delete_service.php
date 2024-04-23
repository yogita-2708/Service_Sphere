<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM services WHERE service_id = $id ";
        if($conn->query($qry)){
            header("location:service_list.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:service_list.php");
    }

?>