<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        require_once "..\Database\db_connection.php";
        $qry = "DELETE FROM category WHERE cat_id = $id ";
        if($conn->query($qry)){
            header("location:category_list.php");
        }else{
            echo $conn->error;
        }
    }else{
        header("location:category_list.php");
    }

?>