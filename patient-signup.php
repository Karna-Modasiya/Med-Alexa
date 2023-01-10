<?php include("AllphpFunctions.php");
$erros = array();?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Sign Up Form</title>
    <style>
    .patient-signup {
        width: 40vw;
        margin: 8vh auto;
        border: 5px solid black;
        padding: 5vh 5vw;
        border-radius: 50px;
        /* box-shadow: 0px 5px 20px 2px black; */
        overflow: auto;
    }

    @media only screen and (max-width: 600px) {
        .signup {
            width: 90vw;
            margin: 3vh;
        }
    }

    .user {
        margin-right: 15vw;
    }
    </style>
</head>
<body>
    <?php include("operator-nav.php")?>
    <div class="patient-signup">
        <form autocomplete="off" class="row g-3" action="patient-signup.php" method="POST">
            <!-- <h2 class="text-center">Patient Signup Form</h2> -->
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
            <!-- <div class="col-12 user" id="name">
                <label for="Name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="Name" name="Name" placeholder="" readonly>
            </div>
            <div class="col-6" id="date">
                <label for="Dob" class="form-label">Date Of Birth</label>
                <input type="date" class="form-control" id="Dob" name="Dob" placeholder="">
            </div>
            <div class="col-md-6" id="age">
                <label for="Age" class="form-label">Age</label>
                <input type="Number" class="ro form-control" id="Age" name="Age" readonly>
            </div>
            <div class="col-md-6 " id="email">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" name="Email" id="Email">
            </div>
            <div class="col-md-6" id="call">
                <label for="Number" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="Phone" id="Number">
            </div>
            <div class="col-12 btn">
                <button type="submit" id="signupsubmit" class="btn btn-primary" name="patient-otp">Sign Up</button>
            </div> -->
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- <script>
    var inputage = document.getElementbyID("Age");
    var birthDate = document.getElementbyID("Dob").value;
    var dob = new Date(birthdate);

    function ageCalculator() {
        if (birthdate == null || birthdate == '') {

        } else {
            //calculate month difference from current date in time  
            var month_diff = Date.now() - dob.getTime();

            //convert the calculated difference in date format  
            var age_dt = new Date(month_diff);

            //extract year from date      
            var year = age_dt.getUTCFullYear();

            //now calculate the age of the user  
            var age = Math.abs(year - 1970);

            //display the calculated age  
            document.getElementById("inputage").value = age;
        }
    } -->
    </script>
</body>

</html>