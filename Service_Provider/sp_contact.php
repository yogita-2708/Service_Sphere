<?php include_once "sp_navbar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SP Contact</title>
    <style>
        .contactcontainer{
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            position: relative;
            margin-top: 100vh;
        }
        .wholecontactcontainer {
            background-color: rgba(128, 128, 128, 0.4);
            overflow-x: hidden;
        }
        .contactcontainer a{
            text-decoration:none;
        }
        .bg-img {
            height: 100vh;
            width: 100vw;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('../images/contact.jpg');
            background-size: cover;
            background-position: center;
        }
        .sec-one {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .w{
            width: 50%;
        }
        .error {
            color: red;
        }

        @media (max-width: 571px){
            .w{
                width: 90%;
            }
            .bg-img {
                height: 50vh;
            }
            .contactcontainer {
                margin-top: 50vh;
                width: 80%;
            }
        }
        .form-control{
            background:rgba(128, 128, 128, 0.1)
        }
    </style>
</head>
<body class="wholecontactcontainer">

<div class="bg-img"><div class="sec-one"></div></div>
    <div class="container contactcontainer">
        <h2 class="text-center fw-bold my-4">CONTACT INFO</h2>
        <div class="row my-3">
            <div class="col-md-4 mb-3">
                <div class="container text-center">
                    <a class="link text-warning fs-5" href=""><i class="bi bi-envelope-fill"></i></a>
                    <h4 class="fw-bold">EMAIL</h4>
                    <p><a class="link text-dark" href="#">bikash@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="container text-center">
                    <a class="link text-warning fs-5" href=""><i class="bi bi-geo-alt-fill"></i></a>
                    <h4 class="fw-bold">ADDRESS</h4>
                    <p><a class="link text-dark" href="#">Patia, Bhubaneswar, 751024</a></p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="container text-center">
                    <a class="link text-warning fs-5" href=""><i class="bi bi-telephone-fill"></i></a>
                    <h4 class="fw-bold">PHONE</h4>
                    <p><a class="link text-dark" href="#">+917326907009</a></p>
                </div>
            </div>
        </div>

        <div class="container mt-2 mt-md-5 mb-3">
            <form class="bg-white p-2 p-md-5 w mx-auto rounded shadow" action="" method="post" name="contactForm" onsubmit="validate(event)">
                <h1 class="text-center fw-bold text-warning mb-4">Message Us</h1>
                <div class="mb-3 form-group">
                    <input type="text" class="form-control" placeholder="Your Name" name="name" id="name" aria-describedby="emailHelp" required>
                    <span for="" id="nameError" class="error"></span>
                </div>
                <div class="mb-3 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" aria-describedby="emailHelp" required>
                    <span for="" id="emailError" class="error"></span>
                    <div class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3 form-group">
                    <input type="text" name="subject" placeholder="Subject" id="subject" class="form-control" required>
                    <span for="" id="subjectError" class="error"></span>
                </div>
                <div class="mb-3 form-group">
                    <textarea class="form-control" name="message" placeholder="Message" id="message" style="height: 100px" required></textarea>
                    <span for="" id="messageError" class="error"></span>
                </div>
                    <button type="submit" class="btn btn-warning bg-warning text-white shadow mb-3 mt-2" name="sub">SEND MESSAGE</button>
            </form>
        </div>


        <div class="ratio ratio-16x9 my-5 rounded">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96714.68291250926!2d-74.05953969406828!3d40.75468158321536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2588f046ee661%3A0xa0b3281fcecc08c!2sManhattan%2C%20Nowy%20Jork%2C%20Stany%20Zjednoczone!5e0!3m2!1spl!2spl!4v1672242259543!5m2!1spl!2spl"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <script>
        function validate(e) {
            try {
                    let name = document.getElementById("name").value
                    let email = document.getElementById("email").value
                    let subject = document.getElementById("subject").value
                    let message = document.getElementById("message").value
                    let error = false;
                    let nameError = document.getElementById("nameError")
                    let emailError = document.getElementById("emailError")
                    let subjectError = document.getElementById("subjectError")
                    let messageError = document.getElementById("messageError")
                    
                    let namePat = /^[A-Za-z\s]+$/;

                    if (!name.match(namePat)) {
                        nameError.innerHTML = "Invalid name. Only alphabets are allowed"
                        error = true;
                    } else {
                        nameError.innerHTML = "";
                    }
                    

                    let emailPat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z\.]+\.[a-zA-Z]{2,}$/;
                    if (!email.match(emailPat)) {
                        emailError.innerHTML = "Please enter a valid email"
                        error = true;
                    } else {
                        emailError.innerHTML = "";
                    }

                    let subjectPat = /^[\w\s\d\-.,!?()'"&@%$#*+=<>:;[\]/{}|~]+$/;
                    if (!subject.match(subjectPat)) {
                        subjectError.innerHTML = "Please use valid characters.";
                        error = true;
                    } else {
                        subjectError.innerHTML = "";
                    }

                    let messagePat = /^[\w\s\d\-.,!?()'"&@%$#*+=<>:;[\]/{}|~]+$/;
                    if (!message.match(messagePat)) {
                        messageError.innerHTML = "Invalid message. Please use valid characters.";
                        error = true;
                    } else {
                        messageError.innerHTML = "";
                    }

                    if (error) {
                        e.preventDefault();
                    }
                } catch (error) {
                    e.preventDefault();
                }
            }

            document.getElementById("name").addEventListener("input", function () {
                document.getElementById("nameError").innerHTML = "";
            });
            document.getElementById("email").addEventListener("input", function () {
                document.getElementById("emailError").innerHTML = "";
            });
            document.getElementById("message").addEventListener("input", function () {
                document.getElementById("messageError").innerHTML = "";
            });

            function showMessage() {
                alert("Message sent successfully !!\nThank you for your interest.");
            }
    </script>

</body>
</html>
<?php include_once "sp_footer.php"; ?>

        <?php
            require_once "../db/dbconnect.php";

            if(isset($_POST['sub'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $sub = $_POST['subject'];
                $message = $_POST['message'];

                // Using prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO inbox (name, email, subject, message) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $sub, $message);

                if($stmt->execute()){
                    echo "<script>showMessage();</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }

                $stmt->close();
            }
        ?>