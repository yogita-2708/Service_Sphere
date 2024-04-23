<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Crew</title>
    <style>
        .wholecrewcontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .crewcontainer{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            position: relative;
            margin-top: 100vh;
        }
        .card-body p{
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 18px;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            overflow-x: hidden;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('images/crew.jpg');
            background-size: cover;
            background-position: right;
        }
        .sec-one {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        @media (max-width: 571px) {
            .bg-img {
                height: 50vh;
            }
            .crewcontainer {
                margin-top: 50vh;
                width: 80%;
            }
        }
    </style>
</head>
<body class="wholecrewcontainer">

<div class="bg-img"><div class="sec-one"></div></div>

<div class="container crewcontainer">
    <div class="row">
        <?php
        require_once "db/dbconnect.php";
        $qry = "SELECT service_provider.sp_id, sp_name, sp_email, sp_phone, GROUP_CONCAT(services.s_name SEPARATOR ', ') AS services, AVG(rating) AS rating
                FROM service_provider
                INNER JOIN service_service_provider ON service_provider.sp_id = service_service_provider.sp_id
                INNER JOIN services ON service_service_provider.service_id = services.service_id
                LEFT JOIN cus_sp_review ON service_provider.sp_id = cus_sp_review.sp_id
                GROUP BY service_provider.sp_id";
        $res = $conn->query($qry);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                ?>
                <div class="col-md-6 mb-5" data-aos="zoom-in">
                    <div class="card shadow bg-light">
                        <div class="card-body text-dark">
                            <h3 class="fw-bold mb-4"><?php echo $row['sp_name'] ?></h3>
                            <p><i class="bi bi-envelope-at-fill mx-1"></i> Email: <?php echo $row['sp_email'] ?></p>
                            <p><i class="bi bi-telephone-fill mx-1"></i> Mobile: (+91) <?php echo $row['sp_phone'] ?></p>
                            <p><i class="bi bi-gear-wide-connected mx-1"></i> Services: <?php echo $row['services'] ?></p>
                            <p><i class="bi bi-star-half mx-1"></i> Rating: <?php echo ($row['rating'] !== null) ? number_format($row['rating'], 1) : 'N/A' ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "No service providers found.";
        }
        ?>
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
