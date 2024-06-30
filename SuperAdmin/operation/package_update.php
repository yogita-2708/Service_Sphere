<?php
    require_once "../Database/db_connection.php";
    if(isset($_POST['sub'])){
        $sname = $_POST['sname'];
        $sdesc = $_POST['sdesc'];
        $sprice = $_POST['sprice'];
        $sid = $_POST['service_id'];
        $spid = $_POST['sp_id'];

        $stmt1 = $conn->prepare("UPDATE services SET s_name = ?, s_desc = ? WHERE service_id = ?");
        $stmt1->bind_param("ssi", $sname, $sdesc, $sid);

        $stmt2 = $conn->prepare("UPDATE service_service_provider SET s_price = ? WHERE service_id = ? AND sp_id = ?");
        $stmt2->bind_param("dii", $sprice, $sid, $spid);

        // Execute the statements
        $res1 = $stmt1->execute();
        $res2 = $stmt2->execute();

        if($res1 && $res2){
            header("location:../component/service_package.php");
            
        }else{
            echo $conn->error;
        } 
    }
?>