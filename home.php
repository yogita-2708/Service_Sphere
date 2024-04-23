<!-- Section 1 -->
<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere</title>
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        .wholecontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            filter: brightness(0.8);
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('images/service1.jpeg');
            background-size: cover;
            background-position: right;
        }
        .bg-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -240%);
            text-align: center;
            z-index: 1;
        }
        .bg-text h2 {
            overflow: hidden;
            white-space: nowrap;
            animation: typing 5s steps(50, end) infinite;
        }

        @keyframes typing {
            from {
                width: 60%;
            }
            to {
                width: 100%;
            }
        }
        .home-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            text-align: center;
            font-size: 2rem;
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
                transform: translate(-50%, -750%);
            }
            .home-text {
                transform: translate(-50%, -190%);
                text-align: justify;
                
            }
            .dropdown-container-home {
                width: 80vw;
                transform: translate(-50%, -350%);
            }
            .sec-five-container {
                position: relative;
                margin-top: 50vh;
                width: 90%;
            }
            .knowmorebtn {
                width: 100%;
            }
        }
   
    </style>
</head>
<body class="wholecontainer">

<!-- Section 2 -->

<?php if(isset($_SESSION['accesslevel'])) { ?>
<div class="bg-img"><div class="sec-bgimg"></div></div>
<?php } else { ?>
    <div class="video-container">
        <video
            src="assets\video\video1.mp4"
            autoplay
            muted
            loop
            class="video2"
        ></video>
        <div class="sec-one">
        </div>
    </div>
<?php } ?>


<!-- Section 3 (Captions) -->

<?php if(isset($_SESSION['accesslevel'])) { ?>
    <div class="bg-text">
        <h2 class="text-white text-center">Seamless Access to Expertise...</h2>
    </div>
<?php } else { ?> 
    <div class="home-text">
        <p class="text-light fw-medium fs-6 d-lg-none">"Embarking on a journey to transform homes and vehicles, one service at a time. Welcome to the gateway of effortless living"</p>
        <p class="text-light fw-medium d-none d-lg-block" id="hometext"></p>
    </div>
<?php } ?>


<!-- Section 4 (Drop Down Menu) -->

<?php if(isset($_SESSION['accesslevel'])) { ?>
<div class="dropdown-container-home">
    <div class="dropdown-home" data-aos="zoom-in">
        <button class="dropdown-toggle dropdown-toggle-home w-100 p-3 rounded-3 text-start fs-5 bg-light border-0 shadow-lg text-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-geo-alt-fill"></i><span class="d-inline mx-2">Please select your location</span>
        </button>
        <div class="dropdown-menu dropdown-menu-home w-100" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item bg-light fs-5 mt-1" href="">
                <img src="images/flag.png" alt="Indian Flag" style="width: 25px; height: 20px; margin-right: 8px;"> India
            </a>
            <!-- <a class="dropdown-item fw-medium" href="service.php">Bhubaneswar</a>
            <a class="dropdown-item fw-medium" href="service.php">Cuttack</a>
            <a class="dropdown-item fw-medium" href="service.php">Rourkela</a> -->

            <?php
                    require_once "db/dbconnect.php";
                    $cityname_query = "SELECT city_id, city_name FROM city";
                    $cityname_result = $conn->query($cityname_query);

                    if ($cityname_result->num_rows > 0) {
                        while($row = $cityname_result->fetch_assoc()) {
                            echo '<a class="dropdown-item fw-medium" href="services.php?id=' . $row["city_id"] . '">' . $row["city_name"] . '</a>';
                        }
                    } else {
                        echo "0 results";
                    }
            ?>
        </div>
    </div>
</div>
<?php } ?>

<!-- Section 5 -->

<div class="container sec-five-container">
    <div class="row">
        <div class="col-md-6">
            <p class="d-block fs-5 fw-medium mt-5" style="text-align: justify;" data-aos="fade-right">
                Welcome to Service Sphere, your premier destination for all your service needs. We offer a wide range of expert services, from home maintenance and repair to vehicle care and more, all aimed at enhancing your daily life. Our dedicated team of professionals is committed to providing top-notch service, ensuring your satisfaction every step of the way. Whether you're looking to transform your living space or keep your vehicle running smoothly, we're here to help. Experience the convenience of seamless service delivery with Service Sphere – where effortless living begins.
            </p>
        </div>
        <div class="col-md-6">
          <div class="m-auto" data-aos="fade-left">
            <video
              src="assets/video/video2.mp4"
              autoplay
              muted
              loop
              class="rounded-3 video1"
            ></video>
          </div>
        </div>
    </div>
</div>

<!-- Section 6 (Services) -->

<div class="container sec-three-container mt-5 mb-4">
    <h1 class="text-start fw-bold mb-4">Discover Our Offerings</h1>
    <div class="row sec-three">
        <?php
        require_once "db/dbconnect.php";

        $qry = "SELECT services.*, category.cat_name FROM services INNER JOIN category ON services.cat_id = category.cat_id";
        $res = $conn->query($qry);
        while($ns = $res->fetch_assoc())
        {
        ?>
        <div class="col-md-4 col-sm-12 mb-4 mt-4" data-aos="zoom-in">
            <div class="card rounded-0 bg-transparent border-0 mx-5">
                <img src="<?php echo "images/".$ns['picture']; ?>" class="card-img-top rounded-4 shadow" alt="Service 1">
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


<script>
var i = 0;
var txt = '"Embarking on a journey to transform homes and vehicles, one service at a time. Welcome to the gateway of effortless living"';
var speed = 40;

function typeWriter() {
  if (i < txt.length) {
    document.getElementById("hometext").innerHTML += txt.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}

window.onload = function() {
  typeWriter();
};
</script>

<script>
  function Checklogin() {
    <?php if (!isset($_SESSION['accesslevel'])) { ?>
      alert("Please Sign Up or Login to Know More about services!!");
      window.location.href = 'signup.php';
    <?php } ?>
  }
</script>
<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });
</script>

</body>
</html>
<!-- Section 7 (Footer) -->
<?php include_once "include/footer.php"; ?>
