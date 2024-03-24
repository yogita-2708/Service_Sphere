<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow p-2 sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">Service Sphere</a>
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
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="#">Your Profile</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="#">Your Bookings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-white btn" href="logout.php">LOG OUT</a></li>
          </ul>
        </div>
      <?php } ?>

      <ul class="navbar-nav mx-auto">
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning <?php echo isset($_SESSION['accesslevel']) ? '' : 'disabled'; ?>" aria-current="page" href="home.php">HOME</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning <?php echo isset($_SESSION['accesslevel']) ? '' : 'disabled'; ?>" href="about.php">ABOUT</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning <?php echo isset($_SESSION['accesslevel']) ? '' : 'disabled'; ?>" href="services.php">SERVICES</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link text-white link-warning <?php echo isset($_SESSION['accesslevel']) ? '' : 'disabled'; ?>" href="crew.php">OUR CREW</a>
        </li>
        <li class="nav-item mx-2 mb-2 mb-lg-0">
          <a class="nav-link text-white link-warning <?php echo isset($_SESSION['accesslevel']) ? '' : 'disabled'; ?>" href="contact.php">CONTACT</a>
        </li>
        <li class="nav-item mx-2 shadow-lg">
          <a class="nav-link appbtn text-white" onclick="checkLogin()" href="#">BOOK APPOINTMENT</a>
        </li>
      </ul>
      <?php if(isset($_SESSION['accesslevel'])) { ?>
        <div class="dropdown d-none d-lg-block">
          <button class="mt-3 mb-2 mb-lg-0 mt-lg-0 mx-2 mx-lg-0 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Welcome, <?php echo $_SESSION['name']; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end bg-dark shadow" aria-labelledby="dropdownMenuButton">
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="#">Your Profile</a></li>
            <li><a class="dropdown-item text-white bg-transparent link-warning" href="#">Your Bookings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-white btn" href="logout.php">LOG OUT</a></li>
          </ul>
        </div>
      <?php } else { ?>
        <a href="signup.php" class="btn mt-3 mb-2 mb-lg-0 mt-lg-0 mx-1 mx-lg-0" type="submit">SIGN UP</a>
        <a href="login.php" class="btn ms-3 mt-3 mb-2 mb-lg-0 mt-lg-0 mx-2" type="submit">LOG IN</a>
      <?php } ?>
    </div>
  </div>
</nav>

<script>
  function checkLogin() {
    <?php if (!isset($_SESSION['accesslevel'])) { ?>
      alert("Please Sign Up or Login to Book Appointment");
      window.location.href = 'signup.php';
    <?php } else { ?>
      window.location.href = 'bookapp.php';
    <?php } ?>
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
