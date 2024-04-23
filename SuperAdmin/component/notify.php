<?php
    require_once "..\Database\db_connection.php";
    if(isset($_POST['sub'])){
        $id = $_POST['id'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date("d M Y");
        $time = date("h:i A");
        $qry = "INSERT INTO notification VALUES('','$id' , '$subject', '$message','$date', '$time')";
        if($conn->query($qry)){
            header("location:../Admin/view_customer.php?id=$id");
        }else{
            echo "404 | Error";
        }
    }
?>