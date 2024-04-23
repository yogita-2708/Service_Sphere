<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere Admin</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.5)" class="container-fluid">
    <div class="row">
        <!-- Side Navbar -->
        <?php include_once "../includes/sidenav.php"; ?>
        <?php require_once "..\Database\db_connection.php"; ?>
        <!-- second -->
        <div class="col-md-10 mt-2 mt-md-3">
        <?php include_once "../includes/top.php"; ?>
            <div class="row mt-md-4 mb-5 mx-auto">
                <div class="col-md-3 col-sm-6" data-aos="zoom-in">
                    <div class="card border border-0 bg-light shadow text-dark">
                        <div class="card-body">
                            <h5 class="fw-bold">Total Customers</h5>
                            <div>
                                <?php
                                    $sql = "SELECT count(*) as total_user FROM customer";
                                    $res = $conn->query($sql);
                                    $row = $res->fetch_assoc();
                                ?>
                                <div class="d-flex justify-content-between py-3">
                                    <h1 class="display-6 text-start"><i class="bi bi-person text-primary"></i></h1>
                                    <h1 class="fs-2 mt-1 text-end"><?php echo $row['total_user']; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in">
                    <div class="card border border-0 bg-light shadow text-dark">
                        <div class="card-body">
                            <h5 class="fw-bold">Total Service Providers</h5>
                            <div>
                                <?php
                                    $sql = "SELECT count(*) as total_provider FROM service_provider";
                                    $res = $conn->query($sql);
                                    $row = $res->fetch_assoc();
                                ?>
                                <div class="d-flex justify-content-between py-3">
                                    <h1 class="display-6 text-start"><i class="bi bi-people text-warning"></i></h1>
                                    <h1 class="fs-2 mt-1 text-end"><?php echo $row['total_provider']; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in">
                    <div class="card border border-0 bg-light shadow text-dark">
                        <div class="card-body">
                            <h5 class="fw-bold">Customer Satisfication</h5>
                            <div>
                                <div class="d-flex justify-content-between py-3">
                                        <h1 class="display-6 text-start"><i class="bi bi-hand-thumbs-up text-danger"></i></h1>
                                        <h1 class="fs-2 mt-1 text-end">90%</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6" data-aos="zoom-in">
                    <div class="card border border-0 bg-light shadow text-dark">
                        <div class="card-body">
                            <h5 class="fw-bold">Growth Rate</h5>
                            <div>
                                <div class="d-flex justify-content-between py-3">
                                    <h1 class="display-6 text-start"><i class="bi bi-graph-up-arrow" style="color: #00c04b"></i></h1>
                                    <h1 class="fs-2 mt-1 text-end">4.4%</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- third section -->
            <div class="row mx-auto mt-md-4 mb-5">
                <div class="col-md-4">
                    <div class="card nav-bar-2">
                    <h5 class="px-3 mt-3 fw-bold">Top Service Provider</h5>
                        <div class="overflow-auto" style="height:20vh;">
                            <div class="card-body border-0" id="top-sp">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card nav-bar-2">
                    <h5 class="px-3 mt-3 fw-bold">Top Services</h5>
                        <div class="card-body overflow-auto" id="top-service" style="height:20vh;">
                            
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card nav-bar-2">
                    <h5 class="px-3 mt-3 fw-bold">Payment History</h5>
                        <div class="card-body overflow-auto" style="height:20vh;">
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row mx-auto">
                <div class="col-md-6">
                    <h3>Get Details</h3>
                    <form class="d-flex" action="view_customer.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Details of Customer by their ID" name="id" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                <div class="col-md-6">
                    <h3>Get Details</h3>
                    <form class="d-flex" action="view_service_provider.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Details of Service Provider by their ID" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div> -->

            <div class="row mt-4 mx-auto">
                <div class="col-md-6">
                    <div class="card nav-bar-2">
                        <div class="card-body" id="total-sale">
                            <h5 class="fw-bold">Total Sales</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card nav-bar-2">
                        <div class="card-body" id="total-book">
                            <h5 class="fw-bold">Total Booking<h5>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
        
    </div>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/aos.js"></script>
    <script src="../assets/js/jquery-3.7.1.js"></script>
    <script>
        AOS.init({
          offset: 200,
          duration: 1000,
        });
    </script>
    <script>
            // $("#Nd-3 ul").show();
            $.get("../assets/ajax/total_price.php",function(data){
                data = JSON.parse(data);
                if(data[0].price !== 'ZERO'){
                    para = `<p>Total Sale in last month is <b> ${data[0].price}</b></p>`;
                    $('#total-sale').append(para);
                }else{
                    para = `<p>Total Sale in last month is <b> ${data[0].price} </b></p>`;
                    $('#total-sale').append(para);
                }
            }).fail(function(){
                alert('Error');
            })

            $.get("../assets/ajax/total_book.php",function(data){
                data = JSON.parse(data);
                if(data[0].total !== 'ZERO'){
                    para = `<p>Total booking in last month is <b> ${data[0].total}</b></p>`;
                    $('#total-book').append(para);
                }else{
                    para = `<p>Total booking in last month is <b> ${data[0].total} </b></p>`;
                    $('#total-book').append(para);
                }
            }).fail(function(){
                alert('Error');
            })

            $.get("../assets/ajax/top_sp.php", function(data){
                data = JSON.parse(data)
                if(data[0].sp_id !== 'NO'){
                    let ul = `<p>`;
                    for(let i=0; i<data.length; i++){
                        ul += `<a class='text-dark ms-2 d-block' style='text-decoration:none;' href="view_service_provider.php?id=${data[i].sp_id}">ID: ${data[i].sp_id} &nbsp &nbsp Name: ${data[i].sp_name}</a>`;
                    }
                    ul += `</p>`;
                    $("#top-sp").append(ul);
                }else{
                    para = `<p class="fw-bold px-2">No record found.</p>`;
                    $('#top-sp').append(para);
                }

            }).fail(function(){
                alert('Error');
            })

            $.get("../assets/ajax/top_service.php", function(data){
                console.log("Service:",data);
                data = JSON.parse(data)
                console.log(data[0].service_name);
                if(data[0].service_name !== 'NO'){
                    let ul = `<p>`;
                    for(let i=0; i<data.length; i++){
                        ul += `<a class='text-dark ms-2 d-block' style='text-decoration:none;' href="../component/view_service.php?id=${data[i].service_id}">ID: ${data[i].service_id} &nbsp &nbsp Name: ${data[i].service_name}</a>`;
                    }
                    ul += `</p>`;
                    $("#top-service").append(ul);
                }else{
                    para = `<p class="fw-bold px-2">No record found.</p>`;
                    $('#top-service').append(para);
                }

            }).fail(function(){
                alert('Error');
            })
    </script>
</body>
</html>