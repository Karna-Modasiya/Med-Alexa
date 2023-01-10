<?php
    include("AllphpFunctions.php");
    $_SESSION['info'] = "";
    if (isset($_POST['update'])) {
        $id= $_POST['id'];
        $type = $_POST['type'];
        $name = $_POST['name'];
        $email =$_POST['email'];
        $phone =$_POST['phone'];
        $update = "UPDATE $type SET email = '$email', name = '$name', phone='$phone' WHERE id='$id'";
        $res = $con->query($update);
        if ($res == true) {
            $_SESSION['info'] = "Your Profile has been Succesfully updated";
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['phone'] = $phone;
            
            // header('Location: '.$_SERVER['REQUEST_URI']);
        } 
    }
    if(isset($_POST['delete']))
    {
        $id=$_POST['id'];
        $type = $_POST['type'];
        $delete = "DELETE FROM $type WHERE `id` = '$id'";
        if(($con->query($delete)))
        {
            session_unset();
            session_destroy();
            header("location: login-user.php");
        }
        else{
            $error['delete']= "Error While deleting account";
        }
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .profile{
            width: 40vw;
            display: grid;
            row-gap: 1vh;
            margin: 5vh auto;
        }
        .profile h2{
            margin-bottom: 5vh;
        }
        .label{
            width:7vw;
            display: block;
        }
    </style>
    <title>Profile</title>
</head>
<body>
    <?php
        if($_SESSION['type'] == 'doctor')
            include("doctor-nav.php");
        else if($_SESSION['type'] == 'operator')
            include("operator-nav.php");
        else if($_SESSION['type'] == 'pharmacist')
            include("pharmacist-nav.php");
        else if($_SESSION['type'] == 'pathologist')    
            include("pathologist-nav.php");
    ?>
    <div class="profile">
        <form action="profile.php" method="POST">
            <h2 class="text-center">Profile Section</h2>
            <?php 
                if(isset($_SESSION['info']) && $_SESSION['info']!= null)
                {
                ?>
               <div class="alert alert-success text-center">
                    <?php echo $_SESSION['info'];?>
                </div>
            <?php
                }
            ?> 
            <div class="input-group mb-3">
                <div class="input-group-text label">ID</div>
                <input id="pid" type="text" class="form-control" name="id" value="<?php echo $_SESSION['id']?>" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Type</div>
                <input id="type" type="text" class="ro form-control" name="type" value="<?php echo $_SESSION['type']?>" readonly>
            </div>
            
            <?php
            if($_SESSION['type'] == "doctor")
            {
            ?>
            <div class="input-group mb-3 doc" id="doctype">
                <div class="input-group-text label">Doctor Type</div>
                <input id='Dtype' type='text' class='ro form-control' value="<?php echo $_SESSION['Dtype']?>" name='Doctype' readonly>
            </div>
            <?php
            }
            ?>
            
            <div class="input-group mb-3">
                <div class="input-group-text label">Name</div>
                <input id="name" type="text" class="ro form-control" name="name" value="<?php echo $_SESSION['name']?>">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Email</div>
                <input id="email" type="text" class="ro form-control" name="email" value="<?php echo $_SESSION['email']?>">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Phone</div>
                <input id="phone" type="text" class="ro form-control" name="phone" value="<?php echo $_SESSION['phone']?>">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Password</div>
                <input id="pass" type="password" class="ro form-control" name="pass" value="<?php echo $_SESSION['password']?>" readonly>
            </div>
            <div class="col-12 btn d-flex align-items-center justify-content-around">
                <button type="submit" id="update" class="btn btn-primary" name="update">Update</button>
                <button type="button" class="btn btn-primary">
                    <a style="text-decoration: none; color: white;" href="forgot-password.php">Reset Password</a>
                </button>
                <button type="submit" id="delete" class="btn btn-primary" name="delete">Delete</button>
            </div>
        </form>
    </div>
    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // doctype = document.getElementById("doctype");
        // user = document.getElementById("type");
        // if(user.value == "doctor")
        // {
        //     doctype.style.display = "block";
        //     input.value() = <?php echo $_SESSION['Dtype']?>";
        // }
        // else{
        //     doctype.style.display = "none";
        // }
    </script>
  </body>
</html>