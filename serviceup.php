<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding Services</title>
</head>
<body class="wholecontainer">
    <?php
    // include_once "include/navbar.php";
    require_once "db/dbconnect.php";
    if(isset($_POST['submit']))
    {  
        $s_name = $_POST['s_name'];
        $s_desc = $_POST['s_desc'];
        $cat_id = $_POST['cat_id'];
        $s_price = $_POST['s_price'];
        $s_duration = $_POST['s_duration'];
        $sp_id = $_POST['sp_id'];
        $picture = $_FILES['picture'];
        $path = 'images';
        $file = $picture['name'];
        $c_path = $path."/".$file;
        if(move_uploaded_file($picture['tmp_name'],$c_path)){
            $qry = "INSERT INTO services (s_name, s_desc, cat_id, s_price, s_duration, sp_id, picture) 
                    VALUES ('$s_name', '$s_desc', '$cat_id', '$s_price', '$s_duration', '$sp_id', '$file')";
            $res = $conn->query($qry);

            if($res){
                echo "<div class='alert alert-success' role='alert'>One record inserted</div>";
                // header("location:dashboard.php");
            }
            else{
                echo "Error : ".$conn->error;
            }
            $conn->close();
        } else {
            echo "Error ".$picture['error'];
        }
    }
    ?>
    <div class="container mt-4">
        <h1 class="text-center">Add Services</h1>
        <form action="" method="post" enctype="multipart/form-data" name="categoryform" onsubmit="return validateform()" class="mt-4 form-container">
            <div class="mb-3">
                <label for="s_name" class="form-label">Service Name:</label>
                <input type="text" placeholder="Enter Service Name..." name="s_name" class="form-control" id="s_name" required>
            </div>

            <div class="mb-3">
                <label for="s_desc" class="form-label">Description:</label>
                <textarea class="form-control" placeholder="Enter Description..." rows="5" name="s_desc" id="s_desc" required></textarea>
            </div>

            <div class="mb-3">
                <label for="cat_id" class="form-label">Category ID:</label>
                <select class="form-select mb-1" id="usertype" name="cat_id">
                <option disabled selected hidden>Choose User Type</option>
                <?php
                    require_once "db/dbconnect.php";
                    $usertype_query = "SELECT * FROM category";
                    $usertype_result = $conn->query($usertype_query);
                    while ($row = $usertype_result->fetch_assoc()) {
                        echo "<option value='{$row['cat_id']}'>{$row['cat_id']}</option>";
                        
                    }
                    ?>
            </select>
            </div>

            <div class="mb-3">
                <label for="s_price" class="form-label">Price:</label>
                <input type="text" placeholder="Enter Price..." name="s_price" class="form-control" id="s_price" required>
            </div>

            <div class="mb-3">
                <label for="s_duration" class="form-label">Duration:</label>
                <input type="time" name="s_duration" class="form-control" id="s_duration" required>
            </div>

            <div class="mb-3">
                <label for="cat_id" class="form-label">Service Provider ID:</label>
                <select class="form-select mb-1" id="usertype" name="sp_id">
                <option disabled selected hidden>Choose User Type</option>
                <?php
                    require_once "db/dbconnect.php";
                    $usertype_query = "SELECT * FROM service_provider";
                    $usertype_result = $conn->query($usertype_query);
                    while ($row = $usertype_result->fetch_assoc()) {
                        echo "<option value='{$row['sp_id']}'>{$row['sp_id']}</option>";
                        
                    }
                    ?>
            </select>
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail:</label>
                <input type="file" name="picture" class="form-control" id="thumbnail" accept="image/*" required>
            </div>

            <div class="mb-1 mt-4 text-center">
                <input type="submit" name="submit" class="btn btn-outline-light fw-bold addnews px-4" value="ADD">
            </div>
        </form>

        <script>
            function validateform() {
                let s_name = document.forms['categoryform']['s_name'].value;
                let s_desc = document.forms['categoryform']['s_desc'].value;
                let cat_id = document.forms['categoryform']['cat_id'].value;
                let s_price = document.forms['categoryform']['s_price'].value;
                let s_duration = document.forms['categoryform']['s_duration'].value;

                if (s_name == "") {
                    alert('Service Name Must Be Filled Out !');
                    return false;
                }
                if (s_desc == "") {
                    alert('Description Must Be Filled Out !');
                    return false;
                }
                if (cat_id == "") {
                    alert('Category ID Must Be Filled Out !');
                    return false;
                }
                if (s_price == "") {
                    alert('Price Must Be Filled Out !');
                    return false;
                }
                if (s_duration == "") {
                    alert('Duration Must Be Filled Out !');
                    return false;
                }
            }
        </script>
    </div>
</body>
</html>
