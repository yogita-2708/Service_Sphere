<!-- Section 1 -->
<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider</title>
    <link rel="stylesheet" href="../assets/css/aos.css">
    <style>
        .wholecontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            filter: brightness(0.6);
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('../images/service1.jpeg');
            background-size: cover;
            background-position: right;
        }
        .bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 1;
        }
        .bg-text h1 {
            overflow: hidden;
            white-space: nowrap;
            animation: typing 5s steps(50, end) infinite;
        }
        .sec-four-container {
            position: relative;
            margin-top: 100vh;
        }
        .video1 {
            width: 100%;
            height: 100%; 
            object-fit: cover; 
        }
        .video1{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: transform 0.4s;
        }

        .video1:hover{
            transform: scale(1.05);
        }

        @keyframes typing {
            from {
                width: 60%;
            }
            to {
                width: 100%;
            }
        }
        
        .dropdown-container-home {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
            z-index: 1;
            width: 40vw;
        }
        
        .dropdown-toggle-home::after {
            position: absolute;
            top: 50%;
            right: 20px; 
            transform: translateY(-60%);
            padding: 1px;
            width: 15px; 
        }
        .knowmorebtn {
            width: 10vw;
        }
        .card-img-top {
            height: 30vh;
        }
        @media (max-width: 571px) {
            .video-container {
                height: 50vh;
            }
            .bg-img {
                height: 50vh;
            }
            .bg-text {
                transform: translate(-50%, -550%);
            }
            .dropdown-container-home {
                width: 80vw;
                transform: translate(-50%, -350%);
            }
            .sec-four-container {
                position: relative;
                margin-top: 50vh;
                width: 90%;
            }
            .sec-five-container h1 {
                margin-left: 2.5rem;
            }
            .knowmorebtn {
                width: 100%;
            }
        }
   
    </style>
</head>
<body class="wholecontainer">
<!-- Section 2 -->

<div class="bg-img"></div>

<!-- Section 3 (Captions) -->

<div class="bg-text">
    <h1 class="text-white text-center">Seamless Access to Expertise...</h1>
</div>

<!-- Section 4 -->

<div class="container sec-four-container">
    <div class="row">
        <div class="col-md-6">
            <p class="d-block fs-5 fw-medium mt-5" style="text-align: justify;" data-aos="fade-right">
                Welcome to Service Sphere, your premier destination for all your service needs. We offer a wide range of expert services, from home maintenance and repair to vehicle care and more, all aimed at enhancing your daily life. Our dedicated team of professionals is committed to providing top-notch service, ensuring your satisfaction every step of the way. Whether you're looking to transform your living space or keep your vehicle running smoothly, we're here to help. Experience the convenience of seamless service delivery with Service Sphere – where effortless living begins.
            </p>
        </div>
        <div class="col-md-6">
          <div class="m-auto" data-aos="fade-left">
            <video
              src="../assets/video/video2.mp4"
              autoplay
              muted
              loop
              class="rounded-3 video1"
            ></video>
          </div>
        </div>
    </div>
</div>

<!-- Section 5 (Services) -->

<div class="container sec-five-container mt-5 mb-4">
    <h1 class="text-start fw-bold mb-4">Discover Our Offerings</h1>
    <div class="row sec-three">
        <?php
        require_once "../db/dbconnect.php";

        $qry = "SELECT services.*, category.cat_name FROM services INNER JOIN category ON services.cat_id = category.cat_id";
        $res = $conn->query($qry);
        while($ns = $res->fetch_assoc())
        {
        ?>
        <div class="col-md-4 col-sm-12 mb-4 mt-4" data-aos="zoom-in">
            <div class="card rounded-0 bg-transparent border-0 mx-5">
                <img src="<?php echo "../images/".$ns['picture']; ?>" class="card-img-top rounded-4 shadow" alt="Service 1">
                <div class="card-body px-0">
                    <button class="btn btn-sm mb-3 bg-secondary text-white border-0 shadow-sm"><?php echo $ns['cat_name']; ?></button>
                    <h5 class="card-title text-dark"><b><?php echo $ns['s_name']; ?></b></h5>
                    <p class="card-text text-dark" style="text-align: justify;"><?php echo $ns['s_desc']; ?></p>
                    
                </div>
            </div>
        </div>
        <?php } ?>
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
<!-- Section 7 (Footer) -->
<?php include_once "sp_footer.php"; ?>
