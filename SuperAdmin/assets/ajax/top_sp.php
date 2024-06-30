<?php
    require_once "..\..\Database\db_connection.php";
    $sql = "SELECT * FROM cus_sp_review INNER JOIN service_provider ON cus_sp_review.sp_id=service_provider.sp_id WHERE rating >= '4.0' ";
    $res = $conn->query($sql);
    if($res !== false && $res->num_rows > 0){
        $row = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($row);
    }else{
        $pages_array[] = (object) array('sp_id' => 'NO');
        echo json_encode($pages_array);
    }
?>