<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Service</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <style>
        .wholeservicecontainer {
            position: relative;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('images/services3.jpg');
            background-size: cover;
            background-position: right;
        }
        .sec-one {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(37, 37, 37, 0.521);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        .singleservicecontainer {
            max-height: 90vh; 
            overflow-y: auto;
            width: 50%;
        }
        .singleservicecontainer::-webkit-scrollbar {
            width: 0; /* to hide scrollbar */
        }
        .singleservicecontainer img {
            transition: transform 0.4s;
        }
        .singleservicecontainer img:hover {
            transform: scale(1.05);
        }
        .duration {
            text-align: right;
        }
        @media (max-width: 768px) {
            .singleservicecontainer {
                width: 90%;
            }
            .duration {
                text-align: left;
            }
        }
    </style>
</head>
<body class="wholeservicecontainer">
<div class="bg-img"><div class="sec-one"></div></div>

<?php
require_once "db/dbconnect.php";

if(isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];
    
    $qry = "SELECT services.*, category.cat_name FROM services INNER JOIN category ON services.cat_id = category.cat_id WHERE service_id = $service_id";
    $res = $conn->query($qry);
    
    if($res->num_rows > 0) {
        $ns = $res->fetch_assoc();
?>
<div class="overlay">
    <div class="container singleservicecontainer bg-transparent rounded-4" data-aos="fade-up">
        <div class="row mt-2 mx-auto rounded-4 bg-white container-fluid p-4">
            <a href="services.php" class="btn-close fs-6" aria-label="Close"></a>
            <h4 class="text-start text-dark mb-4 mt-3 fw-bold"><?php echo $ns['s_name']; ?></h4>
            <div class="col-md-12">
                <img src="<?php echo "images/".$ns['picture']; ?>" class="img-fluid rounded mt-2 shadow" alt="Service Image">
            </div>
            <div class="col-md-12 col-sm-12 my-4">
                <button class="btn btn-sm mb-3 bg-secondary text-white border-0 shadow-sm"><?php echo $ns['cat_name']; ?></button>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text text-dark fw-bold text-start">Price:- ₹<?php echo $ns['s_price']; ?></p>
                    </div>
                    <div class="col-md-6 duration">
                        <p class="card-text text-dark fw-bold">Duration (H:M:S):- <?php echo $ns['s_duration']; ?></p>
                    </div>
                </div>
            </div>
                <p class="text-dark fw-medium" style="text-align: justify;"><?php echo $ns['s_desc']; ?></p>
            </div>
        </div>
    </div>
</div>
<?php 
    }
} else {
    echo "No service details found.";
}
?>


<script src="assets/js/aos.js"></script>
<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });

    function closeOverlay() {
        document.querySelector('.overlay').style.display = 'none';
    }
</script>

<script src="assets\js\bootstrap.bundle.min.js"></script>

</body>
</html>
