<?php
session_start();
    if($_SESSION['pa_id']==null && $_SESSION['dr_id']==null)
    {
        header('location: login-user.php');
    }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "medalexa";

// // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .input-group{
            width: 30vw;
        }
        .input-group-text{
            width: 78px;
        }
        .ro{
            background-color: white !important;
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
                        <a class="nav-link" href="doctor.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="report-view.php">View Report</a>
                    </li>
                    
                </ul>
                
            </div>
        </div>
    </nav>
    <form class="container d-flex align-items-center justify-content-center py-5" action="report-view.php" method="POST">
        <div class="input-group">
            <input class="form-control" type="search" name="search" placeholder="Search patients by patient ID" aria-label="Search">
            <button class="btn btn-outline-secondary" type="submit" name="submit" onclick=searchDisplay()><i class="bi bi-search"></i></button>
        </div>
    </form>
    <?php
        $flag=0;
        function Display(){
        echo    '<div class="f container d-flex flex-column align-items-center justify-content-center py-5">
                    <div class="input-group mb-3">
                        <span class="input-group-text">P-ID</span>
                        <input type="text" id="pid" class="ro form-control" placeholder="Patient-ID" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input type="text" id="name" class="ro form-control" placeholder="Patient Name" readonly>
                    </div>
                </div>';
        }
        if(isset($_POST['submit']))
        {   
            $pid=$_POST['search'];
            $sql = "SELECT * FROM `pt_report` WHERE `pt_id`='$pid' AND `file` IS NOT NULL";
            $result = $conn->query($sql);
                
                if ($result->num_rows > 0)
                {
                        $row = $result->fetch_assoc();
                        $pid = $row['pt_id'];
                        $sql1= "SELECT * FROM `patient` WHERE `id`='$pid'";
                        $result1 = $conn->query($sql1);
                        $row1=mysqli_fetch_assoc($result1);
                        $pname = $row1['name'];
                        $date2=str_replace(" ","_",$row['Date']);
                        $report=str_replace(" ","_",$row['report']);
                        echo  '<div class="f container d-flex flex-column align-items-center justify-content-center py-5">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">P-ID</span>
                                    <input type="text" id="pid" class="ro form-control" value='.$pid.' readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Name</span>
                                    <input type="text" id="name" class="ro form-control" value='.$pname.' readonly>
                                </div>
                                </div>';
                        $flag++;
                }
                else
                {
                    echo "INCORRECT ID";
                    Display();
                }
        }
        else
        Display();
    ?>
    <div class="report container my-2">
        <h2>Reports</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">SNo.</th>
                    <th scope="col">Test</th>
                    <th scope="col">Date</th>
                    <th scope="col">Report</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                if($flag!=0)
                {
                    $pid = $_POST['search'];
                    $sql2 = "SELECT * FROM `pt_report` WHERE `pt_id`='$pid' and `file` IS NOT NULL";
                    $result2 = $conn->query($sql2);        
                    if ($result2->num_rows>0)
                    {
                        $i=1;
                        while($row2 = $result2 -> fetch_assoc()){
                            $pid = $row2['pt_id'];
                            $report1=$row2['report'];
                            $report=str_replace(" ","_",$row2['report']);
                            $desc=$row2['description'];
                            $date1 = $row2['Date'];
                            $date =str_replace(" ","_",$date1);
                            
                            echo '<tr>
                                    <td>'.$i++.'</td>
                                    <td>'.$report1.'</td>
                                    <td>'.$date1.'</td>
                                    <td><div class="mb-1 btnflex">
                                    <form action="report-view.php" method="POST">
                                    <input type="hidden"  value='.$date.' name="Date">
                                    <input type="hidden"  value='.$report.' name="report">
                                    <input type="hidden" value='.$pid.'  name="pid">
                                    <input type="submit" value="View Report" class="btn-sm btn-primary" name="submit_report">
                                    </form>
                                    </div></td>
                                </tr>';
                        }
                    }
                    else
                    {
                        echo "NO DATA FOUND";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
                if(isset($_POST['submit_report']))
                {
                    $pid1 = $_POST['pid'];
                    $date2= $_POST['Date'];
                    $report=$_POST['report'];
                    $Date=str_replace("_"," ",$date2);
                    $report1=str_replace("_"," ",$report);
                    $sql = "SELECT `file` FROM `pt_report` WHERE `pt_id`='$pid1' and `Date`='$Date' and `report`='$report1'";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $report_file=$row['file'];
                            
                    header('Content-Type: application/pdf');    
                            
                    ob_clean();
                    echo $report_file;
                            
                }
    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>
</html>