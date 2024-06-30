<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditCustomer</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">

    <div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
            <?php
            if(!isset($_GET['id'])){
                header('location:customer.php');
            }
            require_once "..\Database\db_connection.php";
            $id = $_GET['id'];
            $qry = "SELECT * FROM customer WHERE user_id = $id";
            $res = $conn->query($qry);
            $row = $res->fetch_assoc();
            ?>
            <div class="container-fluid" data-aos="fade-left">
                <div class="p-md-5">
                    <form class="container-fluid" action="" method="post">
                        <div>
                            <h4 class="text-center mb-2 fw-bold">Update Customer Details</h4>
                        </div>
                        <div class="form-group mb-4">
                            <label for="exampleInputEmail1" class="fs-medium">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" value="<?php echo $row['user_name']; ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="exampleInputEmail1" class="fs-medium">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?php echo $row['user_email']; ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="exampleInputEmail1" class="fs-medium">Phone</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" value="<?php echo $row['user_mob']; ?>">
                        </div>
                        <div class="form-group mb-4">
                            <label for="exampleInputEmail1" class="fs-medium">Password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" name="pass" aria-describedby="emailHelp" value="<?php echo $row['user_password']; ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="sub">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/aos.js"></script>
    <script>
        AOS.init({
          offset: 200,
          duration: 1000,
        });
    </script>
</body>

    <!-- Php Code -->
    <?php

        if(isset($_POST['sub'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            
            $sql = "UPDATE customer SET user_name='$name' user_email='$email' user_mob='$phone' user_password='$pass'";
            if($conn->query($sql)){
                echo "<script>alert('Successfully Updated');</script>";
            }else{
                echo $conn->error;
            }
        }

    ?>


</html>