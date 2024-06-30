<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP Services</title>
    <link rel="stylesheet" href="../assets/css/aos.css">
    <style>
        .wholeservicecontainer {
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
        .card-img-top {
            height: 350px;
        }
        .duration {
            text-align: right;
        }
        @media (max-width: 571px) {
            .duration {
                text-align: left;
            }
        }
    </style>
</head>
<body class="wholeservicecontainer">

<div class="container sec-one-container">
    <div class="row mt-5">
        <?php
        require_once "../db/dbconnect.php";

        $access_level = isset($_SESSION['accesslevel']) ? $_SESSION['accesslevel'] : null;
        if($access_level) {
            $sp_id = $_SESSION['sp_id'];
            $qry = "SELECT sp_id FROM service_service_provider WHERE sp_id = '$sp_id'";
            $ress = $conn->query($qry);

            if ($ress->num_rows > 0) {
                $row = $ress->fetch_assoc();
                $service_provider_id = $row['sp_id'];

                // Fetch services provided by the logged-in service provider
                $qry = "SELECT * FROM services INNER JOIN category ON services.cat_id = category.cat_id INNER JOIN service_service_provider ON services.service_id = service_service_provider.service_id INNER JOIN sub_category ON service_service_provider.sub_cat_id = sub_category.sub_cat_id WHERE service_service_provider.sp_id = $service_provider_id AND services.s_status = 'YES' ";

                $res = $conn->query($qry);
                while($ns = $res->fetch_assoc()) {
        ?>
        <div class="col-md-6 mb-5" data-aos="zoom-in">
            <div class="card rounded-0 bg-transparent border-0 mx-5">
                <img src="<?php echo "../images/".$ns['spicture']; ?>" class="card-img-top rounded-3 shadow" alt="Service 1">
                <div class="card-body px-0 my-2">
                    <button class="btn btn-sm mb-3 bg-secondary text-white border-0 shadow-sm"><?php echo $ns['cat_name']; ?></button>
                    <h5 class="card-title text-dark mb-3 mt-1"><b><?php echo $ns['s_name']; ?></b></h5>
                    <h6>Sub-Category: <b><?php echo $ns['sub_cat_name']; ?></b></h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="card-text text-dark fw-bold text-start">Price:- ₹<?php echo $ns['s_price']; ?></p>
                        </div>
                        <div class="col-md-6 duration">
                            <p class="card-text text-dark fw-bold">Duration (H:M:S):- <?php echo $ns['s_duration']; ?></p>
                        </div>
                    </div>
                    <p class="card-text text-dark mt-4" style="text-align: justify;"><?php echo $ns['sdesc']; ?></p>
                    <a href="update_services.php?sid=<?php echo $ns['service_id']; ?>&scid=<?php echo $ns['sub_cat_id']; ?>" class="btn bg-warning text-white shadow mt-2">EDIT SERVICE</a>
                </div>
            </div>
        </div>
        <?php 
                }
            } else {
                echo "<p>No services found for this service provider.</p>";
            }
        } else {
            echo "<p>Please login to view services.</p>";
        }
        ?>
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
<?php include_once "sp_footer.php"; ?>
