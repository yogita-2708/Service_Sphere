<!-- PHP CODE -->
<?php
        require_once "..\Database\db_connection.php";
        if(isset($_POST['sub'])){
        $name = $_POST['name'];
        $qry = "INSERT INTO category VALUES ('','$name')";
        if($conn->query($qry)){
            header("location:category_list.php");
        }
        }
    ?>