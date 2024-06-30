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
    $qry = "SELECT * FROM services WHERE service_id = $id";
    $res = $conn->query($qry);
    $row = $res->fetch_assoc();
    ?>
  <div class="container-fluid" data-aos="fade-in">
  <div class="p-2 p-md-4">
    <form class="container-fluid" action="../operation/service_update.php" method="post">
    <div>
        <h4 class="text-center fw-bold mt-2 mb-4">Update Service Details</h4>
    </div>
    <input type="text" name="service_id" value="<?php echo $row['service_id']; ?>" class="d-none">
    <div class="form-group mb-4">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="sname" value="<?php echo $row['s_name']; ?>">
    </div>
    <div class="form-group mb-4">
        <label for="exampleInputEmail1">Desc</label>
        <textarea class="form-control" name="sdesc" id="" cols="30" rows="5"><?php echo $row['s_desc']; ?></textarea>
    </div>

    <div class="mb-4">
        <label for="s_duration" class="form-label">Duration (H:M:S):</label>
        <?php
            $arr = explode(':', $row['s_duration']);
        ?>
        <div class="row">
            <div class="col">
                <select class="form-select" name="hours" required>
                    <option value="<?php echo $arr[0] ?>"><?php echo $arr[0] ?></option>
                    <?php
                    for ($i = 0; $i < 24; $i++) {
                        printf('<option value="%02d">%02d</option>', $i, $i);
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-select" name="minutes" required>
                    <option value="<?php echo $arr[0] ?>"><?php echo $arr[1] ?></option>
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        printf('<option value="%02d">%02d</option>', $i, $i);
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <select class="form-select" name="seconds" required>
                    <option value="<?php echo $arr[0] ?>"><?php echo $arr[2] ?></option>
                    <?php
                    for ($i = 0; $i < 60; $i++) {
                        printf('<option value="%02d">%02d</option>', $i, $i);
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="thumbnail" class="form-label">Thumbnail:</label>
        <input type="file" name="picture" class="form-control" value="<?php echo $row['picture']; ?>" id="thumbnail" accept="image/*" required>
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