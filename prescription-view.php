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
    $_SESSION['info'] = '';
    // Create connection
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
    .left-box {
        width: 25%;
    }

    .left-pane {
        /* width: 25%; */
        height: 78.5vh;
    }

    .right-pane {
        width: 75%;
        height: 90.8vh;
    }

    .tab:hover {
        background-color: #f2f2f2;
    }
    .obs{
        width: 25vw;
    }
    .tobs td, .tobs th{
        text-align: center;
    }

    ::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: rgba(128, 128, 128, 0.5);
        border-radius: 100px;
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
                        <a class="nav-link" aria-current="page" href="doctor.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="doctor-profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="report-view.php" >View Report</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="prescription-view.php" >View Prescription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dr_logout.php" tabindex="-1" aria-disabled="true">Logout</a>
                    </li>
                </ul>
                <span class="welcome me-4" style="color:white;">Welcome <?php echo $_SESSION['dr_name'];?></span>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        <!--  -->
        <div class="d-flex flex-column left-box">
            <!--  -->
            <div class="searchbar border-end border-3 border-dark">
                <form autocomplete="off" class="container d-flex align-items-center justify-content-center" action="prescription-view.php"
                    method="POST">
                    <div class="input-group container my-0 border-bottom border-3 border-dark py-4">
                        <input name="search" class="form-control" type="search" placeholder="Search patients by patient ID"
                            aria-label="Search" required>
                        <button class="btn btn-outline-secondary " type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>

            <div class="left-pane overflow-auto border-end border-3 border-dark ">

                <?php
                    if(!isset($_POST['search'])){
                        $sql = "SELECT * FROM `pt_record` ORDER BY Date desc limit 5";
                        
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                $pid = $row['pt_id'];
                                $sql1 = "SELECT * FROM `patient` WHERE `id`='$pid'";
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_array();
                                $name = $row1['name'];
                                $date = $row['Date'];
                                $date1=str_replace(" ","_",$date);
                                
                                echo '<div class="tab container d-flex flex-row align-items-center justify-content-center py-1  border-bottom border-2 border-dark">';
                                echo '<div class="tab container d-flex flex-column py-3">';
                                echo     '<div>';
                                echo         '<b>Patient ID: </b><span id="pid">'.$pid.'</span>';
                                echo     '</div>';
                                echo     '<div>';
                                echo         '<b>Name: </b><span id="name">'.$name.'</span>';
                                echo     '</div>';
                                echo     '<div>';
                                echo         '<b>Date: </b><span id="date">'.$date.'</span>';
                                echo     '</div>';
                                echo     '</div>';
                                echo     '<div class="fm">';
                                echo     '<form action="prescription-view.php" method="POST">';
                                echo     '<input type="hidden" value='.$date1.' name="Date">';
                                echo     '<input type="hidden" value='.$pid.'  name="pid">';
                                echo     '<input type="submit" class="btn-sm btn-primary" value="View Prescription" name="submit">';
                                echo     '</form>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        //echo print_r($_POST);
                    }
                    else if(isset($_POST['search']))
                    {
                        $pid = $_POST['search'];
                        $sql2 = "SELECT * FROM `pt_record` WHERE `pt_id`='$pid'";
                        $result2 = $conn->query($sql2);
                        if ($result2->num_rows > 0)
                        {
                            while($row2 = $result2 -> fetch_assoc()){
                                $pid = $row2['pt_id'];
                                $sql3 = "SELECT * FROM `patient` WHERE `id`='$pid'";
                                $result3 = $conn->query($sql3);
                                $row3 = mysqli_fetch_assoc($result3);
                                $name = $row3['name'];
                                $date = $row2['Date'];
                                $date1=str_replace(" ","_",$date);

                                echo '<div class="tab container d-flex flex-row align-items-center justify-content-center py-1 border-bottom border-2 border-dark">';
                                echo '<div class="tab container d-flex flex-column py-3">';
                                echo     '<div>';
                                echo         '<b>Patient ID: </b><span id="pid">'.$pid.'</span>';
                                echo     '</div>';
                                echo     '<div>';
                                echo         '<b>Name: </b><span id="name">'.$name.'</span>';
                                echo     '</div>';
                                echo     '<div>';
                                echo         '<b>Date: </b><span id="date">'.$date.'</span>';
                                echo     '</div>';
                                echo     '</div>';
                                echo     '<div class="fm">';
                                echo     '<form action="prescription-view.php" method="POST">';
                                echo     '<input type="hidden" value='.$date1.'  name="Date">';
                                echo     '<input type="hidden" value='.$pid.'  name="pid">';
                                echo     '<input type="submit" class="btn-sm btn-primary" value="View Prescription" name="submit">';
                                echo     '</form>';
                                echo '</div>';
                                echo '</div>';
                            }
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
                    if(isset($_POST['submit']))
                    {
                        $pid1 = $_POST['pid'];
                        $date2= $_POST['Date'];
                        $Date=str_replace("_"," ",$date2);
                        $sql = "SELECT * FROM `pt_record` WHERE `pt_id`='$pid1' and `Date`='$Date'";
                        $result = $conn->query($sql);
                        $row = mysqli_fetch_assoc($result);
                        $itemJson = $row['itemJson'];
                        $medJson = $row['medJson'];
                        $remJson = $row['remJson'];
                    }
                ?>
            </div>
        </div>
        <div class="right-pane overflow-auto py-3" id="divID">
            <div class="container my-2">
                <h2 style="text-align:center;">Prescription</h2>
                <div class="obs container my-5">
                    <table class="table tobs">
                        <tbody id="tableBody2">
                            
                        </tbody>
                    </table>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SNo.</th>
                            <th scope="col">Medicine</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Dosage</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
    
                    </tbody>
                </table>
            </div>
            <div class="obs container my-5">
                <table class="table text-center">
                    <tbody id="tableBody3">
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>

    medJsonArray = <?php echo $medJson; ?>;
    if(medJsonArray!=''){
    let str = '';
    tableBody = document.getElementById('tableBody2');
    
    medJsonArray.forEach((element, index) => {
        str += ` <tr>
                    <th>${element[0]}</th>
                    <td>${element[1]}</td>
                </tr>`;
    });
    tableBody.innerHTML = str;
    }

    remJsonArray = <?php echo $remJson; ?>;
    if(remJsonArray!=''){
    let str = `<tr>
                    <caption><b>Remarks </b></caption>
               </tr>`;
    tableBody = document.getElementById('tableBody3');
    
    remJsonArray.forEach((element, index) => {
        str += ` <tr>
                   <th>${index+1}</td>
                    <td class="text-start">${element[0]}</td>
                </tr>`;
    });
    tableBody.innerHTML = str;
    }

    itemJsonArray = <?php echo $itemJson; ?>;
    if(itemJsonArray!=''){
    let str1 = '';
    tableBody1 = document.getElementById('tableBody');
    
    itemJsonArray.forEach((element, index) => {
        str1 +=`<tr>
                <th scope="row">${index+1}</th>
                <td>${element[0]}</td>
                <td>${element[1]}</td>
                <td>${element[2]}</td>
                </tr>`; 
    });
    tableBody1.innerHTML = str1;
    }
    function reload() {
        window.location.reload();
    }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>