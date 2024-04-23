<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
   <div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10"> 
        <h3 class="fw-bold mt-4 mb-2">Confirmed Services</h3>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:645px">
        <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM services INNER JOIN service_service_provider ON services.service_id = service_service_provider.service_id WHERE status = 'NO' ";
                    $res = $conn->query($qry);
                    if($res!==false && $res->num_rows>0){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row['service_id']; ?></td>
                                    <td><?php echo $row['s_name']; ?></td>
                                    <td><?php echo $row['s_price']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary me-1 mb-1 mb-md-0" href="service.php?id=<?php echo $row['service_id']; ?>&sp_id=<?php echo $row['sp_id']; ?>">View</a>
                                        <a class="btn btn-outline-success" href="../operation/service_confirmation.php?id=<?php echo $row['service_id']; ?>&sp_id=<?php echo $row['sp_id']; ?>">Confirm</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
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
</body>
</html>