<?php
    require_once "..\..\Database\db_connection.php";
    $sql = "SELECT sum(total_price) as price FROM booking WHERE book_date >= DATE_SUB(CURDATE(), INTERVAL 31 DAY) ";
    $res = $conn->query($sql);
    if($res !== false && $res->num_rows > 0){
        $row = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode($row);
    }else{
        $pages_array[] = (object) array('price' => 'ZERO');
        echo json_encode($pages_array);
    }
?>