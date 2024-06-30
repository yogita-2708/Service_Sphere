<?php

    $HOSTNAME = '127.0.0.1:8888';
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