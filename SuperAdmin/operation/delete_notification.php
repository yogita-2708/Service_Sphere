<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "UPDATE notification SET stat = 'NO' WHERE notify_id = $id ";
        if($conn->query($qry)){
            header("location:../component/notification.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:../component/notification.php");
    }

?>