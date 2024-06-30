<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <button type="button" class="btn bg-warning shadow-sm text-white" onclick="generateOTP()">OTP</button>
    <div id="otp" class="mb-4"></div> -->

    <script>
    function generateOTP(){
        let otp = Math.floor(1000 + Math.random() * 9000);
        let otp_div = document.getElementById('otp');
        let p = `<p>Do not share with anyone.</p>`;
        
        // Update the OTP display
        otp_div.innerHTML = p;

        // Send the OTP via AJAX to PHP script
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send("otp=" + otp);
    }
    </script>

<?php
// Check if OTP is sent via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['otp'])) {
    // Retrieve the OTP from the POST data
    $otp = $_POST['otp'];

    // Compose the email message with the OTP
    $to = "bikashswain754231@gmail.com";
    $subject = "Test Mail";
    $message = "Hello! This is a simple email message. Your OTP is $otp";
    $from = "bn965362@gmail.com";
    $headers = "From: $from";

    // Send the email
    $check = mail($to, $subject, $message, $headers);

    // Respond to the client-side JavaScript
    if($check){
        echo "<script>alert('Email sent successfully.');</script>";
    } else {
        echo "<script>alert('Email not sent.');</script>";
    }
}
?>
</body>
</html>
