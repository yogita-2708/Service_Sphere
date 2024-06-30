<?php include_once "include/navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets\js\jquery-3.7.1.js"></script>
    <title>Service Sphere</title>
    <style>
        body{
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
        .form-control{
            background:rgba(128, 128, 128, 0.1);
        }
        #map { height: 400px; }
        a{
            text-decoration:none;
        }
        .form-check-input {
            border: 2px solid grey;
        }
        .form-control {
            border: 1px solid grey;
            color: black;
        }

        @media (min-width: 768px){
            .ms-md-5 {
                margin-left: 61.5rem !important;
            }
        }
        
    </style>
</head>
<body>
    <div class="container mt-1 mt-md-5">
        <h2 class="text-center fw-bold text-dark display-5 mb-2 mb-md-4">Booking Page</h2>
        <form id="bookingForm" action="operations/book_table_insert.php" class="bg-light p-2 p-md-5 mx-auto rounded shadow mb-5" method="POST">
            <?php
                if(!isset($_GET['id'])){
                    header("location:services.php");
                }else{
                    $id = $_GET['id'];
                    $spid = $_GET['sid'];
                    // session_start();
                    $user_id = $_SESSION['user_id'];
                }
                require_once "db/dbconnect.php";
                $sql = "SELECT * FROM address WHERE user_id = $user_id";
                $res = $conn->query($sql);
                if($res->num_rows > 0){
                    while($row = $res->fetch_assoc()){
                        ?>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="radio" name="address" value="<?php echo $row['addr_id'] ?>">
                                <label class="form-check-label">
                                    <div class="d-flex align-item-center">
                                        <div>
                                            <h5><?php echo $row['name'] ?></h5>
                                            <h6><?php echo $row['phone'] ?></h6>
                                            <p><?php echo $row['addrs'] ?></p>
                                        </div>
                                        <div class="ms-3 ms-md-5">
                                            <a href="#" class="btn bg-success text-white border border-success d-block mb-2">EDIT</a>
                                            <a href="#" class="btn bg-danger text-white border border-danger d-block">DELETE</a>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        <?php
                    }
                    ?>
                        <a href="address.php" class="btn bg-warning text-white shadow d-block mb-3">ADD NEW</a>
                    <?php
                }else{
                    ?>
                        <p class="fw-light">If you have not set your address, click <a href="address.php">Here</a>.</p>
                    <?php
                }
            ?>
            <hr>
            
            
            <!-- <div id="otp" class="mb-4"></div> -->
            <div class="form-text text-dark fs-6 mb-2 fw-medium">Select a Time Slot</div>
            <div class="d-flex flex-wrap justify-content-between mb-4">
                <div class="form-check">
                    <input name="slot" class="form-check-input" type="checkbox" value="8.10" class="check">
                    <label class="form-check-label">
                        8AM - 10AM 
                    </label>
                </div>
                <div class="form-check">
                    <input name="slot" class="form-check-input" type="checkbox" value="10.12" class="check">
                    <label class="form-check-label" >
                        10AM - 12PM
                    </label>
                </div>
                <div class="form-check">
                    <input name="slot" class="form-check-input" type="checkbox" value="2.4" class="check">
                    <label class="form-check-label" >
                        2PM - 4PM
                    </label>
                </div>
                <div class="form-check">
                    <input name="slot" class="form-check-input" type="checkbox" value="4.6" class="check">
                    <label class="form-check-label" >
                        4PM - 6PM
                    </label>
                </div>
            </div>
            <div id="slot">
                <p></p>
            </div>
            
            <hr>
            <div class="form-text">
                <?php
                    $qry = "SELECT * FROM service_service_provider WHERE service_id = $id AND sp_id = $spid";
                    $res_ser = $conn->query($qry);
                    if($res_ser->num_rows>0){
                        $row = $res_ser->fetch_assoc();
                        ?>
                            <p class="text-dark fs-6 fw-medium">Price: <?php echo $row['s_price']; ?></p>
                            <p class="text-dark fs-6 fw-medium">Distance Charges: 
                                <?php
                                    print $row['s_price']*0.10; 
                                ?>
                            </p>
                            <p class="text-dark fs-6 fw-medium">Total Price: <?php print $row['s_price']*1.10; ?></p>
                        <?php
                    }
                ?>
                <input class="d-none" type="text" name="total_price" value="<?php print $row['s_price']*1.10; ?>">
                <input class="d-none" type="text" name="sp_id" value="<?php echo $spid; ?>">
                <input class="d-none" type="text" name="service_id" value="<?php echo $id; ?>">
            </div>
            
            <input type="submit" name="sub" value="BOOK NOW" class="from-control btn bg-warning text-white shadow mt-2" onclick="generateMail(event)">
        </form>

    </div>
    <script>

        $(document).ready(function () {
            $("form input[type=checkbox]").change(function () {
                if($("input[type=checkbox]").is(":checked")){
                let val = $("input[type=checkbox]:checked").val();
                console.log(val);
                $.post("assets/ajax/check_slot.php", {
                        value: val,
                        sp_id: <?php echo $spid; ?>
                    },
                    function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        console.log(data);
                        if (data[0]['slot_count'] == 2) {
                            let para = `<p>This slot have maximum booking, Please select another.<p>`;
                            $('#slot p').html(para);
                            $('#slot').show();
                            $("input[type=checkbox]:checked").each(function(){this.checked = false;});
                        }else{
                            $('#slot').hide();
                        }
                    }
                )
                }else{
                    $('#slot').hide();
                }
            })
        })

        function generateMail(e) {
            let id = <?php echo $id ?>;
            let spid = <?php echo $spid?>;
            let price = <?php print $row['s_price']*1.10 ?>;
            let box = $("input[type=checkbox]:checked").val();
            let slot_arr = box.split(".");
            let val = slot_arr.join("-");

            let requestData = "id=" + id + "&spid=" + spid + "&price=" + price + "&val=" + val;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", false); // Set false for synchronous request
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(requestData);

            // Check the response and handle form submission accordingly
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                alert("Check Your Mail.");
            } else {
                e.preventDefault();
                alert('Failed to send OTP. Please try again.');
            }
        }


    </script>



    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Retrieve the OTP from the POST data
            $id = $_POST['id']; // Retrieve the service ID from the form
            $spid = $_POST['spid'];
            $price = $_POST['price'];
            $slot = $_POST['val'];
            require_once "db/dbconnect.php";
            $sql1 = "SELECT * FROM services WHERE service_id = $id";
            $sql2 = "SELECT * FROM service_provider WHERE sp_id = $spid";
            $res1 = $conn->query($sql1);
            $res2 = $conn->query($sql2);
            if($res1->num_rows > 0 && $res2->num_rows > 0){
                $row1 = $res1->fetch_assoc();
                $row2 = $res2->fetch_assoc();
                $s_name = $row1['s_name'];
                $sp_name = $row2['sp_name'];
                $sp_phone = $row2['sp_phone'];
                $sp_email = $row2['sp_email'];
                $s_duration = $row1['s_duration'];
            }
            // Compose the email message with the OTP
            $to = "bikashswain754231@gmail.com";
            $subject = "Service Sphere: Booking Confirmation";
            $message = "
            
            Hey Service Sphere User,<br><br>Your booking has successfully done!<br>
            <strong>Service Name: </strong>$s_name<br>
            <br>
            <h2>Service Provider Details</h2>
            <strong>Service Provider Name: </strong>$sp_name<br>
            <strong>Phone: </strong>+91 $sp_phone<br>
            <strong>Email: </strong>$sp_email<br><br>
            <h2>Booking Details</h2>
            <strong>Price: </strong>$price<br>
            <strong>Slot: </strong>$slot<br>
            <strong>Duration: </strong>$s_duration<br><br>
            

            Thank you for booking.
            ";
            $headers = [
                "MIME-Version: 1.0",
                "Content-type: text/html; charset=utf-8",
                "From: bn965362@gmail.com"
            ];
            $headers = implode("\r\n",  $headers);
            // Send the email
            $check = mail($to, $subject, $message, $headers);
    
            if($check){
                echo "<script>alert('Email sent successfully.');</script>";
            } else {
                echo "<script>alert('Email not sent.');</script>";
            }
        
    }
    ?>


</body>
</html>
<?php include_once "include/footer.php"; ?>
