<?php
    require_once "..\..\db\dbconnect.php";
    $service_id = $_POST['value'];

    $qry = "SELECT sub_cat_id, sub_cat_name FROM sub_category WHERE service_id = $service_id";
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