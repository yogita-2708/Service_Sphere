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
        <h3 class="fw-bold mt-2 mt-md-4 text-center">Your Bookings</h3>
            <?php
            require_once "db/dbconnect.php";
            $user_id = $_SESSION['user_id'];
            $qry = "SELECT * FROM booking 
                INNER JOIN customer ON booking.user_id=customer.user_id 
                INNER JOIN services ON services.service_id=booking.service_id
                WHERE booking.user_id=$user_id";
            $res = $conn->query($qry);
            if($res){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
            ?>

                <div class="card bg-light p-3 d-flex mt-4 mb-5 shadow">
                    <div class="card-body">
                        <h4 class="fw-bold">Name: <?php echo $row['user_name']; ?></h4>
                        <h5 class="fw-medium">Email: <?php echo $row['user_email']; ?></h5>
                        <h5 class="fw-medium">Service: <?php echo $row['s_name']; ?></h5>
                    </div>
                    <div class="mx-auto">
                        <a href="single_book_details.php?id=<?php echo $row['service_id'] ?>" class="btn bg-warning text-white mt-3">VIEW DETAILS</a>
                    </div>
                </div>

            <?php
        }
    }else{
        echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
    }
}else{
    echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
}
?>
    
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