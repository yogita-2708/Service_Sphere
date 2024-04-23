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
            $qry = "SELECT * FROM booking NATURAL JOIN customer NATURAL JOIN services NATURAL JOIN address NATURAL JOIN service_service_provider NATURAL JOIN category WHERE user_id=$user_id";
            $res = $conn->query($qry);
            if($res){
            if($res->num_rows > 0){
                while($row = $res->fetch_assoc()){
            ?>

                <div class="card bg-light p-3 d-flex mt-4 mb-5 shadow">
                    <div class="card-body">
                        <h4>Name: <?php echo $row['user_name']; ?></h4>
                        <h5>Email: <?php echo $row['user_email']; ?></h5>
                        <h5>Service: <?php echo $row['s_name']; ?></h5>
                    </div>
                    <div class="mx-auto">
                        <a href="single_book_details.php?id=<?php echo $row['service_id'] ?>" class="btn bg-warning text-white m-2 m-md-3">VIEW DETAILS</a>
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