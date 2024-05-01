<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere</title>
    <link rel="stylesheet" href="assets/css/aos.css">
    <style>
        .wholeservicedetailscontainer {
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
        .user-message {
            color: black; 
        }
        .sp-message {
            color: blue; 
        }

        #chatIcon {
            position: fixed;
            bottom: 10px;
            right: 5px;
            z-index: 999;
        }

        .chat-interface {
            position: fixed;
            bottom: 60px;
            right: 5px;
            width: 355px; 
            display: none; 
            z-index: 999; 
        }
        .chat-interface.show {
            display: block; 
        }
    </style>
</head>
<body class="wholeservicedetailscontainer">
    <div class="container singleservicecontainer" data-aos="fade-up">
        <div class="row mt-2 mb-4 mx-auto rounded-4 bg-transparent container-fluid p-4 position-relative justify-content-center">
            <div class="row">
            <?php
                require_once "../db/dbconnect.php";
                if(isset($_GET['id'])){
                    $service_id = $_GET['id'];
                }else{
                    header("location:booked_customer.php");
                }
                $sp_id = $_SESSION['sp_id'];
                $qry = "SELECT * FROM booking NATURAL JOIN customer NATURAL JOIN services NATURAL JOIN address NATURAL JOIN service_service_provider NATURAL JOIN category WHERE sp_id = $sp_id AND service_id = $service_id";
                $res = $conn->query($qry);
                if($res){
                if($res->num_rows > 0){
                    $row = $res->fetch_assoc()
            ?>
            <h3 class="text-start text-dark mb-4 mt-4 fw-bold"><?php echo $row['s_name']; ?></h3>
            <div class="col-md-6">
                <img src="<?php echo "../images/".$row['picture']; ?>" class="img-fluid rounded mt-2 shadow mb-2" alt="Service Image">
            </div>
                <div class="col-md-6 mt-1">
                    <button class="btn btn-sm mb-4 mt-2 mt-md-5 bg-secondary text-white border-0 shadow-sm"><?php echo $row['cat_name']; ?></button>
                    <div class="row">    
                        <div class="col-md-6">
                            <p class="fw-medium">Customer Name: <b class="card-text text-dark fw-bold"><?php echo $row['user_name']; ?></b></p>
                            <p class="fw-medium">Email: <b class="card-text text-dark fw-bold"><?php echo $row['user_email']; ?></b></p>
                        </div>
                    </div>
                    <p class="text-dark fw-medium mt-3" style="text-align: justify;"><?php echo $row['s_desc']; ?></p>
                </div>
            </div>
            <hr class="mt-5">
            <div class="row p-4 mt-3 mx-auto">

                <div class="col-md-6 bg-light rounded-start p-4">
                    <h3 class="text-start text-dark mb-4 mt-2 fw-bold">Address Details</h3>
                    <p>Name: <b class="card-text text-dark fw-bold"><?php echo $row['name']; ?></b></p>
                    <p>Phone: <b class="card-text text-dark fw-bold"><?php echo $row['phone']; ?></b></p>
                    <p>Alternate Phone: <b class="card-text text-dark fw-bold"><?php echo $row['alter_phone']; ?></b></p>
                    <p>Address: <b class="card-text text-dark fw-bold"><?php echo $row['addrs']; ?></b></p>
                    <p>Landmark: <b class="card-text text-dark fw-bold"><?php echo $row['landmark']; ?></b></p>
                </div>
                <div class="col-md-6 bg-light rounded-end p-4">
                    <h3 class="text-dark mb-4 mt-2 fw-bold">Booking Details</h3>
                    <div class="row">    
                        <div class="col-md-6">
                            <p>Booking Date: <b class="card-text text-dark fw-bold"><?php echo $row['book_date']; ?></b></p>
                            <p>Total Price: <b class="card-text text-dark fw-bold"><?php echo $row['total_price']; ?></b></p>
                            <p>Slot: <b class="card-text text-dark fw-bold"><?php 
                                $slot = $row['slot'];
                                echo str_replace('.', '-', $slot); 
                            ?>
                            </b></p>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- Adding a chat icon button -->
            <button id="chatIcon" class="btn bg-warning text-white shadow mb-5"><i class="bi bi-chat-left-text-fill fs-5"></i></button>

                <!-- Chat interface -->
                <div id="chatInterface" class="card mt-4 mb-5 chat-interface">
                    <div class="card-header">Chat with user <i class="bi bi-chat-dots text-warning mx-1 fs-5"></i></div>
                        <div class="card-footer">
                            <form id="chatForm" class="mt-2 mb-2" action="../operations/message_insert_sp.php" method="post">
                                <input type="text" id="messageInput" name="message" class="form-control d-inline mx-0 w-75 h-75" placeholder="Message...">
                                <input type="text" name="service_id" value="<?php echo $service_id; ?>" hidden>
                                <input type="text" name="user_id" value="<?php echo $row["user_id"]; ?>" hidden>
                                <button type="submit" class="btn btn-sm text-white fs-6 bg-warning mb-2 mx-2" name="sub">SEND</button>
                            </form>
                        </div>

                        <div class="container chat-body mt-2 mb-1">
                            <?php
                                $sp_id = $_SESSION['sp_id'];
                                $sql1 = "SELECT * FROM messages WHERE sp_id = $sp_id";
                                $result1 = $conn->query($sql1);
                                if($result1->num_rows > 0){
                                    while($row = $result1->fetch_assoc()){
                                        $messageClass = ($row['status'] == 'sp') ? 'sp-message' : 'user-message';
                                        ?>
                                            <p class="ms-2 <?php echo $messageClass; ?>"><?php echo $row['m_content']; ?></p>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        
                    </div>
                </div>

            <?php
                }else{
                    echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
                }
                }else{
                    echo "<h3 class='text-center text-dark'>No Current Booking Found</h3>";
                }
            ?>
        </div>
    </div>



<script>
    document.getElementById('chatIcon').addEventListener('click', function() {
        document.getElementById('chatInterface').classList.toggle('show');
    });
</script>

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
