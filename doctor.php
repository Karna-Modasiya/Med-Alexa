<?php
session_start();
    if($_SESSION['dr_id']==null)
    {
        header('location: login-user.php');
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medalexa";

    // Create connection
    $con = new mysqli($servername, $username, $password, $dbname);
    $_SESSION['pt_email']= "";
    $_SESSION['info'] = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
    .input-group {
        width: 35vw;
    }

    .ro {
        background-color: white !important;
    }

    .bt {
        width: 120px;
    }

    .alert {
        width: 30vw;
        margin: 0px auto;
    }
    .data{
        margin: 4vh auto;
    }
    .label {
        width: 9vw;
        display: block;
    }
    .welcome{
        color:white;
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="doctor.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor-profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report-view.php" >View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="prescription-view.php" >View Prescription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dr_logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="welcome me-4" style="color:white;">Welcome Dr. <?php echo  $_SESSION['dr_name']?></span>
            </div>
        </div>
    </nav>
    <form autocomplete="off" class="container d-flex align-items-center justify-content-center pt-5 pb-3" action="doctor.php" method="post">
        <div class="input-group">
            <input name="pid" class="form-control" type="search" placeholder="Search patients by patient ID"
                aria-label="Search" required>
            <button class="btn btn-outline-secondary " name="btn" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>
    <?php
    
        if(isset($_POST["btn"]))
        {
            $pid = $_POST["pid"];
            $_SESSION['info']="";
            $search = "SELECT * FROM patient WHERE id='$pid'";
            // $res = mysqli_query($con,$update);
            $res = $con->query($search);
            if (mysqli_num_rows($res) > 0)
            {
                $result = mysqli_fetch_assoc($res);
                $pname = $result['name'];
                $bg = $result['blgr'];
                $gender = $result['gender'];
                $allergy = $result['allergy'];
                $history = $result['history'];
                $pemail = $result['email'];     
                    $_SESSION['pt_email'] = $pemail;
                    $_SESSION['pname'] = $pname;
                    $_SESSION['pt_id'] = $pid;

                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo 'Patient ID found.';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                }
                else
                {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo 'Patient ID not found!';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                }
            }
    ?>
    <?php 
        if($_SESSION['info']!=null){
    ?>
        <div class="alert alert-success text-center">
            <?php echo $_SESSION['info']; ?>
        </div>
    <?php
        }
    ?>
    <div class="f container d-flex flex-column align-items-center justify-content-center py-5">
        <div class="input-group mb-3">
            <span class="input-group-text label">P-ID</span>
            <input id="pid" type="text" class="ro form-control" placeholder="Patient-ID" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text label">Name</span>
            <input id="name" type="text" class="ro form-control" placeholder="Patient's Name" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text label">Blood Group</span>
            <input id="bg" type="text" class="ro form-control" placeholder="Patient's Blood Group" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text label">Gender</span>
            <input id="gender" type="text" class="ro form-control" placeholder="Patient's Gender" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text label">Allergy</span>
            <input id="allergy" type="text" class="ro form-control" placeholder="Patient's Allergy" readonly>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text label">Medical History</span>
            <input id="history" type="text" class="ro form-control" placeholder="Patient's Medical History" readonly>
        </div>
        <div class="data">
            Search for a patient ID above to see their data
        </div>
        <div class="container d-flex align-items-center justify-content-center">
            <a type="button" class="bt btn btn-primary mx-2" href="dr-report.php">Report</a>
            <a type="button" class="bt btn btn-primary mx-2" href="prescription.php">Prescription</a>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
    pid = document.getElementById("pid");
    pname = document.getElementById('name');
    pbg = document.getElementById('bg');
    pgender = document.getElementById('gender');
    pallergy = document.getElementById('allergy');
    phistory = document.getElementById('history');

    ppid = "<?php echo $pid; ?>";
    ppname = "<?php echo $pname; ?>";
    ppbg = "<?php echo $bg; ?>";
    ppgender = "<?php echo $gender; ?>";
    ppallergy = "<?php echo "$allergy"; ?>";
    pphistory = "<?php echo "$history"; ?>";

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
    pgender.value = ppgender;
    pallergy.value = ppallergy;
    phistory.value = pphistory;
    </script>

</body>
</html>