<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Sphere</title>
    <link rel="stylesheet" href="..\assets\css\bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <style>
        body {
          width: 100vw;
        }
        nav {
            font-weight: 500;
            /* background: rgba(37, 37, 37, 0.521); */
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(120px);
        }
        .btn {
          font-weight: 500;
          border-color: rgb(255, 190, 0);
          background-color: transparent;
          color: rgb(255, 190, 0);
          border-radius: 4px;
        }
        .btn:hover {
          background-color: rgb(255, 190, 0);
          color: white;
          border-radius: 4px;
        }
        .appbtn {
            border: 2px solid rgb(255, 190, 0);
            padding: 5px;
            background-color: rgb(255, 190, 0);
            border-radius: 3px;
        }
        .appbtn:hover {
          color: white;
        }
        hr {
          border: 1px solid white;
        }
        #dropdownMenuButton {
          font-weight: 500;
          border-color: rgb(255, 190, 0);
          background-color: transparent;
          color: rgb(255, 190, 0);
          border-radius: 5px;
          padding: 5px;
        }
        #dropdownMenuButtonsm {
          font-weight: 500;
          border-color: rgb(255, 190, 0);
          background-color: transparent;
          color: rgb(255, 190, 0);
          border-radius: 5px;
          padding: 5px;
        }
        .num{
          height:23px;
          width:23px;
          background-color:black;
          color: white;
          border-radius:50%;
          display: inline-block;
        }
    </style>
</head>
<body>
<?php if(!isset($_SESSION['accesslevel'])) {
    header("location:../home.php");
}?>
<nav class="navbar navbar-expand-lg navbar-dark shadow p-2 sticky-top">
  <div class="container">
    <a class="navbar-brand" href="">Service Sphere</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">

      <?php if(isset($_SESSION['accesslevel'])) { ?>
        <div class="dropdown d-lg-none">
          <button class="mt-3 mb-2 mb-lg-0 mt-lg-0 mx-2 mx-lg-0 dropdown-toggle" type="button" id="dropdownMenuButtonsm" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome, <?php echo $_SESSION['name']; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-start bg-dark mx-2 shadow" aria-labelledby="dropdownMenuButtonsm">
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="sp_profile.php">Your Profile</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="sp_notification.php">Notifications</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="add_services.php">Add Service</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-white btn" href="sp_logout.php">LOG OUT</a></li>
          </ul>
        </div>
      <?php } ?>

      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning" aria-current="page" href="sp_home.php">HOME</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning" href="sp_about.php">ABOUT</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning" href="sp_services.php">YOUR SERVICES</a>
        </li>
        <li class="nav-item mx-2 mb-2 mb-lg-0">
          <a class="nav-link text-white link-warning" href="sp_contact.php">CONTACT</a>
        </li>
        <li class="nav-item mx-2 shadow-lg">
            <?php
              require_once "../db/dbconnect.php";
              $sp_id = $_SESSION['sp_id'];
              $qry = "SELECT count(book_id) as n FROM booking WHERE sp_id = $sp_id AND end_otp = 0";
              $res = $conn->query($qry);
              if($res->num_rows > 0){
                $row = $res->fetch_assoc();
                if($row['n']> 0 ){
                ?>
                  <a class="nav-link appbtn text-white" href="booked_customer.php">BOOKED CUSTOMER <b class="num px-auto ps-2 fw-medium"><?php echo $row['n']; ?></b></a>
                <?php
              }else{
                echo '<a class="nav-link appbtn text-white" href="booked_customer.php">BOOKED CUSTOMER</a>';
              }
            }else{
              echo '<a class="nav-link appbtn text-white" href="booked_customer.php">BOOKED CUSTOMER</a>';
            }
            ?>
        </li>
      </ul>
      <?php if(isset($_SESSION['accesslevel'])) { ?>
        <div class="dropdown d-none d-lg-block">
          <button class="mt-3 mb-2 mb-lg-0 mt-lg-0 mx-2 mx-lg-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome, <?php echo $_SESSION['name']; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end bg-dark shadow" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="sp_profile.php">Your Profile</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="sp_notification.php">Notifications</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="add_services.php">Add Service</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-white btn" href="sp_logout.php">LOG OUT</a></li>
          </ul>
        </div>
      <?php } ?>
    </div>
  </div>
</nav>

<script src="../assets/js/aos.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
