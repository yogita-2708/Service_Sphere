<?php

    $sname = $_POST['sname'];
    $sdesc = $_POST['sdesc'];
    $sid = $_POST['service_id'];
    $s_duration = $hours . ':' . $minutes . ':' . $seconds;
    $picture = $_FILES['picture'];
    $path = '../images';
    $file = $picture['name'];
    $c_path = $path."/".$file;

    $qry = "UPDATE services SET s_name = '$sname', s_desc = '$sdesc', s_duration = '$s_duration', picture = '$file' WHERE service_id = $sid";
    if($conn->query($qry)){
        header("location:../component/service_list.php");
    }else{
        echo $conn->error;
    }

?>