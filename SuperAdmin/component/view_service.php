<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CustomerView</title>
      <?php include_once "../includes/header.php"; ?>
      <script src="..\assets\js\jquery-3.7.1.js"></script>
   </head>
   <body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
   <div class="row">
        <?php
            if(!isset($_GET['id'])){
                header("location:service_list.php");
            }else{
                $id = $_GET['id'];
            }
        ?>
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10"> 
        <div class="row">
            <div class="col-md-12">
                <h3 class="fw-bold mt-4 mb-2">Services Package Info</h3>
            </div>
        </div>
        
        <div class="row mt-4">
        <?php
            require_once "..\Database\db_connection.php";
            $sql = "SELECT * FROM services  WHERE service_id = $id";
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
                        <h5>Duration:<?php echo $row['s_duration']; ?></h5>
                    </div>
                </div>
        <?php
            }else{
                echo "<h4 class='text-center'>No Record Found</h4>";
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="fw-bold mt-4 mb-2">Service Providers</h3>
            </div>
        </div>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:645px">
        <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>SP ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM services INNER JOIN service_service_provider ON services.service_id = service_service_provider.service_id INNER JOIN service_provider ON service_service_provider.sp_id=service_provider.sp_id WHERE services.service_id = $id";
                    $res = $conn->query($qry);
                    if($res!==false && $res->num_rows>0){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo $row['sp_id']; ?></td>
                                    <td><?php echo $row['sp_name']; ?></td>
                                    <td><?php echo $row['sp_email']; ?></td>
                                    <td><?php echo $row['s_price']; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-success me-md-1 mb-1 mb-md-0" href="edit_package.php?id=<?php echo $row['service_id']; ?>">Edit</a>
                                        <a class="btn btn-outline-danger" href="../operation/delete_single_provider.php?id=<?php echo $row['service_id']; ?>&spid=<?php echo $row['sp_id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        echo "<h1 class='text-center my-1'>No Records Found.</h1>";
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