<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add']))
    {
        $service_id = $_POST['service_id'];
        $name = $_POST["comment"];
        $rating = $_POST["rating"];
        $user_id = $_POST["user_id"];
        $book_id = $_POST["book_id"];
        $sp_id = $_POST["sp_id"];
        require_once "../db/dbconnect.php";
        $sql = "INSERT INTO sp_cus_review VALUES ('','$book_id', '$user_id', '$sp_id', '$rating', '$name', TIMESTAMP(NOW()) )";
        if (mysqli_query($conn, $sql))
        {
            header("location:../booked_customer_single.php?id=$service_id");
        }
        else
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>