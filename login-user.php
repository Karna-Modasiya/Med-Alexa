<?php include("AllphpFunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {
        background: url('signup_bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* background-color: #6665ee; */
        font-family: 'Poppins', sans-serif;
    }

    .login {
        background-color: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(5px);
        width: 30vw;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
        /* margin: 15vh auto; */
        /* border: 5px solid black; */
        padding: 5vh 3vw;
        border-radius: 20px;
        /* box-shadow: 0px 5px 20px 2px black; */
    }

    .lb {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .fsize {
        font-size: 19px;
    }
    </style>
</head>

<body>
    <div class="login">
        <form autocomplete="off" class="row g-3" action="login-user.php" method="POST" autocomplete="">
            <h2 class="text-center">Login Form</h2>
            <?php
                if(count($errors) > 0){
            ?>
            <div class="alert alert-danger text-center">
                <?php  
                    foreach($errors as $error){
                        echo $error;
                        echo "<br>";
                    }
                ?>
            </div>
            <?php
                }
            ?>
            <div class="" id="selectuser">
                <label for="inputuser" class="form-label">Select User Type</label>
                <select id="inputuser" class="form-select" name="user" required>
                    <option>doctor</option>
                    <option selected>operator</option>
                    <option>pharmacist</option>
                    <option>pathologist</option>
                </select>
            </div>
            <div class="col-12" id="userid">
                <label for="inputname" id="Idlabel" class="form-label"></label>
                <input type="text" class="form-control" name="userid" placeholder="" required>
            </div>
            <div class="col-md" id="pass">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword" required>
            </div>
            <div class="col-12 lb">
                <button type="submit" id="signupsubmit" class="btn btn-primary" name="login">Login</button>
            </div>
            <div class="text-center fsize"><a href="forgot-password.php">Forgot password?</a></div>
            <div class="text-center fsize">Not Registred? <a href="signup-user.php">Signup now</a></div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
    var user = document.getElementById("inputuser");
    var id = document.getElementById("Idlabel");
    setInterval(function() {
        if (user.value == "doctor") {
            console.log(user.value);
            id.innerHTML = "Doctor's ID"
        } else if (user.value == "pharmacist") {
            console.log(user.value);
            id.innerHTML = "Pharmacist ID"
        } else if (user.value == "pathologist") {
            console.log(user.value);
            id.innerHTML = "Pathologist ID"
        } else if (user.value == "operator") {
            console.log(user.value);
            id.innerHTML = "Operator ID"
        }
    }, 100);
    </script>
</body>

</html>