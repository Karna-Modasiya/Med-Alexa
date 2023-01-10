<?php include("AllphpFunctions.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            background: url('signup_bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* background-color: #6665ee; */
            font-family: 'Poppins', sans-serif;
        }

        .signup {
            background-color: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(5px);
            width: 40vw;
            margin: 5vh auto;
            /* border: 5px solid black; */
            box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
            padding: 5vh 3vw;
            border-radius: 20px;
            overflow: auto;
        }

        .error{
            display: none;
            color: red;
            font-size: 12px;
        }

        .fsize {
            font-size: 19px;
        }

    </style>
</head>

<body>
    <div class="signup">
        <form autocomplete="on" class="row g-3" id="signup" action="signup-user.php" method="POST" >
            <h2 class="text-center">Signup Form</h2>
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
            <div class="col-md-4 user inputBox">
                <label for="inputuser" class="form-label">Select User Type</label>
                <select id="inputuser" class="form-select" name="inputUser">
                    <option>doctor</option>
                    <option selected>operator</option>
                    <option>pharmacist</option>
                    <option>pathologist</option>
                </select>
            </div>
            <div class="specification" name="specification" id="specification">
                <label for="inputdtype" class="form-label">Select Doctor Type</label>
                <select class="form-select" id="inputDtype" name="inputDtype">
                    <option selected>Cardiologist</option>
                    <option>Audiologist</option>
                    <option>Dentis</option>
                    <option>ENT specialist</option>
                    <option>Orthopaedic surgeon</option>
                    <option>Paediatrician</option>
                    <option>Psychiatrists</option>
                    <option>Radiologist</option>
                    <option>Pulmonologist</option>
                    <option>Endocrinologist</option>
                    <option>Oncologist</option>
                    <option>Cardiothoracic surgeon</option>

                </select>
            </div>
            <div class="col-12 inputBox" id="name">
                <label for="user">Full Name</label>
                <input type="text" class="form-control" id="inputname" name="inputName"  onkeyup="validatename();" placeholder="" required>                
                <div class="error">
                    Enter valid name
                </div>
            </div>
            <div class="col-md-6 inputBox" id="email">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="inputEmail" id="inputemail"  onkeyup="validateemail();" required>
                <div class="error">
                    Enter email in valid format
                </div>
            </div>
            <div class="col-md-6 inputBox" id="call">
                <label for="phone">Phone Number</label>
                <input type="number" class="form-control" name="inputPhone" onkeyup="validatephone();"  id="inputPhone" required>
                <div class="error">
                    Enter valid Phone Number
                </div>
            </div>
            <div class="col-md-6 inputBox" id="pass">
                <label for="pass">Password</label>
                <input type="password" class="form-control" name="inputPassword" id="inputPassword"  onkeyup="validatepass();" required>
                <div class="error">
                    
                </div>
            </div>
            <div class="col-md-6 inputBox" id="repass">
                <label for="pass">Confirm Password</label>
                <input type="password" class="form-control" name="RePassword" id="RePassword" onkeyup="validaterepass();" required>
                <div class="error">
                    Confirm pass not matched with password
                </div>
            </div>
            <div class="col-12 btn">
                <button type="submit" class="btn btn-primary"  name="signup" onclick="submitform();">Sign Up</button>
            </div>
            <div class="text-center fsize">Already have an account? <a href="login-user.php">Login here</a></div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="signup.js"></script>
</body>

</html>