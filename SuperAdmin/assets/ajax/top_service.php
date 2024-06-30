<?php

    require_once "..\..\Database\db_connection.php";
    $sql = "SELECT s_name as service_name, services.service_id, count(*) FROM booking INNER JOIN services ON services.service_id=booking.service_id GROUP BY service_id ORDER BY count(*) DESC LIMIT 5";
    $res = $conn->query($sql);
    if($res !== false && $res->num_rows > 0){
        $row = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($row);
    }else{
        $pages_array[] = (object) array('service_name' => 'NO');
        echo json_encode($pages_array);
    }

?>