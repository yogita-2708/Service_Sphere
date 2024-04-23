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
            <div class="form-group d-flex">
                <input type="text" name="start_otp" class="form-control me-1" placeholder="Enter OTP">
                <button type="button" class="btn bg-warning shadow-sm text-white" onclick="generateOTP()">OTP</button>
            </div>
            
            <div id="otp" class="mb-4"></div>
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
            
            <input type="submit" name="sub" value="BOOK NOW" class="from-control btn bg-warning text-white shadow mt-2">
        </form>

    </div>
    <script>
        // Define a variable to keep track of whether OTP is generated
        let otpGenerated = false;

        function generateOTP(){
            let otp = Math.floor(1000 + Math.random() * 9000);
            let otp_div = document.getElementById('otp');
            let p = `<p>Your four digit OTP: ${otp}, Do not share with anyone.</p>`;
            otp_div.innerHTML = p;
            // Set otpGenerated to true when OTP is generated
            otpGenerated = true;
        }

        // Add event listener to the form submit event
        document.getElementById('bookingForm').addEventListener('submit', function(event) {
            // Check if OTP is generated
            if (!otpGenerated) {
                // If OTP is not generated, prevent form submission
                event.preventDefault();
                alert('Please generate OTP before submitting the form.');
            } else {
                // If OTP is generated, allow form submission
                otpGenerated = false; // Reset otpGenerated for next submission
            }
        });



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
    </script>

</body>
</html>
<?php include_once "include/footer.php"; ?>
