<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "../includes/header.php"; ?>
    <title>Document</title>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
<div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <h3 class="fw-bold mt-4 mb-2">Blocked Users</h3>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:650px">
        <table class="table table-bordered my-3">
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
                    $qry = "SELECT * FROM user_block INNER JOIN customer ON user_block.email_id = customer.user_email";
                    $res = $conn->query($qry);
                    if($res){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row['user_id']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['user_email']; ?></td>
                                    <td><?php echo $row['user_mob']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-danger me-1" href="unblock.php?id=<?php echo $row['block_id']; ?>">Unblock</a>
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