<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditServices</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
<div class="row">
    <?php include_once "../includes/sidenav.php"; ?>
    <div class="col-md-10">
    <?php
    if(!isset($_GET['id'])){
        header('location:admin.php');
    }
    require_once "..\Database\db_connection.php";
    $id = $_GET['id'];
    $qry = "SELECT * FROM services NATURAL JOIN service_service_provider WHERE service_id = $id";
    $res = $conn->query($qry);
    $row = $res->fetch_assoc();
    ?>
  <div class="container-fluid" data-aos="fade-in">
  <div class="p-2 p-md-4">
    <form class="container-fluid" action="../operation/package_update.php" method="post">
    <div>
        <h4 class="text-center fw-bold mt-2 mb-4">Update Service Details</h4>
    </div>
    <input type="text" name="service_id" value="<?php echo $row['service_id']; ?>" class="d-none">
    <input type="text" name="sp_id" value="<?php echo $row['sp_id']; ?>" class="d-none">
    <div class="form-group mb-4">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="sname" value="<?php echo $row['s_name']; ?>">
    </div>
    <div class="form-group mb-4">
        <label for="exampleInputEmail1">Desc</label>
        <textarea class="form-control" name="sdesc" id="" cols="30" rows="5"><?php echo $row['s_desc']; ?></textarea>
    </div>
    <div class="form-group mb-4">
        <label for="exampleInputEmail1">Price</label>
        <input type="text" class="form-control" name="sprice" value="<?php echo $row['s_price']; ?>">
    </div>
    
    <button type="submit" class="btn btn-primary mt-2" name="sub">Submit</button>
    </form>
 </div>
</div>
</div>
</div>
<script src="../assets/js/aos.js"></script>
<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });
</script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>