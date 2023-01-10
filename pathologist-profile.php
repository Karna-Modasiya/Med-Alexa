<?php
    include("AllphpFunctions.php");
    if($_SESSION['pa_id']==null)
    {
        header('location: login-user.php');
    }
    $_SESSION['info'] = "";
    $id = $_SESSION['pa_id'];

    $search = "SELECT * FROM `pathologist` WHERE `id`='$id'";
    $res = $con->query($search);
    if (mysqli_num_rows($res) > 0) {
        $result = mysqli_fetch_assoc($res);
        $type = "pathologist";
        $name = $result['name'];
        $email = $result['email'];
        $phone = $result['phone'];
        $password = $_SESSION['pa_pass'];
    }
    if (isset($_POST['update'])) {
        $id= $_POST['id'];
        $name = $_POST['name'];
        $email =$_POST['email'];
        $phone =$_POST['phone'];
        $update = "UPDATE pathologist SET email = '$email', name = '$name', phone='$phone' WHERE id='$id'";
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
        $delete = "DELETE FROM pathologist WHERE `id` = '$id'";
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
    <title>Pathologist</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="med3.png" alt="" width="50" height="30" class="d-inline-block align-text-top">    
                Med-Alexa
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="pathologist.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="pathologist-profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="pathology-report-view.php">View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="resubmit.php">Re-submit Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pa_logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="welcome me-4" style="color:white;">Welcome <?php echo $_SESSION['pa_name'];?></span>
            </div>
        </div>
    </nav>
    
    <div class="profile">
        <form autocomplete="off" action="" method="POST">
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
                <input id="id" type="text" class="form-control" name="id" value="" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Type</div>
                <input id="type" type="text" class="ro form-control" name="type" value="" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Name</div>
                <input id="name1" type="text" class="ro form-control" name="name" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Email</div>
                <input id="email" type="text" class="ro form-control" name="email" value="">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Phone</div>
                <input id="phone" type="text" class="ro form-control" name="phone" value="">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Password</div>
                <input id="password" type="password" class="ro form-control" name="pass" value="" readonly>
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

    id = document.getElementById('id');
    name = document.getElementById('name1');
    pass = document.getElementById('password');
    type = document.getElementById('type');
    phone = document.getElementById('phone');
    email = document.getElementById('email');

    paid = "<?php echo $id; ?>";
    paname = "<?php echo $name; ?>";
    papass = "<?php echo $password; ?>";
    patype = "<?php echo $type; ?>";
    paphone = "<?php echo $phone; ?>";
    paemail = "<?php echo $email; ?>";

    // console.log(id);
    // console.log(typeof ppid);
    // console.log(oname);
    // console.log(typeof ppname);
    // console.log(ppage);
    // console.log(typeof ppage);
    // console.log(ppgender);
    // console.log(typeof ppgender);
    // console.log(email);
    // console.log(typeof ppemail);

    id.value = paid;
    name1.value = paname;
    pass.value = papass;
    phone.value = paphone;
    type.value = patype;
    email.value = paemail;
    </script>
    </script>
  </body>
</html>