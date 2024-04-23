<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../includes/header.php"; ?>
    <style>
        a{
            text-decoration:none;
        }
        .card:hover{
            transition: 0.6s;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.2);
        }

    </style>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
<div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <h3 class="fw-bold mt-4 mb-3">Inbox</h3>
        <div class="table-responsive overflow-auto" data-aos="fade-in">
        <?php 
            require_once "../Database/db_connection.php";
            $qry = "SELECT * FROM inbox";
            $res = $conn->query($qry);
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
                    ?>  
                        <div class="card mt-2 bg-light shadow mb-4">
                            <div class="card-body">
                                <a href="singleInbox.php?id=<?php echo $row['inbox_id']; ?>" class="text-dark">
                                    <h5 class="fw-bold"><?php echo $row['name']; ?></h5>
                                    <h5><?php echo $row['subject']; ?></h5>
                                </a>
                            </div>
                        </div>
                    <?php
                }
            }else{
                echo "<h1 class='text-center mt-5'>No Result Found</h1>";
            }
        ?>
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