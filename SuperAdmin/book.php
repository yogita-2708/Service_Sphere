<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body{
            background-color: rgba(128, 128, 128, 0.4);
        }
        .form-control{
            background:rgba(128, 128, 128, 0.1)
        }
        @media (max-width: 571px){
            .w{
                width: 90%;
            }
            
        }
        #map { height: 400px; }
        a{
            text-decoration:none;
        }
        
    </style>
</head>
<body>
    <div class="container mt-2 mt-md-5 mb-3">
        <h2 class="text-center fw-bold text-warning">Booking Page</h2>
        <form action="" class="bg-white w p-2 p-md-5 mx-auto rounded shadow" method="post">
            <?php
                require_once "Database/db_connection.php";
                $sql = "SELECT * FROM address";
                $res = $conn->query($sql);
                if($res->num_rows>0){
                    while($row = $res->fetch_assoc()){
                        ?>
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="<?php echo $row['addr_id'] ?>">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <div class="d-flex">
                                        <div>
                                            <h6><?php echo $row['name'] ?></h6>
                                            <h6><?php echo $row['phone'] ?></h6>
                                            <p><?php echo $row['addrs'] ?></p>
                                        </div>
                                        <a href="#" class="btn btn-warning"></a>
                                    </div>
                                </label>
                            </div>
                        <?php
                    }
                    ?>
                        <a href="" class="btn btn-warning">Add New</a>
                    <?php
                }else{
                    ?>
                        <p class="fw-light">If you not set your address, then click <a href="#">Here</a>.<p>
                    <?php
                }
            ?>
            <div class="mb-4 form-group d-flex">
                <input type="text" name="start_otp" class="form-control me-1" placeholder="Enter The OTP">
                <button class="btn btn-warning" onclick=generation()>OTP</button>
            </div>
            
            <div id="otp"></div>
            <div class="form-text"><p>Select Anyone Slot Please</p></div>
            <div class="d-flex justify-content-between mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        8AM - 10AM 
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        10AM - 12PM
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        2PM - 4PM
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="">
                    <label class="form-check-label" for="flexCheckDefault">
                        4PM - 6PM
                    </label>
                </div>
            </div>
            
            <div class="form-text mb-3"><p>Choose your <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">provider</a></p></div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Service Providers</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow bg-dark my-2 my-md-3">
                            <div class="card-body text-center text-white">
                                <img class="img-fluid rounded-circle p-1 w-50 mb-md-3" src="assets/image/image3.jpg" alt="">
                                <h3>Bikash Swain</h3>
                                <h6 class="text-info">Service: Electrician</h6>
                                <h6 class="mb-2 mb-md-4">Raiting: 4.1</h6>
                                <a href="#" class="btn btn-warning me-2 px-3">View</a>
                                <a href="#" class="btn btn-success">Select</a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            
            <input type="submit" name="sub" value="Click" class="from-control btn btn-warning">
        </form>

    </div>
    <script>
        function generation(){
            let otp = Math.floor(1000 + Math.random() * 9000);
            let otp_div = document.getElementById('otp');
            let p = `<p>Your four digit OTP: ${otp}, Do not share with anyone.</p>`;
            otp_div.append(p);
        }
    </script>
    <!-- Bootstrap JS -->
    
</body>
</html>