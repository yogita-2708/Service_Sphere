<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere</title>
    <style>
        body {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        if(!isset($_GET['id'])){
            header('location:sp_profile.php');
        }
        require_once "../db/dbconnect.php";
        $id = $_GET['id'];
        $qry = "SELECT * FROM service_provider WHERE sp_id = $id";
        $res = $conn->query($qry);
        $row = $res->fetch_assoc();
        ?>
        <div class="container">
            <div class="p-md-5">
            <h4 class="text-center mb-4 fw-bold">Update Your Profile</h4>
                <form class="container border border-secondary rounded p-4 w-75" action="" method="post">
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="fw-medium">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp" value="<?php echo $row['sp_name']; ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="fw-medium">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<?php echo $row['sp_email']; ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="fw-medium">Phone</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp" value="<?php echo $row['sp_phone']; ?>">
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="fw-medium">Password</label>
                        <input type="password" class="form-control" id="exampleInputEmail1" name="pass" aria-describedby="emailHelp" value="<?php echo $row['sp_password']; ?>">
                    </div>
                    
                    <button type="submit" class="btn bg-warning text-white shadow mt-3" name="sub">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- Php Code -->
<?php
    if(isset($_POST['sub'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pass = $_POST['pass'];
        
        $sql = "UPDATE service_provider SET sp_name='$name', sp_email='$email', sp_phone='$phone', sp_password='$pass' WHERE sp_id = $id";
        if($conn->query($sql)){
                // echo "<div class='alert alert-success' role='alert'>Profile Updated successfully!</div>";
                echo "<script>window.location.href='sp_profile.php'</script>";
        }else{
            echo $conn->error;
        }
    }

?>

</html>
<?php include_once "sp_footer.php"; ?>
