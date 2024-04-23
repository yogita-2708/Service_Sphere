<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <style>
        .wholesignupcontainer {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
        }

        .bg-img {
            height: 120vh;
            width: 100%;
            filter: brightness(0.8);
            position: fixed;
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
            color: rgb(255, 170, 0);
        }

        @media (max-width: 571px) {
            .bg-img {
                height: 100vh;
            }
        }
    </style>
</head>
<body class="wholesignupcontainer">
<div class="bg-img"></div>
    <div class="container dfg mt-5 mb-5">
        <ul class="nav nav-pills nav-justified mb-1" role="tablist">
            <li class="nav-item"><a href="signup.php" class="nav-link active rounded-1" style="background-color: rgb(255, 190, 0);" data-toggle="pill">SIGN UP</a></li><br>
            <li class ="nav-item"><a href="login.php" class="nav-link" style="color: rgb(255, 190, 0);">LOGIN</a></li>
        </ul><br>
    <form action="signup_check.php" method="post" onsubmit="validate(event)">
        <div class ="form-group ">
            <label for="username" class="mb-1">NAME</label>
            <input type="text" name ="username" id="name" class="form-control mb-1 text-white-50 bg-transparent" placeholder="Enter Name">
            <label for="" id="nameError" class="error mb-2"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">EMAIL</label>
            <input type="email" name="email" id="email" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter Email">
            <label for="" id="emailError" class="error mb-2"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">PASSWORD</label>
            <input type="password" name="pass" id="password" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter Password">
            <label for="" id="passwordError" class="error mb-2"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">CONFIRM PASSWORD</label>
            <input type="password" name="cpass" id="cpassword" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter same Password">
            <label for="" id="cpasswordError" class="error mb-2"></label>
        </div>
        <div class ="form-group ">
            <label class="mb-1">MOBILE NUMBER</label>
            <input type="text" name="mobile" id="mobile" class="form-control mb-1 text-white-50 bg-transparent" placeholder= "Enter your mobile number">
            <label for="" id="mobileError" class="error mb-2"></label>
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
            <label for="" id="usertypeError" class="error mb-3"></label>
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
                    let mobile = document.getElementById("mobile").value
                    let usertype = document.getElementById("usertype").value
                    let error = false;
                    let nameError = document.getElementById("nameError");
                    let emailError = document.getElementById("emailError")
                    let passwordError = document.getElementById("passwordError")
                    let cpasswordError = document.getElementById("cpasswordError")
                    let mobileError = document.getElementById("mobileError")
                    let usertypeError = document.getElementById("usertypeError")
                    
                    let namePat = /^[A-Za-z\s]+$/;

                    if (name === "" || name === null) {
                        nameError.innerHTML = "Name is required"
                        error = true;
                    } else if (!name.match(namePat)) {
                        nameError.innerHTML = "Invalid name. Only alphabets are allowed"
                        error = true;
                    } else {
                        nameError.innerHTML = "";
                    }
                    

                    let emailPat = /^[a-zA-Z0-9._%+-]+@[a-zA-Z\.]+\.[a-zA-Z]{2,}$/;
                    if (email === "" || email === null) {
                        emailError.innerHTML = "Email is required"
                        error = true;
                    } else if (!email.match(emailPat)) {
                        emailError.innerHTML = "Please enter a valid email"
                        error = true;
                    } else {
                        emailError.innerHTML = "";
                    }

                    let passPat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$*^%#!]).{8,16}$/;
                    if (password === "" || password === null) {
                        passwordError.innerHTML = "Password is required";
                        error = true;
                    } else if (!password.match(passPat)) {
                        passwordError.innerHTML = "Please enter a strong password (8-16). Only uppercase, lowercase, digits and @$*^%#! are allowed";
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

                    let mobPat = /^[6-9][0-9]{9}$/
                    if(mobile === "" || mobile === null){
                        mobileError.innerHTML = "Mobile number is required"
                        error = true;
                    } else if(!mobile.match(mobPat)){
                        mobileError.innerHTML = "Please enter a 10 digit valid mobile number"
                        error = true;
                    } else {
                        mobileError.innerHTML = ""
                    }

                    if (usertype === "" || usertype === null || usertype === "Choose User Type") {
                        usertypeError.innerHTML = "User Type is required";
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

            document.getElementById("name").addEventListener("input", function () {
                document.getElementById("nameError").innerHTML = "";
            });
            document.getElementById("email").addEventListener("input", function () {
                document.getElementById("emailError").innerHTML = "";
            });
            document.getElementById("password").addEventListener("input", function () {
                document.getElementById("passwordError").innerHTML = "";
            });
            document.getElementById("cpassword").addEventListener("input", function () {
                document.getElementById("cpasswordError").innerHTML = "";
            });
            document.getElementById("usertype").addEventListener("change", function () {
                document.getElementById("usertypeError").innerHTML = ""; 
            });
    </script>   
    <script src="assets\js\bootstrap.bundle.min.js"></script>
</body>
</html>