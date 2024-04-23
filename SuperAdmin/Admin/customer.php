<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
    <div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
            <h3 class="fw-bold mt-4 mb-3">Customers List</h3>
            <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:650px">
                <table class="table table-bordered mt-md-1">
                    <thead class="bg-dark">
                        <tr class="text-white text-center">
                            <th>ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            require_once "..\Database\db_connection.php";
                            $qry = "SELECT * FROM customer";
                            $res = $conn->query($qry);
                            if($res->num_rows){
                                while($row = $res->fetch_assoc()){
                                    ?>
                                        <tr class="text-center">
                                            <td><?php echo $row['user_id']; ?></td>
                                            <td><?php echo $row['user_name']; ?></td>
                                            <td><?php echo $row['user_email']; ?></td>
                                            <td><?php echo $row['user_mob']; ?></td>
                                            <td>
                                                <a class="btn btn-outline-primary me-3" href="view_customer.php?id=<?php echo $row['user_id']; ?>">View</a>
                                                <a class="btn btn-outline-success me-3" href="edit_customer.php?id=<?php echo $row['user_id']; ?>">Edit</a>
                                                <a class="btn btn-outline-danger" href="del_customer.php?id=<?php echo $row['user_id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo "No Records Found.";
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