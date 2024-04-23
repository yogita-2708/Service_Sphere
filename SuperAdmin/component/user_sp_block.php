<?php
    if(isset($_GET['id'])){
        $email = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "INSERT INTO user_block VALUES ('', '$email')";
        if($conn->query($qry)){
            header("location:../Admin/customer.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:../Admin/customer.php");
    }

?>