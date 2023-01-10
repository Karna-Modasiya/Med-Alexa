<?php include("AllphpFunctions.php"); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
        body {
            background: url('signup_bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            /* background-color: #6665ee; */
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .fpass {
            background-color: rgba(255, 255, 255, 0.7);
            width: 25vw;
            margin: 20vh auto;
            box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
            /* border: 5px solid black; */
            padding: 5vh 3vw;
            border-radius: 20px;
        }

        .lb {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        </style>
    </head>

<body>
    <div class="fpass">
        <form class="row g-3" action="forgot-password.php" method="POST" autocomplete="">
            <h2 class="text-center">Forgot Password</h2>
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
            <div class="col-12">
                <p class="">Enter your user id</p>
                <input class="form-control" type="text" name="uid" placeholder="Enter ID" required>
            </div>
            <div class="col-12 lb">
                <button type="submit" id="signupsubmit" name="check-email" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>