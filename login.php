<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <style>
         body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
        }

        .bg-img {
            height: 100%;
            width: 100%;
            filter: brightness(0.8);
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            background: url('images/service2.jpeg');
            background-size: cover;
            background-position: right;
        }

        .dfg {
            /* background: rgba(255, 255, 255, 0.04); */
            background: rgba(37, 37, 37, 0.521);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            backdrop-filter: blur(100px);
            color: white;
            padding: 1rem;
            max-width: 600px; 
            width: 90%; 
        }

        ul {
            font-weight: 500;
        }

        .form-control {   
            border: none;
            background: transparent;
            border-bottom: 1px solid white;
        }

        .form-control::placeholder {   
            color: rgb(136, 133, 133);
        }

        .btn.loginbtn {
            border: 2px solid rgb(255, 160, 0);
            padding: 4px;
            background-color: rgb(255, 160, 0);
            border-radius: 3px;
            color: white;
            font-weight: 600;
        }

        .btn.loginbtn:hover {
            background-color: transparent;
            border-color: rgb(255, 170, 0);
            color: rgb(255, 170, 0);
            font-weight: 600;
        }
        .error {
            color: rgb(255, 170, 0);
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION['accesslevel']) && $_SESSION['accesslevel']==3) {
    if(print "<script>confirm('You already loged-in, Click ok for log-out.')</script>;"){
        session_destroy();
        header("location:home.php");
    }
    
}  
?>

<div class="bg-img"></div>
    <div class="container dfg">
        <ul class="nav nav-pills nav-justified mb-1" role="tablist">
            <li class="nav-item"><a href="signup.php" class="nav-link" style="color: rgb(255, 190, 0);" data-toggle="pill">SIGN UP</a></li><br>
            <li class ="nav-item"><a href="login.php" class="nav-link active rounded-1" style="background-color: rgb(255, 190, 0);">LOGIN</a></li>
        </ul><br>
        <form action="login_check.php" method="post" onsubmit="validate(event)" id="loginForm">
            <div class="form-group">
                <label for="email" class="mb-1">EMAIL</label>
                <input type="email" name="email" id="email" class="form-control mb-1 text-white-50 bg-transparent" placeholder="Enter Email">
                <label for="" id="emailError" class="error mb-2"></label>
            </div>
            <div class="form-group">
                <label for="password" class="mb-1">PASSWORD</label>
                <input type="password" name="pass" id="password" class="form-control mb-1 text-white-50 bg-transparent" placeholder="Enter Password">
                <label for="" id="passwordError" class="error mb-2"></label>
            </div>
            <?php if(isset($_SESSION['login_error']) && $_SESSION['login_error']){?>
            <div id="invalid-credentials" style="color: rgb(255, 180, 0);" class="mb-3 fw-medium">Invalid Credentials !!!</div>
            <?php unset($_SESSION['login_error']); ?>
            <?php } ?>
            <div class="form-group">
                <input type="submit" class="btn px-4 loginbtn mb-2 mt-2 shadow-lg" value="LOGIN" name="submit">
            </div>
        </form>
        <p>Don't have an account? <a href="signup.php" style="color: rgb(255, 180, 0);">Create account</a></p>
    </div>

    <script>
        function validate(e) {
            try {
                let email = document.getElementById("email").value;
                let password = document.getElementById("password").value;
                let error = false;
                let emailError = document.getElementById("emailError");
                let passwordError = document.getElementById("passwordError");

                if (email === "" || email === null) {
                    emailError.innerHTML = "Email is required";
                    error = true;
                } else {
                    emailError.innerHTML = "";
                }

                if (password === "" || password === null) {
                    passwordError.innerHTML = "Password is required";
                    error = true;
                } else {
                    passwordError.innerHTML = "";
                }

                if (error) {
                    e.preventDefault();
                }
            } catch (error) {
                e.preventDefault();
            }
        }

        document.getElementById("email").addEventListener("input", function () {
            document.getElementById("emailError").innerHTML = "";
        });
        document.getElementById("password").addEventListener("input", function () {
            document.getElementById("passwordError").innerHTML = "";
        });

        document.getElementById("loginForm").addEventListener("submit", function(event) {
            let email = document.getElementById("email").value;
            let pass = document.getElementById("password").value;
            if (email.trim() === "" || pass.trim() === "") {
                event.preventDefault();
                document.getElementById("invalid-credentials").style.display = "none"; 
            }
        });
    </script>   
    <script src="assets\js\bootstrap.bundle.min.js"></script>
</body>
</html>
