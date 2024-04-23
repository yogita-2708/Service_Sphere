<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="assets/css/aos.css">
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
        require_once "db/dbconnect.php";

        if (isset($_SESSION['accesslevel'])) {
            $access_level = $_SESSION['accesslevel'];

            $qry = "SELECT notify_id, subject, message, date, time FROM notification INNER JOIN customer ON notification.user_id = customer.user_id WHERE accesslevel <= ? ORDER BY date DESC, time DESC";
            $stmt = $conn->prepare($qry);
            $stmt->bind_param("i", $access_level);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-12 mb-5" data-aos="zoom-in">
                        <div class="card shadow bg-light">
                            <div class="card-body text-dark">
                                <h3 class="fw-bold mb-4"><?php echo $row['subject'] ?></h3>
                                <p><i class="bi bi-calendar mx-1"></i> Date: <?php echo $row['date'] ?></p>
                                <p><i class="bi bi-clock mx-1"></i> Time: <?php echo $row['time'] ?></p>
                                <p class="mb-1 mt-3"><?php echo $row['message'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='col-md-12'><p>No notifications found.</p></div>";
            }
        } else {
            echo "<div class='col-md-12'><p>Please log in to view notifications.</p></div>";
        }
        ?>
    </div>
</div>

<script src="assets/js/aos.js"></script>
<script>
    AOS.init({
        offset: 200,
        duration: 1000,
    });
</script>

</body>
</html>
<?php include_once "include/footer.php"; ?> 