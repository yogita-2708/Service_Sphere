<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adding Services</title>
    <script src="..\assets\js\jquery-3.7.1.js"></script>
    <style>
        .wholesericeupcontainer {
            background-color: rgba(128, 128, 128, 0.4);
            background: rgba(0, 0, 0, 0.3);
            overflow-x: hidden;
        }
        .form-control::placeholder {   
            color: black;
        }
        h2 {
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
    </style>
</head>
<body class="wholesericeupcontainer">
    <?php

        if (isset($_GET['status']) && $_GET['status']=='ok') {
            echo "<div class='alert alert-success' role='alert'>Service added successfully!</div>";
        }

        require_once "../db/dbconnect.php";
        if(isset($_POST['submit']))
        {  
            $service_id = $_POST['service_id'];
            $s_price = $_POST['s_price'];
            $sp_id = $_SESSION['sp_id'];


                    $ssp_query = "INSERT INTO service_service_provider (service_id, sp_id, s_price, status) VALUES ('$service_id', '$sp_id', $s_price, 'NO')";
                    $ssp_res = $conn->query($ssp_query);

                    if($ssp_res){
                        echo "<script>window.location.href='add_services.php?status=ok'</script>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                $conn->close();
            
        }
    ?>
    <div class="container mt-4">
        <h2 class="text-center fw-bold">ADD SERVICES</h2>
        <form action="" method="post" name="categoryform" class="mt-4 mb-5 form-container border-1 rounded fw-medium border border-secondary p-4 shadow">
            <div class="mb-3">
                <label for="cat_id" class="form-label">Category:</label>
                <select class="form-select mb-1" id="usertype" name="cat_id">
                <option disabled selected hidden>Choose Your Category</option>
                <?php
                    require_once "../db/dbconnect.php";
                    $usertype_query = "SELECT * FROM category";
                    $usertype_result = $conn->query($usertype_query);
                    while ($row = $usertype_result->fetch_assoc()) {
                        echo "<option value='{$row['cat_id']}'>{$row['cat_name']}</option>";
                        
                    }
                    ?>
            </select>
            </div>

            <div class="mb-3" id="service">
                <label for="s_name" class="form-label">Service Name:</label>
                <!-- <input type="text" placeholder="Enter Service Name..." name="s_name" class="form-control" id="s_name" required> -->
                
            </div>

            <div class="mb-3">
                <label for="s_price" class="form-label">Price:</label>
                <input type="text" placeholder="Enter Service Price..." name="s_price" class="form-control" id="s_price" required>
            </div>
            
            <div class="mb-1 mt-5 text-center">
                <input type="submit" name="submit" class="appbtn btn-lg btn text-white fw-bold px-4 shadow" value="ADD">
            </div>

        </form>
    </div>
    </div>


    <script>
        $(document).ready(function () {
            let  select = `<select select class="form-select mb-1" id="userType" name="service_id">`;
            select+= `<option disabled selected hidden>First Select Category</option>`;
            select+=`</select>`;
            $('#service').html(select);


            $("#usertype").change(function () {
                let val = $("#usertype").val();
                console.log(val);
                $.post("../assets/ajax/cat.php", {
                        value: val,
                    },
                    function(data) {
                        console.log(data);
                        data = JSON.parse(data);
                        
                        console.log(data);
                        if(data){
                        if (data.length != 0) {
                            let  select = `<select select class="form-select mb-1" id="userType" name="service_id">`;
                            select+= `<option disabled selected hidden>Choose Service</option>`;
                            for(let i=0; i<data.length; i++){
                                select+= `<option value='${data[i]['service_id']}'>${data[i]['s_name']}</option>`;
                            }
                            select+=`</select>`;
                            $("#service").html(select);
                        }else{
                            let  select = `<select select class="form-select mb-1" id="userType" name="service_id">`;
                            select+= `<option disabled selected hidden>First Select Category</option>`;
                            select+=`</select>`;
                            $('#service').html(select);
                        }
                    }else{
                        let  select = `<select select class="form-select mb-1" id="userType" name="service_id">`;
                        select+= `<option disabled selected hidden>No Service Found</option>`;
                        select+=`</select>`;
                        $('#service').html(select);
                    }
                    }
                )
            })
        })
    </script>
</body>
</html>
<?php include_once "sp_footer.php"; ?>
