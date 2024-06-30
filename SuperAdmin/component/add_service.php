<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditServices</title>
    <?php include_once "../includes/header.php"; ?>
</head>
<body style="background-color:rgba(128, 128, 128, 0.4)" class="container-fluid">
<div class="row">
    <?php include_once "../includes/sidenav.php"; ?>
    <div class="col-md-10">
    <?php
    require_once "../Database/db_connection.php";
        if(isset($_POST['submit']))
        {  
            $s_name = $_POST['s_name'];
            $s_desc = $_POST['s_desc'];
            $cat_id = $_POST['cat_id'];
            // $s_price = $_POST['s_price'];
            
            $hours = $_POST['hours'];
            $minutes = $_POST['minutes'];
            $seconds = $_POST['seconds'];
            $s_duration = $hours . ':' . $minutes . ':' . $seconds;
            // $sp_id = $_POST['sp_id'];
            $s_status = $_POST['status'];
            $picture = $_FILES['picture'];
            $path = '../images';
            $file = $picture['name'];
            $c_path = $path."/".$file;
            if(move_uploaded_file($picture['tmp_name'],$c_path)){
                $qry = "INSERT INTO services (s_name, s_desc, cat_id, s_duration, picture, sp_id, s_status) 
                        VALUES ('$s_name', '$s_desc', '$cat_id', '$s_duration', '$file', 1, '$s_status')";
                $res = $conn->query($qry);
                if($res){
                    echo "<script>alert('Successfully Added');</script>";
                    header("location:add_service.php");
                }
                
                $conn->close();
            } else {
                echo "Error ".$picture['error'];
                header("location:add_service.php");
            }
        }
    ?>
    <div class="container mt-4">
        <h4 class="text-center fw-bold my-2">Add Service</h4>
        <form action="" method="post" enctype="multipart/form-data" name="categoryform" class="form-container fw-medium p-4">
            <div class="mb-3">
                <label for="s_name" class="form-label">Service Name:</label>
                <input type="text" placeholder="Enter Service Name..." name="s_name" class="form-control" id="s_name" required>
            </div>

            <div class="mb-3">
                <label for="s_desc" class="form-label">Description:</label>
                <textarea class="form-control" placeholder="Enter Service Description..." rows="5" name="s_desc" id="s_desc" required></textarea>
            </div>

            <div class="mb-3">
                <label for="cat_id" class="form-label">Category Name:</label>
                <select class="form-select mb-1" id="usertype" name="cat_id">
                <option disabled selected hidden>Choose User Type</option>
                <?php
                    require_once "../Database/db_connection.php";
                    $usertype_query = "SELECT * FROM category";
                    $usertype_result = $conn->query($usertype_query);
                    while ($row = $usertype_result->fetch_assoc()) {
                        echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                        
                    }
                    ?>
            </select>
            </div>

            <!-- <div class="mb-3">
                <label for="s_price" class="form-label">Price:</label>
                <input type="text" placeholder="Enter Service Price..." name="s_price" class="form-control" id="s_price" required>
            </div> -->

            <div class="mb-3">
                <label for="s_duration" class="form-label">Duration (H:M:S):</label>
                <div class="row">
                    <div class="col">
                        <select class="form-select" name="hours" required>
                            <?php
                            for ($i = 0; $i < 24; $i++) {
                                printf('<option value="%02d">%02d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="minutes" required>
                            <?php
                            for ($i = 0; $i < 60; $i++) {
                                printf('<option value="%02d">%02d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" name="seconds" required>
                            <?php
                            for ($i = 0; $i < 60; $i++) {
                                printf('<option value="%02d">%02d</option>', $i, $i);
                            }
                            ?>
                        </select>
                    </div>
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail:</label>
                <input type="file" name="picture" class="form-control" id="thumbnail" accept="image/*" required>
            </div>
            
            <div>
                <input type="text" name="status" class="d-none" value="<?php echo "NO"; ?>">
            </div>

            <div class="mb-1 mt-4 text-center">
                <input type="submit" name="submit" class="btn btn-warning mt-2 fw-bold px-5" value="ADD">
            </div>

        </form>
    </div>
    </div>
    </div>

    <script src="../assets/js/aos.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 1000,
        });
    </script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>