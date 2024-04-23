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
        .singleservicecontainer p,button {
            font-weight: 500;
            font-size: 1rem;
        }
        .booknowbtn {
            width: 50%;
        }
        .singleservicecontainer {
                width:80%;
        } 
        @media (max-width: 571px) {
            .booknowbtn {
                width: 100%;
            }
            .singleservicecontainer {
                width: 90%;
            }
        }
    </style>
</head>
<body class="wholeservicedetailscontainer">
<?php
require_once "db/dbconnect.php";

if(isset($_GET['service_id']) && !empty($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    
    // Query to retrieve service details
    $qry_service = "SELECT services.*, category.cat_name FROM services INNER JOIN category ON services.cat_id = category.cat_id WHERE services.service_id = $service_id";
    
    // Query to retrieve service providers offering this service
    // $qry_providers = "SELECT service_provider.* FROM service_provider 
    //                   INNER JOIN service_service_provider ON service_provider.sp_id = service_service_provider.sp_id 
    //                   WHERE service_service_provider.service_id = $service_id";

    // $qry_providers = "SELECT * FROM service_service_provider 
    //                   INNER JOIN service_provider ON service_provider.sp_id = service_service_provider.sp_id 
    //                   INNER JOIN services ON services.service_id = service_service_provider.service_id
    //                   WHERE service_service_provider.service_id = $service_id";

    $qry_providers = "SELECT * FROM service_service_provider 
                    INNER JOIN services ON services.service_id = service_service_provider.service_id
                    INNER JOIN service_provider ON service_provider.sp_id = service_service_provider.sp_id            
                    WHERE service_service_provider.service_id = $service_id AND service_service_provider.status='YES' ";
    
    $res_service = $conn->query($qry_service);
    $res_providers = $conn->query($qry_providers);
    
    $service_details = $res_service->fetch_assoc();
    
    $service_providers = [];
    while($row = $res_providers->fetch_assoc()) {
        $service_providers[] = $row;
    }
}
?>


<div class="container-fluid singleservicecontainer" data-aos="fade-up">
    <div class="row mt-3 mb-5 mx-auto rounded-4 bg-transparent container-fluid p-4 position-relative justify-content-center">
        <!-- <a href="services.php" class="btn-close fs-6 position-absolute top-1 mx-3 end-0" aria-label="Close"></a> -->
        <div class="row">
            <h4 class="text-start text-dark mb-4 mt-4 fw-bold"><?php echo $service_details['s_name']; ?></h4>
            <div class="col-md-6">
                <img src="<?php echo "images/".$service_details['picture']; ?>" class="img-fluid rounded mt-2 shadow mb-2" alt="Service Image">
            </div>
                <div class="col-md-6 mt-4">
                    <button class="btn btn-sm mb-4 mt-2 mt-md-5 bg-secondary text-white border-0 shadow-sm"><?php echo $service_details['cat_name']; ?></button>
                    <div class="row">    
                        <div class="col-md-6">
                            <p class="card-text text-dark fw-bold">Duration (H:M:S): <?php echo $service_details['s_duration']; ?></p>
                        </div>
                    </div>
                    <p class="text-dark fw-medium mt-4" style="text-align: justify;"><?php echo $service_details['s_desc']; ?></p>
                </div>
            </div>


        <div class="row p-3">
            <h3 class="text-start text-dark mb-5 mt-3 fw-bold">Service Providers</h3>
            <?php foreach ($service_providers as $provider) { ?>
                <div class="col-md-6 mb-4" data-aos="zoom-in">
                    <div class="card shadow bg-light">
                        <div class="card-body text-dark mx-3">
                            <h4 class="fw-bold mb-4"><?php echo $provider['sp_name'] ?></h4>
                            <p><i class="bi bi-envelope-at-fill mx-1"></i> Email: <?php echo $provider['sp_email'] ?></p>
                            <p><i class="bi bi-telephone-fill mx-1"></i> Mobile: (+91) <?php echo $provider['sp_phone'] ?></p>
                            <p><i class="bi bi-currency-rupee mx-1"></i> Price: ₹<?php echo $provider['s_price'] ?></p>
                            <?php 
                                // Fetch rating from cus_sp_review table
                                $sp_id = $provider['sp_id'];
                                $rating_query = "SELECT AVG(rating) AS avg_rating FROM cus_sp_review WHERE sp_id = $sp_id ";
                                $rating_result = $conn->query($rating_query);
                                $rating_row = $rating_result->fetch_assoc();
                                $avg_rating = $rating_row['avg_rating'];
                            ?>
                            <p><i class="bi bi-star-half mx-1"></i> Rating: <?php print ($avg_rating !== null) ? number_format($avg_rating, 1) : 'N/A'; ?></p>

                            <?php if(isset($_SESSION['accesslevel'])) { ?>
                                <a href="booknew.php?id=<?php echo $service_id ?>&sid=<?php echo $provider['sp_id'];?>" class="btn mt-4 mb-2 d-block shadow bg-warning text-white booknowbtn">BOOK NOW</a>
                            <?php } else { ?>
                                <a href="" class="btn mt-4 d-block shadow bg-warning text-white booknowbtn" onclick="bookservices()">KNOW MORE</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>   
    </div>
</div>


<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });


    function bookservices() {
        <?php if (!isset($_SESSION['accesslevel'])) { ?>
        alert("Please Sign Up or Login to Book Services.");
        window.location.href = 'signup.php'; 
        <?php } ?>
    }
</script>
</body>
</html>
<?php include_once "include/footer.php"; ?>