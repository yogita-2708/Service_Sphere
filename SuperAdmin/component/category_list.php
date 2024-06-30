<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>CustomerView</title>
      <?php include_once "../includes/header.php"; ?>
      <script src="..\assets\js\jquery-3.7.1.js"></script>
   </head>
   <body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">

   <div class="row">
        <?php include_once "../includes/sidenav.php"; ?>
        <div class="col-md-10">
        <div class="row">
            <div class="col-md-6">
                <h3 class="fw-bold mt-4 mb-2">Categories List</h3>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-success px-4 mt-4" id="catBtn">ADD</button>
            </div>
        </div>
        <div class="table-responsive overflow-auto" data-aos="fade-in" style="height:650px">

        <table class="table table-bordered my-3">
            <thead class="bg-dark">
                <tr class="text-white text-center">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    require_once "..\Database\db_connection.php";
                    $qry = "SELECT * FROM category";
                    $res = $conn->query($qry);
                    if($res->num_rows){
                        while($row = $res->fetch_assoc()){
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $row['cat_id']; ?></td>
                                    <td><?php echo $row['cat_name']; ?></td>
                                    <td>
                                        <a class="btn btn-outline-danger me-3" href="delete_cat.php?id=<?php echo $row['cat_id']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>

        <div class="row container-fluid" id="catForm">
            <div class="col">
                <form class="d-flex" action="add_cat.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Enter the category name" aria-label="Search" name="name">
                    <button class="btn btn-outline-success" type="submit" name="sub" id="sub">ADD</button>
                </form>
            </div>
        </div>
        <!-- <button style="align-items:right;" class="btn btn-outline-success px-4" id="catBtn">Add</button> -->

        </div>
        </div>
    </div>
        
</body>
    <script>
        $("#catForm").hide();
        $("#catBtn").click(function(){
            $("#catForm").show();
            $("#catBtn").hide();
        });
        $("sub").click(function(){
            $("#catBtn").show();
        })
    </script>
    <script src="../assets/js/aos.js"></script>
    <script>
        AOS.init({
          offset: 200,
          duration: 1000,
        });
    </script>
</html>