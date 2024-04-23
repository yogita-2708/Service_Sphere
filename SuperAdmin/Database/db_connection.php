<?php
    $HOSTNAME = 'localhost';
    $USERNAME = 'root';
    $PASSWORD = '';
    $DBNAME = 'servicesphere';

    try{
        $conn = new mysqli($HOSTNAME, $USERNAME, $PASSWORD, $DBNAME);
        if($conn->error){
            echo "Connection Error".$conn->error;
        }
    }catch(Exception $e){
        echo "Connection Error".$conn->error;
    }

?>