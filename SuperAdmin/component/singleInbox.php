<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include_once "../includes/header.php"; ?>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <style>
        a{
            text-decoration:none;
        }
    </style>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
    <div class="row">
    <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <?php 
            if(isset($_GET['id'])){
                require_once "../Database/db_connection.php";
                $id = $_GET['id'];
                $qry = "SELECT * FROM inbox WHERE inbox_id = $id ";
                $res = $conn->query($qry);
                if($res->num_rows > 0){
                    $row = $res->fetch_assoc();
        ?>
                    
                    <div class="container-fluid table-responsive overflow-auto" data-aos="fade-in" style="height:650px">
                    <h4 class="fw-bold mt-4 mb-2 fs-3"><?php echo $row['subject']; ?></h4> 
                        <div class="d-flex">
                            <?php
                                if(strtoupper($row['name'][0])==='A' || strtoupper($row['name'][0])==='F' || strtoupper($row['name'][0])==='K' || strtoupper($row['name'][0])==='P' || strtoupper($row['name'][0])==='U') {
                                    $n = 'bg-danger';
                                }elseif(strtoupper($row['name'][0])==='B' || strtoupper($row['name'][0])==='G' || strtoupper($row['name'][0])==='L' || strtoupper($row['name'][0])==='R' || strtoupper($row['name'][0])==='V'){
                                    $n = 'bg-primary';
                                }elseif (strtoupper($row['name'][0])==='C' || strtoupper($row['name'][0])==='H' || strtoupper($row['name'][0])==='M' || strtoupper($row['name'][0])==='S' || strtoupper($row['name'][0])==='W') {
                                    $n = 'bg-warning';
                                }elseif (strtoupper($row['name'][0])==='D' || strtoupper($row['name'][0])==='I' || strtoupper($row['name'][0])==='N' || strtoupper($row['name'][0])==='T' || strtoupper($row['name'][0])==='Y') {
                                    $n = 'bg-success';
                                }elseif(strtoupper($row['name'][0])==='E' || strtoupper($row['name'][0])==='J' || strtoupper($row['name'][0])==='O' || strtoupper($row['name'][0])==='X' || strtoupper($row['name'][0])==='Z'){
                                    $n = 'bg-secondary';
                                }
                            ?>
                            <div class="rounded-circle mt-3 <?php echo $n; ?>" style="width:60px; height:60px;"><h2 class="text-center mt-2"><?php echo $row['name'][0]; ?></h2></div>
                            <h4 class="ms-3 my-auto"><?php echo $row['name']; ?></h4>
                        </div>
                        <div class="container-fluid mt-3 mx-5">
                            <p class="mt-3 text-justify">
                                <?php echo $row['message']; ?>
                            </p>
                            <h6><?php echo $row['email']; ?></h6>
                        </div>
                    </div>
        <?php
                }else{
                    echo "<h1 class='text-center mt-5'>No Result Found</h1>";
                }
            }else{
                echo "<h1 class='text-center mt-5'>No Result Found</h1>";
            } 

        ?>
        </div>
    </div>
    <script src="../assets/js/aos.js"></script>
    <script>
        AOS.init({
          offset: 200,
          duration: 1000,
        });
    </script>
</body>
</html>