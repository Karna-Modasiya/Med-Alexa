<?php include("AllphpFunctions.php");  
    $email = $_SESSION['email'];
    if($email == false){
        header('Location: login-user.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    .newpass {
        background-color: rgba(255, 255, 255, 0.7);
        width: 25vw;
        margin: 15vh auto;
        /* border: 5px solid black; */
        padding: 5vh 3vw;
        border-radius: 20px;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
    }

    .error{
        display: none;
        color: red;
        font-size: 13px;
    }

    .lb {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    </style>
</head>

<body>
    <div class="newpass">
        <form class="row g-3" action="new-password.php" id="newpass" method="POST" autocomplete="off">
            <h2 class="text-center">New Password</h2>
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
            <div class="form-group">
                <input class="form-control" type="password" id="pass" name="password" placeholder="Create new password" onkeyup="validatepass();" required>
                <div class="error">
                    
                </div>
            </div>
            <div class="form-group">
                <input class="form-control" type="password" id="repass" name="cpassword" placeholder="Confirm your password" onkeyup="validaterepass();" required>
                <div class="error">
                    Confirm pass not matched with password
                </div>
            </div>
            <div class="col-12 lb">
                <button type="submit" name="change-password" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="forgotpass.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> -->
</body>

</html>