<?php
    require_once "..\..\db\dbconnect.php";
    $slot = $_POST['value'];
    $spid = $_POST['sp_id'];

    $qry = "SELECT count(*) as slot_count FROM booking WHERE slot = $slot AND sp_id = $spid ";
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