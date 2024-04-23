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
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <div class="container-fluid mt-2 mt-md-3 table-responsive overflow-auto" data-aos="fade-in" style="height:650px">
            <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>SERVICE</th>
                    <th>PRICE</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM booking INNER JOIN customer ON booking.user_id = customer.user_id INNER JOIN services ON booking.service_id = services.service_id";
                    $res = $conn->query($qry);
                    if($res->num_rows>0){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['s_name']; ?></td>
                                    <td><?php echo $row['s_price']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-success me-3" href="view_customer.php?id=<?php echo $row['user_id']; ?>">Confirm</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }else{
                        echo "<h1 class='text-center'>No Records Found.</h1>";
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