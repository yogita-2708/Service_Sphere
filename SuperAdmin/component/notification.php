<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)">
    <div class="container mt-2 mt-md-5">
    <h1 class="mb-2 mb-md-4 text-center text-warning">Notifications</h1>
            <?php
                require_once "..\Database\db_connection.php";
                // $id = $_SESSION['user_id'];
                $qry = "SELECT * FROM notification WHERE user_id = '4' AND stat = 'YES' ";
                $res = $conn->query($qry);
                if($res->num_rows>0){
                    while( $row=$res->fetch_assoc() ){

            ?>
                <div class="list-group shadow">
                    <div class="list-group-item bg-transparent" data-aos="zoom-in" id="card-1">
                        <div class="d-flex w-100 justify-content-between">
                            <h3 class="mb-1 fw-bold"><?php echo $row['subject']; ?></h3>
                            <a href="../operation/delete_notification.php?id=<?php echo $row['notify_id']; ?>"><i class="bi bi-x-lg text-secondary"></i></a>
                        </div>
                        <p class="fw-lighter"><?php echo $row['message']; ?></p>
                        <div class="d-flex justify-content-between">
                            <h6><?php echo $row['date']; ?></h6>
                            <h6><?php echo $row['time']; ?></h6>
                        </div>
                    </div>
                </div>
            <?php
                    }
                }else{
                    echo "<h1 class='display-3 text-center'>Empty</h1>";
                }
            ?>
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