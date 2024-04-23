<?php session_start();
require_once "db/dbconnect.php";

//Checking if the session is already set or not
if(isset($_SESSION['accesslevel'])) {
    if($_SESSION['accesslevel'] == 1) {
        header("location: home.php");
        exit();
    } else if($_SESSION['accesslevel'] == 2) {
        header("location: ../home.php");
        exit();
    } 
    else if($_SESSION['accesslevel'] == 3) {
        header("location: ../../home.php");
        exit();
    }
}

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if(!empty($email) && !empty($pass)) {
        // Check against admin table
        $qry = "SELECT * FROM admin WHERE email='$email' AND password='$pass' ";
        $res = $conn->query($qry);
        if($res->num_rows > 0){
            $log = $res->fetch_assoc();
            $_SESSION['email'] = $log['email'];
            $_SESSION['name'] = $log['username'];
            $_SESSION['accesslevel'] = 3; 
            header("location: SuperAdmin/Admin/admin.php");
            exit();
        }
        
        // Check against service_provider table
        $qry = "SELECT * FROM service_provider WHERE sp_email='$email' AND sp_password='$pass' ";
        $res = $conn->query($qry);
        if($res->num_rows > 0){
            $log = $res->fetch_assoc();
            $_SESSION['email'] = $log['sp_email'];
            $_SESSION['name'] = $log['sp_name'];
            $_SESSION['accesslevel'] = 2;
            $_SESSION['sp_id'] = $log['sp_id'];
            header("location: Service_Provider/sp_home.php");
            exit();
        }
        
        // Check against customer table
        $qry = "SELECT * FROM customer WHERE user_email='$email' AND user_password='$pass' ";
        $res = $conn->query($qry);
        if($res->num_rows > 0){
            $log = $res->fetch_assoc();
            $_SESSION['email'] = $log['user_email'];
            $_SESSION['name'] = $log['user_name'];
            $_SESSION['user_id'] = $log['user_id'];
            $_SESSION['accesslevel'] = 1; 
            header("location: home.php");
            exit();
        }

        // echo "Invalid email or password";
    } 
    $_SESSION['login_error'] = true;
    header("location:login.php"); 
    exit;
}
$conn->close();
?>
