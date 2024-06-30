<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <style>
        .wholeservicecontainer {
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
        .search-container-home {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 40vw;
        }
        .form-control:focus {
            box-shadow: none !important;
        }
        .sec-three-container {
            position: relative;
            margin-top: 25vh;
        }
        .card-img-top {
            height: 350px;
        }
        .knowmorebtn {
            width: 25%;
        }
        @media (max-width: 571px) {
            .search-container-home {
                width: 80vw;
                transform: translate(-50%, -120%);
                height: 5vh;
            }
            .sec-three-container {
                position: relative;
                margin-top: 20vh;
                width: 90%;
            }
            .knowmorebtn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="wholeservicecontainer">

<!-- Section 2 - Search Form with Dropdown for Price Range -->
<div class="search-container-home mt-2">
    <form class="form-inline mb-4" action="services.php" method="get">
        <div class="input-group shadow-lg" data-aos="zoom-in">
            <input type="text" class="form-control bg-light border-0 text-secondary fw-medium" placeholder="Search for 'Services'" name="search" aria-label="Search" aria-describedby="basic-addon2">
            <select class="form-control bg-light border-0 text-secondary fw-medium p-3" name="price_range">
                <option value="">Select Price Range</option>
                <option value="100-1000">Below ₹1000</option>
                <option value="1000-3000">₹1000 - ₹3000</option>
                <option value="3000-6000">₹3000 - ₹6000</option>

            </select>
            <div class="input-group-append p-2 bg-dark rounded-end border-3 btn">
                <button class="btn border-0 text-white bg-dark" type="submit">
                    <i class="bi bi-search fs-5"></i>
                </button>
            </div>
        </div>
    </form>
</div>


<!-- Section 3 -->

<div class="container sec-three-container">
    <div class="row mt-5">
        <?php
        require_once "db/dbconnect.php";

        $qry = "SELECT DISTINCT services.*, category.cat_name, service_service_provider.s_price FROM services INNER JOIN category ON services.cat_id = category.cat_id INNER JOIN service_service_provider ON service_service_provider.service_id = services.service_id";

        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = $_GET['search'];
            $qry .= " WHERE services.s_name LIKE '%$search%' OR services.s_desc LIKE '%$search%' OR category.cat_name LIKE '%$search%'";
        }

        // Handling price range filtering
        if(isset($_GET['price_range']) && !empty($_GET['price_range'])) {
            $price_range = $_GET['price_range'];
            list($min_price, $max_price) = explode('-', $price_range);

            // If search query is also submitted
            if(isset($_GET['search']) && !empty($_GET['search'])) {
                $qry .= " AND service_service_provider.s_price BETWEEN $min_price AND $max_price";
            } else {
                $qry .= " WHERE service_service_provider.s_price BETWEEN $min_price AND $max_price";
            }
        } elseif (!isset($_GET['search'])) {
            $qry .= " WHERE 1"; // Selects all services
        }
            $qry .= " GROUP BY services.service_id";

        $res = $conn->query($qry);
        while($ns = $res->fetch_assoc())
        {
        ?>
        <div class="col-md-6 mb-5" data-aos="zoom-in">
            <div class="card rounded-0 bg-transparent border-0 mx-5">
                <img src="<?php echo "images/".$ns['picture']; ?>" class="card-img-top rounded-3 shadow" alt="Service 1">
                <div class="card-body px-0 my-2">
                    <button class="btn btn-sm mb-3 bg-secondary text-white border-0 shadow-sm"><?php echo $ns['cat_name']; ?></button>
                    <h5 class="card-title text-dark mb-3 mt-1"><b><?php echo $ns['s_name']; ?></b></h5>
                    <p class="card-text text-dark" style="text-align: justify;"><?php echo $ns['s_desc']; ?></p>
                    <?php if(isset($_SESSION['accesslevel'])) { ?>
                        <a href="service_details_try.php?service_id=<?php echo $ns['service_id']; ?>" class="btn mt-4 d-block shadow bg-warning text-white knowmorebtn">KNOW MORE</a>
                    <?php } else { ?>
                        <button class="btn mt-4 d-block shadow bg-warning text-white knowmorebtn" onclick="bookServices()">KNOW MORE</button>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<script>
    function bookServices() {
        var confirmtoknow = confirm("Please SignUp or Login to Know More!!");
        if(confirmtoknow) {
            window.location.href = "login.php";
        }
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
<!-- Section 4 (Footer) -->
<?php include_once "include/footer.php"; ?>
