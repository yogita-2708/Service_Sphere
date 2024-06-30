<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM customer WHERE user_id = $id ";
        if($conn->query($qry)){
            header("location:customer.php");
        }else{
            echo $conn->error;
        }
    }

?>