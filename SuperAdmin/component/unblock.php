<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM user_block WHERE block_id = $id ";
        if($conn->query($qry)){
            header("location:display_block.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:display_block.php");
    }

?>