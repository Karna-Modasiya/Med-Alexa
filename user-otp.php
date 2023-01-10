<?php include("AllphpFunctions.php"); ?>
<?php 
$email = $_SESSION['email'];
if($email == ""){
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Code Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {
        background: url('signup_bg.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }

    .OTP {
        background-color: rgba(255, 255, 255, 0.7);
        width: 25vw;
        margin: 15vh auto;
        /* border: 5px solid black; */
        padding: 5vh 3vw;
        border-radius: 20px;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
    }

    .lb {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body>
    <div class="OTP">
        <form class="row g-3" action="user-otp.php" method="POST" autocomplete="off">
            <h2 class="text-center">Code Verification</h2>
            <?php 
                if(isset($_SESSION['info'])){
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
            <div class="">
                <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
            </div>
            <div class="col-12 lb">
                <button type="submit" id="signupsubmit" name="check" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>