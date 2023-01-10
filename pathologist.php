<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medalexa";
$errors = array();
$_SESSION['info'] = "";

// // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pathologist</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .input-group{
            width: 30vw;
        }
        .input-group-text{
            width: 84px;
        }
        .ro{
            background-color: white !important;
        }
        .bt{
            width: 120px;
        }
        .file-input{
            width: 70%;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="pathologist.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pathologist-profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="pathology-report-view.php">View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="resubmit.php">Re-submit Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout-user.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="welcome me-4" style="color:white;">Welcome <?php echo $_SESSION['pa_name'];?></span>
            </div>
        </div>
    </nav>
    <form autocomplete="off" class="container d-flex align-items-center justify-content-center py-5" action="pathologist.php" method="POST">
        <div class="input-group">
            <input class="form-control" type="search" name="pid" placeholder="Search patients by patient ID" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit" name="search"><i class="bi bi-search"></i></button>
        </div>
    </form>
    <?php 
        if($_SESSION['info']!=null){
    ?>
        <div class="container alert alert-success text-center d-flex align-items-center justify-content-center alert-dismissible fade show">
            <?php echo $_SESSION['info']; ?>
        </div>
    <?php
        }
    ?>
    <?php
                $flag=0;
                function Display(){
                    echo '<div class="f container d-flex flex-column align-items-center justify-content-center pb-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text">P-ID</span>
                            <input type="text" id="pid" class="ro form-control" placeholder="Patient ID" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" id="name" class="ro form-control" placeholder="Patient Name" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email-ID</span>
                            <input type="text" id="email" class="ro form-control" placeholder="Patient Email-ID" readonly>
                        </div>
                    </div>';
                }
                if(isset($_POST['search']))
                {
                    $pid = $_POST['pid'];
                    $sql2 = "SELECT * FROM `patient` WHERE `id`='$pid'";
                    $result2 = $conn->query($sql2);
                    if($result2->num_rows>0)
                    {
                        $row=mysqli_fetch_array($result2);
                        echo '<div class="f container d-flex flex-column align-items-center justify-content-center pb-5">
                        <div class="input-group mb-3">
                            <span class="input-group-text">P-ID</span>
                            <input type="text" id="pid" class="ro form-control" value='.$row['id'].' name="pt_id" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Name</span>
                            <input type="text" id="name" class="ro form-control" value="'.$row['name'].'" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Email-ID</span>
                            <input type="text" id="email" class="ro form-control" value='.$row['email'].' readonly>
                        </div>
                    </div>';
                    $flag++;
                    }
                    else
                    {
                        $errors['ID'] = "Patient ID Not Found";
                        Display();
                    }
                }
                else{
                    Display();
                }
    ?>
    <?php
                if(isset($_POST['submit']))
                {
                        $sql2 = "SELECT * FROM `med_alexa`.`pt_report` WHERE `file` IS NULL";
                        
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0)
                        {
                            while($row1 = $result2->fetch_assoc())
                            {
                                $pid = $row1['pt_id'];
                                $Date1=$row1['Date'];
                                $Date=str_replace(" ","_",$row1['Date']);
                                $report1=$row1['report'];
                                $report=str_replace(" ","_",$row1['report']);
                                if(isset($_POST[$pid]))
                                {
                                    if(isset($_POST[$Date])&&!empty($_FILES[$report]['tmp_name']))
                                    {
                                        $pdf1 = addslashes(file_get_contents($_FILES[$report]['tmp_name']));
                                            $addfile="UPDATE `med_alexa`.`pt_report` SET `file`='$pdf1' WHERE `pt_id`='$pid' AND `Date`='$Date1' AND `report`='$report1'";
                                            if($conn->query($addfile))
                                            {
                                                require("vendor/autoload.php");
                                                $sql="SELECT * FROM `patient` WHERE `pt_id`='$pid'";
                                                $result=$conn->query($sql);
                                                $row=$result->fetch_assoc();

                                                echo "SUCCESS ON UPLOAD";
                                                $mail=new PHPMailer();
                                                $mail->HOST = 'smtp.gmail.com';
                                                $mail->SMTPAuth= true;
                                                $mail->SMTPSecure='ssl';
                                                $mail->Port=587;
                                                $mail->Username="team.medalexa@gmail.com";
                                                $mail->Password="Medalexa@162410";
                                                $mail->From="team.medalexa@gmail.com";
                                                $mail->FromName="Team Med-Alexa";
                                                $mail->addAddress($row['email']);
                                                $mail->Subject="Report by Med-Alexa";
                                                $mail->Body="Dear ".$row['name']." , Your ".$report1." is attached here.";
                                                $mail->AddStringAttachment(file_get_contents($_FILES[$report]['tmp_name']),$report1.'.pdf','base64','php_demo/pdf');
                                                if($mail->send())
                                                {
                                                    $_SESSION['info'] = "Report has been Succesfully Submited";
                                                }
                                                else{
                                                    $errors['Email'] = "Error while sending email";
                                                }                                            
                                            }
                                            else
                                                $errors['db'] = "Error while inserting pdf into database";
                                    }
                                    else
                                        $errors['warning'] = " You haven't uploaded all the files!!";
                                }
                            }
                        }
                }
            ?>
    <?php
        if(count($errors) > 0){
    ?>  
        <div class="container alert alert-danger text-center d-flex align-items-center justify-content-center alert-dismissible fade show" style="width: 40vw;">
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
    <div class="container items">
        <h2 >Submit pdf</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SNo.</th>
                    <th scope="col">Test</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Upload</th>
                </tr>
            </thead>
            <form action="pathologist.php" method="POST" enctype="multipart/form-data">
            <tbody>
            <?php

if($flag>0)
{
    
    $pid = $_POST['pid'];
    $sql2 = "SELECT * FROM `med_alexa`.`pt_report` WHERE `pt_id`='$pid' and `file` IS NULL";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows>0)
    {
        $i=1;
        
        while($row2 = $result2 -> fetch_assoc()){
            $pid = $row2['pt_id'];
            $report1=$row2['report'];
            $report=str_replace(" ","_",$row2['report']);
            $desc=$row2['description'];
            $date = $row2['Date'];
            $date1=str_replace(" ","_",$date);
            // $sql3 = "SELECT * FROM `med_alexa`.`patient` WHERE `pt_id`='$pid'";
            // $result3 = $conn->query($sql3);
            // $row3 = mysqli_fetch_assoc($result3);
            echo '
                <tr>
                    <td>'.$i++.'</td>
                    <td>'.$report1.'</td>
                    <td>'.$desc.'</td>
                    <td>
                        <input type="hidden" value='.$date1.' name='.$date1.'>
                        <input type="hidden" value='.$pid.'  name='.$pid.'>
                        <input class="file-input form-control form-control-sm" id="formFileSm" name='.$report.' type="file">
                    </td>
                    </tr>';
        }
    }
                    else{
                        $errors['Record'] = "Patient does not have any report";
                    }
                }
            ?>
            </tbody>
            </table>
                <div class="btncontainer d-flex flex-column align-items-center justify-content-center py-3">
                    <button type="submit" id="submitpr" name="submit" class="btn btn-primary ">Submit</button>
                </div>
            </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
</html>