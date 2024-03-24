<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            max-width: 550px; 
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

        .form-select {
            border: none;
            background: transparent;
            border-bottom: 1px solid white;
            color: rgb(136, 133, 133); 
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
            color: red;
        }
    </style>
</head>
<body>
<div class="bg-img"></div>
    <div class="container dfg">
        <ul class="nav nav-pills nav-justified mb-1" role="tablist">
            <li class="nav-item"><a href="signup.php" class="nav-link active rounded-1" style="background-color: rgb(255, 190, 0);" data-toggle="pill">SIGN UP</a></li><br>
            <li class ="nav-item"><a href="login.php" class="nav-link" style="color: rgb(255, 190, 0);">LOGIN</a></li>
        </ul><br>
    <form action="signup_check.php" method="post" onsubmit="validate(event)">
        <div class ="form-group ">
            <label for="username" class="mb-1">NAME</label>
            <input type="text" name ="username" id="name" class="form-control mb-1 text-white-50 bg-transparent" placeholder="Enter Name">
            <label for="" id="nameError" class="error"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">EMAIL</label>
            <input type="email" name="email" id="email" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter Email">
            <label for="" id="emailError" class="error"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">PASSWORD</label>
            <input type="password" name="pass" id="password" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter Password">
            <label for="" id="passwordError" class="error"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">CONFIRM PASSWORD</label>
            <input type="password" name="cpass" id="cpassword" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter same Password">
            <label for="" id="cpasswordError" class="error"></label>
        </div>
        <div class="form-group">
            <label for="usertype" class="mb-1">USER TYPE</label>
            <select class="form-select mb-1" id="usertype" name="usertype">
                <option disabled selected hidden>Choose User Type</option>
                <?php
                    require_once "db/dbconnect.php";
                    $usertype_query = "SELECT * FROM access_level";
                    $usertype_result = $conn->query($usertype_query);
                    while ($row = $usertype_result->fetch_assoc()) {
                        // echo "<option value='{$row['user_type']}'>{$row['user_type']}</option>";
                        if ($row['user_type'] === 'admin') {
                            echo "<option value='{$row['user_type']}' class='bg-dark' disabled>{$row['user_type']}</option>";
                        } else {
                            echo "<option value='{$row['user_type']}' class='text-white bg-dark'>{$row['user_type']}</option>";
                        }
                    }
                    ?>
            </select>
            <label for="" id="usertypeError" class="error"></label>
        </div>
        <div class ="form-group">
            <input type="submit" class="btn px-4 loginbtn mb-2 mt-2 shadow-lg" value="SIGN UP" name="submit">
        </div>
        <p>Already have an account? <a href="login.php" style="color: rgb(255, 180, 0);">Login here</a></p>
    </div>
    </form>
    <script>
        function validate(e) {
            try {
                let name = document.getElementById("name").value
                let email = document.getElementById("email").value
                let password = document.getElementById("password").value
                let cpassword = document.getElementById("cpassword").value
                let usertype = document.getElementById("usertype").value
                let error = false;
                let emailError = document.getElementById("emailError")
                let passwordError = document.getElementById("passwordError")
                let cpasswordError = document.getElementById("cpasswordError")
                let usertypeError = document.getElementById("usertypeError")
                
                if(name === "" || name === null) {
                    nameError.innerHTML = "Name is required"
                    error = true;
                } else {
                    nameError.innerHTML = "";
                }

                let emailPat = /^[\w\.]{5,}@[a-zA-Z\.]{5,}\.[a-zA-Z]{3,}/
                if (email === "" || email === null) {
                    emailError.innerHTML = "Email is required"
                    error = true;
                } else if (!email.match(emailPat)) {
                    emailError.innerHTML = "Please enter a valid email"
                    error = true;
                } else {
                    emailError.innerHTML = ""
                }

                let passPat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$*^%#!]).{8,16}$/;
                if (password === "" || password === null) {
                    passwordError.innerHTML = "Password is required";
                    error = true;
                } else if (!password.match(passPat)) {
                    passwordError.innerHTML = "Please enter a valid password";
                    error = true;
                } else {
                    passwordError.innerHTML = "";
                }

                if (cpassword === "" || cpassword === null) {
                    cpasswordError.innerHTML = "Confirm Password is required"
                    error = true;
                } else if (cpassword != password) {
                    cpasswordError.innerHTML = "Confirm password must be the same as password"
                    error = true
                } else {
                    cpasswordError.innerHTML = ""
                }

                if(usertype === "") {
                    usertypeError.innerHTML = "User type is required"
                    error = true;
                } else {
                    usertypeError.innerHTML = "";
                }

                if (error) {
                    e.preventDefault();
                }
                } catch (error) {
                    e.preventDefault();
                }
            }
    </script>   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>