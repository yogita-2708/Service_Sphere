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
            $picture = $_FILES['s_picture'];
            $sdesc = $_POST['s_desc'];
            $path = '../images';
            $file = $picture['name'];
            $c_path = $path."/".$file;
            $sub_cat_id = $_POST['sub_cat_id'];

            if(move_uploaded_file($picture['tmp_name'],$c_path)){
                    $ssp_query = "INSERT INTO service_service_provider (service_id, sp_id, s_price, status,sdesc,spicture,sub_cat_id) VALUES ('$service_id', '$sp_id', '$s_price', 'NO', '$sdesc', '$file','$sub_cat_id')";
                    $ssp_res = $conn->query($ssp_query);

                    if($ssp_res){
                        echo "<script>window.location.href='add_services.php?status=ok'</script>";
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }else{
                    echo "Error ".$picture['error'];
                }
                $conn->close();
            
        }
    ?>
    <div class="container mt-4">
        <h2 class="text-center fw-bold">ADD SERVICES</h2>
        <form action="" enctype="multipart/form-data" method="post" name="categoryform" class="mt-4 mb-5 form-container border-1 rounded fw-medium border border-secondary p-4 shadow">
            <div class="mb-4">
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

            <div class="mb-4">
                <label for="s_name" class="form-label">Service Name:</label>
                <div id="service"></div>
                <!-- <input type="text" placeholder="Enter Service Name..." name="s_name" class="form-control" id="s_name" required> -->
                
            </div>

            <div class="mb-4">
                <label for="sub_cat_name" class="form-label">Sub-Category Name:</label>
                <div id="sub-cat"></div>
            </div>

            <div class="mb-4">
                <label for="s_price" class="form-label">Price:</label>
                <input type="text" placeholder="Enter Service Price..." name="s_price" class="form-control" id="s_price" required>
            </div>

            <div class="mb-4">
                <label for="s_desc" class="form-label">Description:</label>
                <textarea class="form-control" placeholder="Enter Service Description..." rows="5" name="s_desc" id="s_desc" required></textarea>
            </div>

            <div class="mb-4">
                <label for="s_image" class="form-label">Image:</label>
                <input type="file" name="s_picture" class="form-control" id="thumbnail" accept="image/*" required>
            </div>

            
            <div class="mb-1 mt-5 text-center">
                <input type="submit" name="submit" class="appbtn btn-lg btn text-white fw-bold px-4 shadow" value="ADD">
            </div>

        </form>
    </div>
    </div>


    <script>
        $(document).ready(function () {
            let  select = `<select class="form-select mb-1" id="userType" name="service_id">`;
            select+= `<option disabled selected hidden>Select Service</option>`;
            select+=`</select>`;
            $('#service').html(select);

            let  sel = `<select class="form-select mb-1" id="Sub-Cat" name="sub_cat_id">`;
            sel+= `<option disabled selected hidden>Select Sub-Category</option>`;
            sel+=`</select>`;
            $('#sub-cat').html(sel);


            $("#usertype").change(function () {
                let val = $("#usertype").val();
                console.log(val);
                $.post("../assets/ajax/cat.php", {
                        value: val,
                    },
                    function(data_cat) {
                        console.log(data_cat);
                        data_cat = JSON.parse(data_cat);
                        
                        console.log(data_cat);
                        if(data_cat){
                        if (data_cat.length != 0) {
                            let  select = `<select class="form-select mb-1" id="userType" name="service_id">`;
                            select+= `<option disabled selected hidden>Choose Service</option>`;
                            for(let i=0; i<data_cat.length; i++){
                                select+= `<option value='${data_cat[i]['service_id']}'>${data_cat[i]['s_name']}</option>`;
                            }
                            select+=`</select>`;
                            $("#service").html(select);
                        }else{
                            let  select = `<select class="form-select mb-1" id="userType" name="service_id">`;
                            select+= `<option disabled selected hidden>Select Service</option>`;
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

        $(document).on("change", "#userType", function () {
            let value = $(this).val();
            
            // AJAX call to retrieve sub-categories based on selected service
            $.post("../assets/ajax/sub-cat.php", {
                value: value
            }, function(data) {
                if (data) {
                    data = JSON.parse(data);
                    let select = $("<select>").addClass("form-select mb-1").attr("id", "Sub-Cat").attr("name", "sub_cat_id");
                    select.append($("<option>").prop("disabled", true).prop("selected", true).text("Choose Sub-Category"));
                    if (data.length > 0) {
                        $.each(data, function(index, subCat) {
                            select.append($("<option>").attr("value", subCat.sub_cat_id).text(subCat.sub_cat_name));
                        });
                    } else {
                        select.append($("<option>").prop("disabled", true).text("No Sub-Category Found"));
                    }
                    $('#sub-cat').html(select);
                } else {
                    $('#sub-cat').html("<select class='form-select mb-1' id='Sub-Cat' name='sub_cat_id'><option disabled selected hidden>No Sub-Category Found</option></select>");
                }
            });
        });
    </script>
</body>
</html>
<?php include_once "sp_footer.php"; ?>
