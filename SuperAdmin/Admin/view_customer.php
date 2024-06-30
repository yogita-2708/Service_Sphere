<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CustomerView</title>
      <?php include_once "../includes/header.php"; ?>
   </head>
   <body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
   <div class="row">
      <?php include_once "../includes/sidenav.php"; ?>
      <div class="col-md-10">
         <h3 class="fw-bold mt-4 mb-3">Customer Profile</h3>
         <div>
            <?php
               if(isset($_GET['id'])){
               $id = $_GET['id'];
               //Fetching Data From Customer Table.
               require_once "..\Database\db_connection.php";
               $qry1 = "SELECT * FROM customer WHERE user_id = $id ";
               $res1 = $conn->query($qry1);
               if($res1!==false && $res1->num_rows > 0){
                  $row = $res1->fetch_assoc();
                  ?>
            <div class="container-fluid mt-4">
               
                  <div class="mb-2 mb-md-5">
                     <h4>User ID: <b><?php echo $row['user_id'];  ?></b></h4>
                     <h4>Name: <b><?php echo $row['user_name'];  ?></b></h4>
                     <h4>Email: <b><?php echo $row['user_email'];  ?></b></h4>
                     <h4>Mobile: <b>+91<?php echo $row['user_mob'];  ?></b></h4>
                  </div>
      
            </div>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-md-4">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Booking History</h5>
                           <div class="overflow-auto" style="max-height:80px; height:80px;">
                              <?php
                                 $qry2 = "SELECT * FROM booking WHERE user_id = $id AND end_otp IS NOT NULL";
                                 $res2 = $conn->query($qry2);
                                 if($res2->num_rows > 0){
                                    while($row = $res2->fetch_assoc()){
                                    ?>
                                       <ul class="list-group">
                                          <li class="list-group-item">
                                             <h6>Booking ID: <?php echo $row['book_id']; ?></h6>
                                             <h6>Total Price: <?php echo $row['total_price']; ?></h6>
                                             <h6>Booking Date: <?php echo $row['book_date']; ?></h6>
                                             <h6>Booking SP ID: <?php echo $row['sp_id']; ?></h6>
                                          </li>
                                       </ul>
                              <?php
                                    }
                                 }else{
                                 ?>
                                 <h6>No Booking Records</h6>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Addresses</h5>
                           <div class="overflow-auto" style="max-height:80px">
                              <?php
                                 $qry3 = "SELECT * FROM address WHERE user_id = $id ";
                                 $res3 = $conn->query($qry3);
                                 if($res3->num_rows > 0){
                                    while($row = $res3->fetch_assoc()){
                                    ?>
                              <ul class="list-group">
                                 <li class="list-group-item">
                                    <h6>Address: <?php echo $row['addrs']; ?></h6>
                                    <p>Location: <?php echo $row['geo_location']; ?></p>
                                 </li>
                              </ul>
                              <?php
                                 }
                                 }else{
                                 ?>
                                 <h6>No Address Records</h6>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Recent Payment Status</h5>
                           <div class="overflow-auto" style="height:80px">
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- ********* -->
               <div class="row mt-4">
                  <div class="col-md-6">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Current Booking Details</h5>
                           <div class="overflow-auto" style="max-height:65px; height:65px">
                              <?php
                                 $qry4 = "SELECT * FROM booking WHERE user_id = $id AND end_otp IS NULL";
                                 $res4 = $conn->query($qry4);
                                 if($res4->num_rows > 0){
                                    while($row = $res4->fetch_assoc()){
                                    ?>
                                       <ul class="list-group">
                                          <li class="list-group-item">
                                             <h6>Booking ID: <?php echo $row['book_id']; ?></h6>
                                             <h6>Total Price: <?php echo $row['total_price']; ?></h6>
                                             <h6>Booking Date: <?php echo $row['book_date']; ?></h6>
                                             <h6>Booking SP ID: <?php echo $row['sp_id']; ?></h6>
                                          </li>
                                       </ul>
                              <?php
                                    }
                                 }else{
                                 ?>
                                 <h6>No Current Booking Records</h6>
                              <?php
                                 }
                                 ?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Report Section</h5>
                           <h6>Have total 2 reports.</h6>
                           <a href="" class="btn btn-outline-danger">Report Status</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card nav-bar-2">
                        <div class="card-body">
                           <h5 class="fw-bold">Activity</h5>
                           <h6>No other illegal activity.</h6>
                           <a href="../component/user_sp_block.php?id=<?php echo $row['user_email'];?>" class="btn btn-outline-danger">Block</a>
                           <a href="#" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">Notify</a>
                           <!-- Modal -->

                           <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-dialog-scrollable">
                                 <div class="modal-content">
                                 <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Notify Customer</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <div>
                                    <form action="../component/notify.php" method="post">
                                       <input type="text" name="id" value="<?php echo $id;?>" hidden>
                                       <div class="mb-3 form-group">
                                          <input type="text" class="form-control" placeholder="Enter the subject" name="subject" aria-describedby="emailHelp">
                                       </div>
                                       <div class="form-group">
                                          <textarea class="form-control" name="message" id="" cols="30" rows="5" placeholder="Write something"></textarea>
                                       </div>
                                       <div class="form-group">
                                          <input type="submit" value="Notify" name="sub" class="btn btn-primary mt-1">
                                       </div>
                                    </form>
                                    </div>
                                 </div>
                                 </div>
                           </div>
                           </div>

                           <!-- **** -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
      </div>
   </div>
   
      <?php
         }else{
             echo "<h1 class='text-center my-5'>No Record Found</h1>";
         }
         }else{
            echo "<h1 class='text-center my-5'>No Record Found</h1>";
         }
         ?>
   </body>
   <script src="../assets/js/bootstrap.bundle.min.js"></script>
</html>