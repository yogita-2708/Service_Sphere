<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
    <div class="container-fluid my-3">
        <h1 class="text-center fw-bold my-5">Service Details</h1>
        <div class="row">
            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $sp_id = $_GET['sp_id'];
                    require_once "..\Database\db_connection.php";
                    $sql = "SELECT * FROM services INNER JOIN service_service_provider ON services.service_id = service_service_provider.service_id WHERE services.service_id=$id AND service_service_provider.sp_id = $sp_id";
                    $res = $conn->query($sql);
                    if($res!==false && $res->num_rows>0){
                        $row=$res->fetch_assoc();
                        ?>
                        <div class="col-6 text-end pe-5">
                            <img class="img-fluid w-75 rounded" class="rounded" src="../images/<?php echo $row['picture']; ?>" alt="">
                        </div>
                        <div class="col-6 vertical-center text-start">
                            <div class="container p-3">
                                <h2 class="fw-bold"><?php echo $row['s_name']; ?></h2>
                                <h5>ID:<?php echo $row['service_id']; ?></h5>
                                <p style="text-align:justify;" class="fs-6 mt-2 mb-4"><?php echo $row['s_desc']; ?></p>
                                <h5>Price:<?php echo $row['s_price']; ?></h5>
                                <h5>Duration:<?php echo $row['s_duration']; ?></h5>
                            </div>
                        </div>
            <?php
                    }else{
                        echo "<h4 class='text-center'>No Record Found</h4>";
                    }
                }else{
                    echo "<h4 class='text-center'>404 | Error</h4>";
                }
            ?>
            
        </div>
    </div>
</body>
</html>
