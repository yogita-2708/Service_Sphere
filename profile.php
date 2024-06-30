<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere</title>
    <style>
        .profilecontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
            overflow-y: hidden;
        }
        .wholecontainer {
            height: 80vh;
        }
        .leftcontainer {
            padding-top: 70px;
        }
        .profileicon {
            font-size: 80px;
        }
        .gradient-custom {
        background: #f6d365;
        background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
        background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
    </style>
</head>
<body class="profilecontainer">
    <?php
        if (!isset($_SESSION['user_id'])) {
            header("Location: login.php"); 
            exit();
        }
        require_once "db/dbconnect.php"; 
        $user_id = $_SESSION['user_id'];
        $qry = "SELECT customer.*, AVG(rating) AS rating, COUNT(booking.book_id) AS total_bookings 
                FROM customer 
                LEFT JOIN sp_cus_review ON customer.user_id = sp_cus_review.user_id 
                LEFT JOIN booking ON customer.user_id = booking.user_id 
                WHERE customer.user_id = $user_id";
        $res = $conn->query($qry);
        if($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
    ?>
    <section class="vh-100">
    <div class="container-fluid py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center wholecontainer">
        <div class="col col-lg-6 mb-4 mb-lg-0">
            <div class="card mb-3 rounded shadow">
            <div class="row g-0">
                <div class="col-md-4 gradient-custom text-center text-white leftcontainer"
                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <i class="bi bi-person-circle profileicon"></i>
                <h5 class="mt-2"><?php echo $row['user_name'] ?></h5>
                </div>
                <div class="col-md-8">
                <div class="card-body p-4">
                    <h6>Profile Details <a href="edit_profile.php?id=<?php echo $row['user_id']; ?>" class="text-secondary"><i class="bi bi-pencil-square mx-2 fs-5"></i></a></h6>
                    <hr class="mt-0 mb-4">
                    <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <p class="text-muted fw-medium"><?php echo $row['user_email'] ?></p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Phone</h6>
                        <p class="text-muted fw-medium"><?php echo $row['user_mob'] ?></p>
                    </div>
                    </div>
                    <h6></h6>
                    <hr class="mt-0 mb-5">
                    <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Rating</h6>
                        <p class="text-muted fw-medium"><?php echo ($row['rating'] !== null) ? number_format($row['rating'], 1) : 'N/A' ?></p>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Total Bookings</h6>
                        <p class="text-muted fw-medium mx-1"><?php echo $row['total_bookings']; ?></p>
                    </div>
                    </div>
                    <div class="d-flex justify-content-start">
                    <a href=""><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href=""><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href=""><i class="fab fa-instagram fa-lg"></i></a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>
    <?php }
        } else {
            echo "No user found.";
        }
    ?>
</body>
</html>
<?php include_once "include/footer.php"; ?>
