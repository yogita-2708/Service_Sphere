<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <style>
        .wholenoticontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .noticontainer{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        .card-body p{
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 18px;
        }
    </style>
</head>
<body class="wholenoticontainer">

<div class="container noticontainer">
    <div class="row mt-5">
        <?php
        require_once "../db/dbconnect.php";

        if (isset($_SESSION['sp_id'])) {
            $sp_id = $_SESSION['sp_id'];

            $qry = "SELECT booking.*, customer.user_name, notification.time 
                    FROM booking 
                    INNER JOIN customer ON booking.user_id = customer.user_id 
                    INNER JOIN notification ON booking.sp_id = notification.sp_id 
                    WHERE booking.sp_id = ? 
                    ORDER BY booking.book_date DESC";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("i", $sp_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-12 mb-5" data-aos="zoom-in">
                        <div class="card shadow bg-light">
                            <div class="card-body text-dark">
                                <h3 class="fw-bold mb-4">Booking Received</h3>
                                <p><i class="bi bi-calendar mx-1"></i> Date: <?php echo $row['book_date'] ?></p>
                                <p><i class="bi bi-clock mx-1"></i> Time: <?php echo $row['time'] ?></p>
                                <p class="mb-1 mt-3">You have received a booking from "<?php echo $row['user_name'] ?>"</p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-12 mb-5 alert alert-light' role='alert'>No bookings found.</div>";
            }
        } else {
            echo "<div class='col-md-12 mb-5 alert alert-secondary' role='alert'>Please log in as a service provider to view notifications.</div>";
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
<?php include_once "sp_footer.php"; ?>
