<?php session_start(); ?>
<?php if(!isset($_SESSION['accesslevel'])){
    header("location:../../home.php");
    exit();
}
?>
<nav class="col-md-2 nav-bar py-1" style="background-color:rgba(0, 0, 0, 0.7);">
    <div class="container" style="height:100vh">
        <h4 class="text-start pt-4 mb-4 text-light fw-bold">Admin Panel</h4>
        <ul class="navbar-nav">
            <li class="nav-item mb-2"><a class="nav-link" href="../Admin/admin.php"><i class="bi bi-microsoft mx-2"></i> Dashboard</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="../Admin/customer.php"><i class="bi bi-person-fill mx-2"></i> Customer</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="../Admin/service_provider.php"><i class="bi bi-people-fill mx-2"></i> Service Provider</a></li>
            <li class="nav-item mb-2" id="Nd-3"><a class="nav-link text-white dropdown-toggle" href="#"><i class="bi bi-suitcase-lg-fill mx-2"></i> Services</a>
                <ul class="drop"> 
                    <li><a class="nav-link" href="../component/category_list.php"><i class="bi bi-list-check mx-2"></i> Category</a></li>
                    <li><a class="nav-link" href="../component/service_list.php"><i class="bi bi-list-task mx-2"></i> List of services</a></li>
                </ul>
            </li>
            <li class="nav-item mb-2"><a class="nav-link text-white" href=""><i class="bi bi-currency-rupee mx-2"></i> Tranasaction History</a></li>
            <li class="nav-item mb-2" id="Nd-3"><a class="nav-link text-white dropdown-toggle" href=""><i class="bi bi-check-circle-fill mx-2"></i> Confirmation</a>
                <ul class="drop"> 
                    <li><a class="nav-link" href="../component/service_confirm.php"><i class="bi bi-check-lg mx-2"></i> Confirm Service</a></li>
                </ul>
            </li>
            <li class="nav-item mb-2"><a class="nav-link" href="../component/service_package.php"><i class="bi bi-wallet-fill mx-2"></i> Sevice Packages</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="../component/display_block.php"><i class="bi bi-ban mx-2"></i> Blocked User</a></li>
            <li class="nav-item mb-2"><a class="nav-link" href="../component/inbox.php"><i class="bi bi-envelope-arrow-down-fill mx-2"></i> Inbox</a></li>
            <hr style="margin:0;" class="text-white">
            <li class="nav-item mt-2"><a class="nav-link" href="../operation/logout.php"><i class="bi bi-box-arrow-left mx-2"></i> Log Out</a></li>
        </ul>
    </div>
</nav>
