<?php
require_once "db/dbconnect.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $mobile = $_POST['mobile'];
    $usertype = $_POST['usertype'];

    if (!empty($username) && !empty($email) && !empty($pass) && !empty($usertype)) {
        $check_query = "SELECT * FROM access_level WHERE user_type = '$usertype'";
        $result = $conn->query($check_query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $accesslevel = $row['accesslevel'];

            $table = ($usertype == 'service_provider') ? 'service_provider' : 'customer';
            $nameColumn = ($usertype == 'service_provider') ? 'sp_name' : 'user_name';
            $emailColumn = ($usertype == 'service_provider') ? 'sp_email' : 'user_email';
            $passColumn = ($usertype == 'service_provider') ? 'sp_password' : 'user_password';
            $mobileColumn = ($usertype == 'service_provider') ? 'sp_phone' : 'user_mob';
            
            $insert_query = "INSERT INTO $table ($nameColumn, $emailColumn, $passColumn, $mobileColumn, user_type, accesslevel) VALUES ('$username', '$email', '$pass', '$mobile', '$usertype', '$accesslevel')";
            
            if ($conn->query($insert_query) === TRUE) {
                echo "One record inserted";
                header("location: login.php");
                exit(); 
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            echo "Error: User type '$usertype' does not exist.";
        }
    }
    $conn->close();
}

?>
