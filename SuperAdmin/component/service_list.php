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
        <div class="row">
            <div class="col-md-6">
                <h3 class="fw-bold mt-4 mb-2">Services List</h3>
            </div>
            <div class="col-md-6 text-end">
                <a href="add_service.php" class="btn btn-success px-4 mt-4" id="catBtn">ADD</a>
            </div>
        </div>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:645px">
        <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>CAT ID</th>
                    <th>DESC</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM services";
                    $res = $conn->query($qry);
                    if($res!==false && $res->num_rows>0){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo $row['service_id']; ?></td>
                                    <td><?php echo $row['s_name']; ?></td>
                                    <td><?php echo $row['cat_id']; ?></td>
                                    <td style="width:45vw;"><p><?php echo $row['s_desc']; ?></p></td>
                                    <td class="text-center">
                                        <a class="btn btn-outline-success me-md-1 mb-1 mb-md-0" href="edit_service.php?id=<?php echo $row['service_id']; ?>">Edit</a>
                                        <a class="btn btn-outline-danger" href="../operation/delete_service.php?id=<?php echo $row['service_id']; ?>">Delete</a>
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