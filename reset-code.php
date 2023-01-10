<?php include("AllphpFunctions.php"); ?>

<?php 
$email = $_SESSION['email'];
if($email == false){
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
        /* background-color: #6665ee; */
        height: 100vh;
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .rcode {
        background-color: rgba(255, 255, 255, 0.7);
        /* background-color: white; */
        width: 25vw;
        margin: 15vh auto;
        /* border: 5px solid black; */
        padding: 5vh 3vw;
        border-radius: 20px;
        box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
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
    <div class="rcode">
        <form class="row g-3" action="reset-code.php" method="POST" autocomplete="off">
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
            <div class="form-group">
                <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
            </div>
            <div class="col-12 lb">
                <button type="submit" id="signupsubmit" name="check-reset-otp" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>