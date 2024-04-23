<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Details</title>
    <style>
        .wholeservicedetailscontainer {
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
    </style>
</head>
<body class="wholeservicedetailscontainer">
    <div class="container singleservicecontainer" data-aos="fade-up">
        <div class="row mt-2 mb-4 mx-auto rounded-4 bg-transparent container-fluid p-4 position-relative justify-content-center">
            <div class="row">
            <?php
                require_once "db/dbconnect.php";
                if(isset($_GET['id'])){
                    $service_id = $_GET['id'];
                }else{
                    header("location:booked_customer.php");
                }
                $user_id = $_SESSION['user_id'];
                $qry = "SELECT * FROM booking NATURAL JOIN customer NATURAL JOIN services NATURAL JOIN address NATURAL JOIN service_service_provider NATURAL JOIN category WHERE user_id = $user_id AND service_id = $service_id";
                $res = $conn->query($qry);
                if($res){
                if($res->num_rows > 0){
                    $row = $res->fetch_assoc()
            ?>
            <h3 class="text-start text-dark mb-4 mt-4 fw-bold"><?php echo $row['s_name']; ?></h3>
            <div class="col-md-6">
                <img src="<?php echo "images/".$row['picture']; ?>" class="img-fluid rounded mt-2 shadow mb-2" alt="Service Image">
            </div>
                <div class="col-md-6 mt-1">
                    <button class="btn btn-sm mb-4 mt-2 mt-md-5 bg-secondary text-white border-0 shadow-sm"><?php echo $row['cat_name']; ?></button>
                    <div class="row">    
                        <div class="col-md-6">
                            <p class="fw-medium">Name: <b class="card-text text-dark fw-bold"><?php echo $row['user_name']; ?></b></p>
                            <p class="fw-medium">Email: <b class="card-text text-dark fw-bold"><?php echo $row['user_email']; ?></b></p>
                        </div>
                    </div>
                    <p class="text-dark fw-medium mt-3" style="text-align: justify;"><?php echo $row['s_desc']; ?></p>
                </div>
            </div>
            <hr class="mt-5">
            <div class="row p-4 mt-3 mx-auto" data-aos="zoom-in">

                <div class="col-md-6 bg-light rounded-start p-4">
                    <h3 class="text-start text-dark mb-4 mt-2 fw-bold">Address Details</h3>
                    <p>Name: <b class="card-text text-dark fw-bold"><?php echo $row['name']; ?></b></p>
                    <p>Phone: <b class="card-text text-dark fw-bold"><?php echo $row['phone']; ?></b></p>
                    <p>Alternate Phone: <b class="card-text text-dark fw-bold"><?php echo $row['alter_phone']; ?></b></p>
                    <p>Address: <b class="card-text text-dark fw-bold"><?php echo $row['addrs']; ?></b></p>
                    <p>Landmark: <b class="card-text text-dark fw-bold"><?php echo $row['landmark']; ?></b></p>
                </div>
                <div class="col-md-6 bg-light rounded-end p-4">
                    <h3 class="text-dark mb-4 mt-2 fw-bold">Booking Details</h3>
                    <div class="row">    
                        <div class="col-md-6">
                            <p>Booking Date: <b class="card-text text-dark fw-bold"><?php echo $row['book_date']; ?></b></p>
                            <p>Total Price: <b class="card-text text-dark fw-bold"><?php echo $row['total_price']; ?></b></p>
                            <p>Slot: <b class="card-text text-dark fw-bold"><?php 
                                $slot = $row['slot'];
                                echo str_replace('.', '-', $slot); 
                            ?>
                            </b></p>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            

            <?php
            }else{
                echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
            }
        }else{
            echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
        }
?>
        </div>
    </div>
</div>

        
<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });
</script>
</body>
</html>
<?php include_once "include/footer.php"; ?>