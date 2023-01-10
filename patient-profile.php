<?php
    session_start();
    if($_SESSION['op_id']==null)
    {
        header('location: login-user.php');
    }
    $errors = array();
    $con = mysqli_connect('localhost', 'root', '', 'medalexa');
    if(isset($_POST["search"]))
    {
        $pid = $_POST["pid"];
        $search = "SELECT * FROM patient WHERE id='$pid'";
        $res = $con->query($search);
        if (mysqli_num_rows($res) > 0)
        {
            $result = mysqli_fetch_assoc($res);
            $pname = $result['name'];
            $dob = $result['dob'];
            $gender = $result['gender'];
            $pemail = $result['email'];
            $pphone = $result['phone'];
            $bg = $result['blgr'];
            $history = $result['history'];
            $allergy = $result['allergy'];
            $_SESSION['info'] = "Patient ID found";
        }
        else{
            $_SESSION['info'] = null;
            $errors['query']="ID not found";
        }
    }
    if(isset($_POST['delete']))
    {
        $id=$_POST['pid'];
        $delete = "DELETE FROM `patient` WHERE `id` = '$id'";
        $deleterecord = "DELETE FROM `pt_record` WHERE `pt_record`.`pt_id` = '$id'";
        $deletereport = "DELETE FROM `pt_report` WHERE `pt_report`.`pt_id` = '$id'";
        $con->query($deleterecord);
        $con->query($deletereport);
        if(!($con->query($delete)))
        {
            $_SESSION['info'] = "";
            $errors['delete']= "Error While deleting account";
        }
        else{
            $_SESSION['info'] = "Account deleted succesfully";
        }
    }
    if (isset($_POST['update'])) {
        $_SESSION['info'] ="";
        $id = $_POST['pid'];
        $name = $_POST['pname'];
        $email = $_POST['pemail'];
        $phone = $_POST['pphone'];
        // $dob = $_POST['dob'];
        $allergy = $_POST['allergy'];
        $history = $_POST['history'];
        $otp=rand(99999,999999);
        $from="team.medalexa@gmail.com";
        $fromName="Team Med-Alexa";
        $subject="OTP for profile update in Med-Alexa";
        $headers="Content-Type: text/html; charset=UTF-8\r\n";
        $message="<h4> Dear <b>$name</b>,<br><br>\tYour One Time Password (OTP) for Update Profile in Med-Alexa is <b style='color: blue;'>$otp</b>.</h4><br>
        <h4>Do not share this OTP with anyone.<br><br>Team Med-alexa</h4>";
        if(mail($email, $subject, $message, $headers)){
            $info = "We've sent a verification code to your email - '$email'";
            $_SESSION['info'] = $info;
            $_SESSION['pid'] = $id;
            $_SESSION['pemail'] = $email;
            $_SESSION['pname'] = $name;
            $_SESSION['pphone'] = $phone;
            // $_SESSION['dob'] = $dob;
            $_SESSION['history'] = $history;
            $_SESSION['allergy'] = $allergy;
            $_SESSION['otp'] = $otp; 
            header('location: patient-update-otp.php');
            exit();
        }
        else{
            $errors['otp-error'] = "Failed while sending code!";
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
    .profile {
        width: 40vw;
        margin: 8vh auto;
        padding: 0vh 2vw;
    }

    .label {
        width: 9vw;
        display: block;
    }
    .searchbar {
        display: flex;
    }

    .button {
        width: 3vw;
    }

    .ro {
        background-color: white !important;
    }

    .bt {
        width: 240px;
    }

    .fsize {
        font-size: 15px;
    }

    .txtar {
        width: 27vw;
        resize: none;
    }
    </style>
    <title>Operator</title>
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
                        <a class="nav-link" aria-current="page" href="operator.php">Home</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link" href="operator-profile.php"> Operator Profile</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link active" href="patient-profile.php">Update Patient Profile</a>
                    </li>
                    <li class="nav-item fsize">
                        <a class="nav-link" href="op_logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="me-4" style="color:white;">Welcome <?php echo $_SESSION['op_name'];?></span>
            </div>
        </div>
    </nav>

    <div class="profile">
        <h2 class="text-center">Patient Profile </h2>
        <form autocomplete="off" class="container d-flex align-items-center justify-content-center py-5" action="patient-profile.php"
            method="post">
            <div class="input-group">
                <input name="pid" class="form-control" type="search" placeholder="Search patients by patient ID"
                    aria-label="Search" required>
                <button class="btn btn-outline-secondary " name="search" type="submit"><i
                        class="bi bi-search"></i></button>
            </div>
        </form>
        <?php 
            if($_SESSION['info']!=null){
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
        <form autocomplete="off" class="" action="patient-profile.php" method="POST">
            <div class="input-group mb-3">
                <div class="input-group-text label">ID</div>
                <input id="pid" type="text" class="form-control" name="pid" placeholder="Patient ID" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Name</div>
                <input id="name" type="text" class="ro form-control" placeholder="Patient's Name" name="pname">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">DOB</div>
                <input id="dob" type="date" class="ro form-control" placeholder="Patient's DOB" name="dob" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Blood Group</div>
                <select name="Blood" class="ro form-control"  name="blood1" id="blood" readonly>
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
                <div class="input-group-text label">Gender</div>
                <input id="gender" type="text" class="ro form-control" placeholder="Patient's Gender" name="gender" readonly>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Email</div>
                <input id="email" type="email" class="ro form-control" placeholder="Patient's Email-ID" name="pemail">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Phone</div>
                <input id="phone" type="tel" class="ro form-control" placeholder="Patient's Phone number" name="pphone">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Any Allergy</div>
                <input id="allergy" type="text" class="ro form-control"  name="allergy" placeholder="Patient's Allergy" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-text label">Medical history</div>
                <textarea class="form-control txtar" name="history" id="history"  rows="2" placeholder="Patient's Medical History"></textarea >
            </div>
            <div class="col-12 btn d-flex align-items-center justify-content-around">
                <button type="submit" id="update" class="btn btn-primary" name="update">Update</button>
                <button type="submit" id="delete" class="btn btn-primary" name="delete">Delete</button>
            </div>
        </form>
    </div>
    <script>
    pid = document.getElementById("pid");
    pname = document.getElementById('name');
    pbg = document.getElementById('blood');
    pdob = document.getElementById('dob');
    phistory = document.getElementById('history');
    pallergy = document.getElementById('allergy');
    pgen = document.getElementById('gender');
    pphone = document.getElementById('phone');
    pemail = document.getElementById('email');

    ppid = "<?php echo $pid; ?>";
    ppname = "<?php echo $pname; ?>";
    ppbg = "<?php echo $bg; ?>";
    ppdob = "<?php echo $dob; ?>";
    pphistory = "<?php echo $history; ?>";
    ppallergy = "<?php echo $allergy; ?>";
    ppgen = "<?php echo "$gender"; ?>";
    ppphone = "<?php echo "$pphone"; ?>";
    ppemail = "<?php echo "$pemail"; ?>";

    // console.log(ppid);
    // console.log(typeof ppid);
    // console.log(ppname);
    // console.log(typeof ppname);
    // console.log(ppage);
    // console.log(typeof ppage);
    // console.log(ppgender);
    // console.log(typeof ppgender);
    // console.log(ppemail);
    // console.log(typeof ppemail);

    pid.value = ppid;
    pname.value = ppname;
    pbg.value = ppbg;
    phistory.value = pphistory;
    pallergy.value = ppallergy;
    pgen.value = ppgen;
    pphone.value = ppphone;
    pdob.value = ppdob;
    pemail.value = ppemail;
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>