<?php
    include("AllphpFunctions.php");
    if($_SESSION['op_id']==null)
    {
        header('location: login-user.php');
    }
    $_SESSION['info'] = "";
    $erros = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
    .signup {
        width: 40vw;
        margin: 8vh auto;
        padding: 0vh 2vw;
    } 
    h2{
        padding-bottom: 3vh;
    }

    .label{
        text-align :center;
        width: 9vw;
        display: block;
    }

    .txtar {
        width: 27vw;
        resize: none;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="med3.png" alt="" width="50" height="30" class="d-inline-block align-text-top">
            Med-Alexa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item fsize">
                        <a class="nav-link active" aria-current="page" href="operator.php">Home</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link" href="operator-profile.php"> Operator Profile</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link" href="patient-profile.php">Update Patient Profile</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link" href="op_logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="welcome me-4" style="color:white;">Welcome <?php echo $_SESSION['op_name'];?></span>
            </div>
        </div>
    </nav>
    <div class="signup">
        <form autocomplete = "on" id="patient" action="operator.php" method="POST">
            <h2 class="text-center"> Add Patient </h2>
            <?php 
                if($_SESSION['info'] != ""){
                    ?>
                <div class="alert alert-success text-center">
                    <?php echo $_SESSION['info']; ?>
                </div>
            <?php
                }
            ?>
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
            <div class="input-group mb-3">
                <div class="input-group-text label">Name</div>
                <input id="name" type="text" class="ro form-control" name="Name" placeholder="Patient's Name" name="pname" onkeyup="validatename();" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">DOB</div>
                <input id="dob" type="date" class="ro form-control"  name="Dob" placeholder="Patient's DOB" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Gender</div>
                <select name="Gender" class="ro form-control"  name="Gender" id="Gender" required>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Blood Group</div>
                <select name="Blood" class="ro form-control"  name="blood" id="blood" required>
                    <option>A+</option>
                    <option>A-</option>
                    <option>O+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Email</div>
                <input id="email" type="text" class="ro form-control"  placeholder="Patient's Email-ID" name="Email" onkeyup="validateemail();" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Phone</div>
                <input id="phone" type="number" class="ro form-control"  placeholder="Patient's Phone Number" name="Phone" onkeyup="validatephone();" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Any Allergy</div>
                <input id="allergy" type="text" class="ro form-control"  name="Allergy" placeholder="Patient's Allergy">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Medical history</div>
                <textarea class="form-control txtar" name="History" id="phone"  rows="2" placeholder="Patient's Medical History"></textarea>
            </div>
            <div class="col-12 btn d-flex align-items-center justify-content-around">
                <button type="submit" id="signupsubmit" class="btn btn-primary" name="patient-otp">Add</button>
            </div>
        </form>
    </div>

    <script src="patient.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>