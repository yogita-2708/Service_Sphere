<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CustomerView</title>
      <?php include_once "../includes/header.php"; ?>
   </head>
   <body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
   <div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <h3 class="fw-bold mt-4 mb-2">Service Packages</h3>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:650px">
        <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DURATION</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM services NATURAL JOIN service_service_provider";
                    $res = $conn->query($qry);
                    if($res!==false && $res->num_rows>0){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row['service_id']; ?></td>
                                    <td><?php echo $row['s_name']; ?></td>
                                    <td><?php echo $row['s_duration']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-primary me-1" href="view_service.php?id=<?php echo $row['service_id']; ?>">View</a>
                                        <a class="btn btn-outline-danger" href="http://localhost/ServiceSphere/Service_Sphere/component/delete_service.php?id=<?php echo $row['service_id']; ?>">Delete</a>
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