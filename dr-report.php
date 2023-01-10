<?php
session_start();
    if($_SESSION['dr_id']==null)
    {
        header('location: login-user.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Doctor</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        .myflex{
            width: 74vmin;
            margin: 0px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        form{
            width: 100%;
            margin: 0px auto;
        }
        .myflex input{
            width: 60vmin;
        }
        .btnflex{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .help{
            margin: auto;
        }
        .help p{
            margin: 0px;
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
                <span class="welcome me-4" style="color:white;">Welcome <?php echo $_SESSION['dr_name'];?></span>
            </div>
        </div>
    </nav>
    <div class="container my-4">
        <form autocomplete="off" >
            <div class="mb-3 myflex">
                <label for="test" class="form-label">Test</label>
                <input type="text" class="form-control input" id="test" placeholder="Test" aria-describedby="test" onclick=record(id) required>
            </div>
            <div class="mb-3 myflex">
                <label for="desc" class="form-label">Description</label>
                <input type="text" class="form-control input" id="desc" placeholder="Description (if any)" aria-describedby="desc" onclick=record(id)>
            </div>
            <div class="mb-3 btnflex">
                <div class="btncontainer">
                    <button type="submit" id="add" class="btn btn-primary">Add</button>
                    <button type="reset" id="clear" class="btn btn-primary">Clear</button>
                </div>
            </div>
            <div class="help">
                    <h6>Instructions</h6>
                    <p>1. Voice recognition will start on clicking inside the text box.</p>
                    <p>2. Make sure your mic is connected and working.</p>
                    <p>3. Description is not compulsory.</p>
                </div>
        </form>
        <div class="items my-4">
            <h2>Tests</h2>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">SNo.</th>
                    <th scope="col">Test</th>
                    <th scope="col">Description</th>
                    <th scope="col">Remove</th>
                  </tr>
                </thead>
                <tbody id="tableBody">
                  
                </tbody>
              </table>
        </div>
    </div>
    <div class="mb-1 btnflex">
        <form action="" method="POST">
            <div class=" d-flex align-items-center justify-content-center ">            
                <button type="submit" id="submitpr" name="submit" class="btn btn-primary" onclick=report()>Submit</button>
        </div>
    </form>
    </div>
    
    <script>

        function record(str)
        {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "en-US";
            recognition.maxAlternatives=10;
            recognition.onresult = function(event){
                console.log(document.getElementById(str).value = event.results[0][0].transcript);
                document.getElementById(str).value = event.results[0][0].transcript;
            }
            recognition.start();
        }

        add = document.getElementById('add');

        function getAndUpdate(){
            test = document.getElementById('test').value;
            desc = document.getElementById('desc').value;
            if(desc == "")
            {
                desc = "no description";
            }
            if(test=="")
            {

            }
            else if(sessionStorage.getItem('itemsJson')==null){
                itemJsonArray = [];
                itemJsonArray.push([test,desc]);
                sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            }
            else{
                itemJsonArrayStr = sessionStorage.getItem('itemsJson');
                itemJsonArray = JSON.parse(itemJsonArrayStr);
                itemJsonArray.push([test,desc]);
                sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            }
            update();
        }

        function update(){
            if(sessionStorage.getItem('itemsJson')==null){
                itemJsonArray = [];
                sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            }
            else{
                itemJsonArrayStr = sessionStorage.getItem('itemsJson');
                itemJsonArray = JSON.parse(itemJsonArrayStr);
            }

            let str = '';
            tableBody = document.getElementById('tableBody');
            itemJsonArray.forEach((element, index) => {
                str += `
                  <tr>
                    <th scope="row">${index+1}</th>
                    <td>${element[0]}</td>
                    <td>${element[1]}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="deleted(${index})">Delete</button></td>
                  </tr>`;
            });
            tableBody.innerHTML = str;
        }

        add.addEventListener('click',getAndUpdate);

        update();

        function deleted(itemIndex){
            itemJsonArrayStr = sessionStorage.getItem('itemsJson');
            itemJsonArray = JSON.parse(itemJsonArrayStr);
            // delete itemIndex element from array
            itemJsonArray.splice(itemIndex,1);
            sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            update();
        }

        function report(){
            itemJsonStr=sessionStorage.getItem('itemsJson');
            //const jsonString= JSON.(itemJsonStr);
            const xhr=new XMLHttpRequest();
            xhr.open("POST","receive-report.php");
            xhr.setRequestHeader("Content-type","application/json");
            sessionStorage.clear();
            xhr.send(itemJsonStr);
            <?php
            if(isset($_POST['submit'])){
                header('location: doctor.php');
            }
            ?>
        }

    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>