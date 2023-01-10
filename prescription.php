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
    <title>Prescription</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <style>
        .myflex{
            width: 45vmin;
            margin: 0px auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .myflex1{
            width: 60vmin;
        }
        form{
            width: 100%;
            margin: 0px auto;
        }
        .myflex input{
            width: 35vmin;
        }
        .myflex1 input{
            width: 35vmin;
        }
        .btnflex{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .igt1{
            width: 115px;
        }
        .igt2{
            width: 80px;
        }
        .t2{
            width: 30vw;
        }
        .help p{
            margin: 0px;
        }
        .txta{
            width: 40vw; 
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="doctor.php" onclick="clearSession()">
                <!-- <img src="med3.png" alt="" width="50" height="30" class="d-inline-block align-text-top"> -->
                <i class="bi bi-arrow-left-circle-fill"></i>
                Back
            </a>
        </div>
    </nav>
    <div class="container">
        <div class="top d-flex justify-content-around my-5">
            <div class="left-box">
                <div class="mb-3 myflex">
                    <label for="medicine" class="form-label">Medicine</label>
                    <input type="text" class="form-control input" id="medicine" name="medicine" placeholder="Medicine" aria-describedby="medicine" onclick=record(id) required>
                </div>
                <div class="mb-3 myflex">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control input" id="quantity" name="quantity" placeholder="Quantity" aria-describedby="quantity" onclick=record(id) required>
                </div>
                <div class="mb-3 myflex">
                    <label for="dosage" class="form-label">Dosage</label>
                    <input type="text" class="form-control input" id="dosage" name="dosage" placeholder="Dosage ex: 101" aria-describedby="dosage" onclick=record(id) required>
                </div>
                <div class="mb-3 btnflex">
                    <div class="btncontainer">
                        <button type="submit" id="add" name="add" class="btn btn-primary">Add</button>
                    </div>
                </div>
                <div class="help">
                    <h6>Instructions</h6>
                    <p>1. Voice recognition will start on clicking inside the text box.</p>
                    <p>2. Make sure your mic is connected and working.</p>
                    <p>3. Above 3 fields are compulsory.</p>
                </div>
            </div>
            <div class="right-box">
                <div class="myflex1">
                    <div class="input-group mb-3">
                        <span class="igt1 input-group-text">BP</span>
                        <input type="number" class="form-control input" id="bptop" name="bptop" placeholder="high" aria-describedby="bptop" onclick=record(id) required>
                        <input type="number" class="form-control input" id="bpbottom" name="bpbottom" placeholder="low" aria-describedby="bpbottom" onclick=record(id) required>
                        <span class="igt2 input-group-text" id="basic-addon2">mm Hg</span>
                        <button type="button" id="bp" name="add" class="btn btn-primary" onclick=getAndUpdate2(id)>Add</button>
                    </div>
                </div>
                <div class="myflex1">
                    <div class="input-group mb-3">
                        <span class="igt1 input-group-text">Temperature</span>
                        <input type="number" class="form-control input" id="temperature" name="temperature" placeholder="in deg F" aria-describedby="temperature" onclick=record(id) required>
                        <span class="igt2 input-group-text" id="basic-addon2">deg F</span>
                        <button type="button" id="temp" name="add" class="btn btn-primary" onclick=getAndUpdate2(id)>Add</button>
                    </div>
                </div>
                <div class="myflex1">
                    <div class="input-group mb-3">
                        <span class="igt1 input-group-text">Sugar</span>
                        <input type="number" class="form-control input" id="sugar" name="sugar" placeholder="in mg/dL" aria-describedby="sugar" onclick=record(id) required>
                        <span class="igt2 input-group-text" id="basic-addon2">mg/dL</span>
                        <button type="button" id="sug" name="add" class="btn btn-primary" onclick=getAndUpdate2(id)>Add</button>
                    </div>
                </div>
                <div class="help">
                    <p>These fields are not compulsory</p>
                </div>
            </div>
        </div>
        <div>
            <div class="items my-5">
                <h2>Prescription</h2>
                <div class="t2 my-5">
                    <table class="table">
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
                        <th scope="col">Remove</th>
                      </tr>
                    </thead>
                    <tbody id="tableBody">
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container txta">
        <!-- <label for="exampleFormControlInput1" class="form-label"><b>Disease Identified (if any)</b></label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Disease"> -->
        <div class="input-group my-5">
            <span class="igt1 input-group-text">Remark</span>
            <input type="text" class="form-control input" id="remark" name="remark" placeholder="if any"  onclick=record(id) required>
            <button type="button" id="temp" name="add" class="btn btn-primary" onclick=getAndUpdate3(id)>Add</button>
        </div>
    </div>
    <div class="container my-5 txta">
        <table class="table text-center">
            <tbody id="tableBody3">
                
            </tbody>
        </table>
    </div>
    <div class="mb-1 btnflex">
        <form action="prescription.php" method="POST">
        <div class=" d-flex align-items-center justify-content-center ">
            <button type="submit" id="submitpr" name="submit" class="btn btn-primary" onclick=prescription()>Submit</button>
        </div>
    </form>
    </div>
    
    <script>
        clearSession();
        function record(str)
        {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "en-US";
            recognition.maxAlternatives=1;
            recognition.onresult = function(event){
                console.log(document.getElementById(str).value = event.results[0][0].transcript);
                document.getElementById(str).value = event.results[0][0].transcript;
            }
            recognition.start();
        }

        add = document.getElementById('add');
        btnbp = document.getElementById('bp');
        btntemp = document.getElementById('temp');
        btnsugar = document.getElementById('sug');

        medJsonArray = [];
        sessionStorage.setItem('medJson', JSON.stringify(medJsonArray));

        function getAndUpdate3(){
            rem = document.getElementById('remark').value;
            if(rem=="")
            {

            }
            else if(sessionStorage.getItem('remJson')==null){
                remJsonArray = [];
                remJsonArray.push([rem]);
                sessionStorage.setItem('remJson', JSON.stringify(remJsonArray));
            }
            else{
                remJsonArrayStr = sessionStorage.getItem('remJson');
                remJsonArray = JSON.parse(remJsonArrayStr);
                remJsonArray.push([rem]);
                sessionStorage.setItem('remJson', JSON.stringify(remJsonArray));
            }
            document.getElementById('remark').value = "";
            update3();
        }

        function getAndUpdate2(btnid){
            xbptop = document.getElementById('bptop').value;
            xbpbottom = document.getElementById('bpbottom').value;
            xtemperature = document.getElementById('temperature').value;
            xsugar = document.getElementById('sugar').value;
            if(btnid=="bp" && (xbptop!=0 && xbpbottom!=0))
            {
                console.log("bp");
                medJsonArrayStr = sessionStorage.getItem('medJson');
                medJsonArray = JSON.parse(medJsonArrayStr);
                medJsonArray.push(["BP",`${xbptop} mm Hg / ${xbpbottom} mm Hg`]);
                sessionStorage.setItem('medJson', JSON.stringify(medJsonArray));
            }
            else if(btnid=="temp" && xtemperature!=0)
            {
                console.log("temp");
                medJsonArrayStr = sessionStorage.getItem('medJson');
                medJsonArray = JSON.parse(medJsonArrayStr);
                medJsonArray.push(["Temperature",`${xtemperature} deg F`]);
                sessionStorage.setItem('medJson', JSON.stringify(medJsonArray));
            }
            else if(btnid=="sug" && xsugar!=0)
            {
                console.log("sug");
                medJsonArrayStr = sessionStorage.getItem('medJson');
                medJsonArray = JSON.parse(medJsonArrayStr);
                medJsonArray.push(["Sugar",`${xsugar} mg/dL`]);
                sessionStorage.setItem('medJson', JSON.stringify(medJsonArray));
            }
            document.getElementById('bptop').value = "";
            document.getElementById('bpbottom').value = "";
            document.getElementById('temperature').value = "";
            document.getElementById('sugar').value = "";
            update2();
        }

        function getAndUpdate(){
            med = document.getElementById('medicine').value;
            quant = document.getElementById('quantity').value;
            dos = document.getElementById('dosage').value;
            if(med=="" || quant=="" || dos=="")
            {

            }
            else if(sessionStorage.getItem('itemsJson')==null){
                itemJsonArray = [];
                itemJsonArray.push([med,quant,dos]);
                sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            }
            else{
                itemJsonArrayStr = sessionStorage.getItem('itemsJson');
                itemJsonArray = JSON.parse(itemJsonArrayStr);
                itemJsonArray.push([med,quant,dos]);
                sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            }
            document.getElementById('medicine').value = "";
            document.getElementById('quantity').value = "";
            document.getElementById('dosage').value = "";
            update();
        }

        function update3(){
            if(sessionStorage.getItem('remJson')==null){
                remJsonArray = [];
                sessionStorage.setItem('remJson', JSON.stringify(remJsonArray));
            }
            else{
                remJsonArrayStr = sessionStorage.getItem('remJson');
                remJsonArray = JSON.parse(remJsonArrayStr);
            }

            let str = '';
            tableBody = document.getElementById('tableBody3');
            remJsonArray.forEach((element, index) => {
                str += `
                  <tr>
                    <td scope="row">${index+1}</th>
                    <td class="text-start">${element[0]}</td>
                    <td><button class="btn btn-sm btn-primary" id="${index+1}" onclick="deleted3(${index})">Delete</button>
                    </td>
                  </tr>`;
            });
            tableBody.innerHTML = str;
            console.log(remJsonArray);
        }

        function update2(){
            let str = '';
            tableBody = document.getElementById('tableBody2');
            medJsonArrayStr = sessionStorage.getItem('medJson');
            medJsonArray = JSON.parse(medJsonArrayStr);
            medJsonArray.forEach((element, index) => {
                str += `
                  <tr>
                    <th scope="row">${element[0]}</th>
                    <td>${element[1]}</td>
                    <td><button class="btn btn-sm btn-primary" id="${index+1}" onclick="deleted2(${index})">Delete</button></td>
                  </tr>`;
            });
            tableBody.innerHTML = str;
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
                    <th id="i${index+1}" scope="row">${index+1}</th>
                    <td id="m${index+1}">${element[0]}</td>
                    <td id="q${index+1}">${element[1]}</td>
                    <td id="d${index+1}">${element[2]}</td>
                    
                    <td><button class="btn btn-sm btn-primary" id="${index+1}" onclick="deleted(${index})">Delete</button></form>
                    </td>
                  </tr>`;
            });
            tableBody.innerHTML = str;
        }

        add.addEventListener('click',getAndUpdate);

        update();

        update2();

        update3();

        function deleted3(itemIndex){
            var index=itemIndex;
            console.log('deleted', itemIndex);
            remJsonArrayStr = sessionStorage.getItem('remJson');
            remJsonArray = JSON.parse(remJsonArrayStr);
            // delete itemIndex element from array
            remJsonArray.splice(itemIndex,1);
            sessionStorage.setItem('remJson', JSON.stringify(remJsonArray));
            update3();
        }

        function deleted2(itemIndex){
            medJsonArrayStr = sessionStorage.getItem('medJson');
            medJsonArray = JSON.parse(medJsonArrayStr);
            medJsonArray.splice(itemIndex,1);
            sessionStorage.setItem('medJson', JSON.stringify(medJsonArray));
            update2();
        }

        function deleted(itemIndex){
            var index=itemIndex;
            console.log('deleted', itemIndex);
            itemJsonArrayStr = sessionStorage.getItem('itemsJson');
            itemJsonArray = JSON.parse(itemJsonArrayStr);
            // delete itemIndex element from array
            itemJsonArray.splice(itemIndex,1);
            sessionStorage.setItem('itemsJson', JSON.stringify(itemJsonArray));
            update();
        }
        
        function prescription()
        {
            itemJsonStr=sessionStorage.getItem('itemsJson');
            console.log(itemJsonStr);
            medJson=sessionStorage.getItem('medJson');
            console.log(medJson);
            remJson=sessionStorage.getItem('remJson');
            console.log(remJson);
            // remJson=sessionStorage.getItem('remJson');
            // console.log(remJson);

            obj1 = {1: medJson, 2: itemJsonStr,3: remJson};
            Obj=JSON.stringify(obj1);
            if(itemJsonStr!=[])
            {
                const xhr=new XMLHttpRequest();
                xhr.open("POST","receive.php");
                xhr.setRequestHeader("Content-type","application/json");
                xhr.send(Obj);
            }

            clearSession();

        }
        function clearSession(){
            sessionStorage.clear();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        
</body>

</html>