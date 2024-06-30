<?php
    require_once "..\..\db\dbconnect.php";
    $cat_id = $_POST['value'];

    $qry = "SELECT service_id, s_name FROM services WHERE cat_id = $cat_id";
    $res = $conn->query($qry);
    if($res){
        if($res->num_rows>0){
            $row = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($row);
        }else{
            echo "Error";
        }
    }

?>