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
            background: url('images/services3.jpg');
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
<?php } ?>


<!-- Section 4 (Drop Down Menu) -->

<?php if(isset($_SESSION['accesslevel'])) { ?>
<div class="dropdown-container-home">
    <div class="dropdown-home" data-aos="zoom-in">
        <button class="dropdown-toggle dropdown-toggle-home w-100 p-3 rounded-3 text-start fs-5 bg-light border-0 shadow-lg text-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="bi bi-geo-alt-fill"></i><span class="d-inline mx-2">Please choose a service</span>
        </button>
        <div class="dropdown-menu dropdown-menu-home w-100" aria-labelledby="dropdownMenuButton">

            <?php
                    require_once "db/dbconnect.php";
                    $service_query = "SELECT * FROM services";
                    $service_result = $conn->query($service_query);

                    if ($service_result->num_rows > 0) {
                        while($row = $service_result->fetch_assoc()) {
                            echo '<a class="dropdown-item fw-medium" href="service_details.php?service_id=' . $row["service_id"] . '">' . $row["s_name"] . '</a>';
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