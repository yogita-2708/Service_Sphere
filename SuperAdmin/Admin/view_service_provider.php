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
      <h3 class="fw-bold mt-4 mb-3">Service Provider Profile</h3>
      <div>
         
         <?php
            if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Fetching Data From Service Provider Table.
            require_once "..\Database\db_connection.php";
            $qry = "SELECT * FROM service_provider WHERE sp_id = $id ";
            $res = $conn->query($qry);
            if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                ?>
         <div class="container-fluid mt-2 mt-md-4">
               
               <div class="mb-2 mb-md-5">
                  <h4>User ID: <b><?php echo $row['sp_id'];  ?></b></h4>
                  <h4>Name: <b><?php echo $row['sp_name'];  ?></b></h4>
                  <h4>Email: <b><?php echo $row['sp_email'];  ?></b></h4>
                  <h4>Mobile: <b>+91<?php echo $row['sp_phone'];  ?></b></h4>
               </div>
            
         </div>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-6">
               <div class="card nav-bar-2 dash">
                  <div class="card-body">
                     <h5 class="fw-bold">Currently Booked</h5>
                     <div class="overflow-auto" style="max-height:100px">
                  <!-- PHP Code -->
                     <?php
                     $sql = "SELECT * FROM booking where end_otp = 0 AND sp_id = $id";
                     $res = $conn->query($sql);
                     if($res->num_rows>0){
                        while($row=$res->fetch_assoc()){
                           ?>
                              <ul class="list-group mb-2">
                                 <li class="list-group-item">
                                    <h6>Booking ID: <?php echo $row['book_id']; ?></h6>
                                    <h6>Booking Date: <?php echo $row['book_date']; ?></h6>
                                    <h6>Booking Date: <?php echo $row['total_price']; ?></h6>
                                 </li>
                              </ul>
                           <?php
                        }
                     }else{
                        echo "<h6>No History</h6>";
                     }

                     ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card nav-bar-2 dash">
                  <div class="card-body">
                     <h5 class="fw-bold">Service History</h5>
                     <div class="overflow-auto" style="height:100px">
                  <!-- PHP Code -->
                  <?php
                  $sql = "SELECT * FROM booking WHERE end_otp != 0";
                  $res = $conn->query($sql);
                  if($res!==false && $res->num_rows>0){
                     while($row=$res->fetch_assoc()){
                        ?>
                           <ul class="list-group">
                              <li class="list-group-item">
                                 <h6>Booking ID<?php echo $row['book_id']; ?></h6>
                              </li>
                           </ul>
                        <?php
                     }
                  }else{
                     echo "<h6>No History</h6>";
                  }

                  ?>
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
</html>