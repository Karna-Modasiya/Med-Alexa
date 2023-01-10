let name = document.getElementById('inputname');
let pass = document.getElementById('inputPassword');
let repass = document.getElementById('RePassword');
let email = document.getElementById('inputemail');
let phone = document.getElementById('inputPhone');

let emessage = document.querySelectorAll('.error');
 
let input = document.querySelectorAll('input')


function validatename(){
    let exp = /([a-zA-Z]){2,50}/;
    if(!exp.test(name.value))
    {
        console.log("Error in name");
        emessage[0].style.display = "block";
        input[0].classList.add("is-invalid");
        input[0].classList.remove("is-valid");
    }
    else{
        emessage[0].style.display = "none";
        input[0].classList.add("is-valid");
        input[0].classList.remove("is-invalid");
        return 1;
    }
}

function validateemail(){
    let exp = /^([a-zA-Z0-9\.\-\_]+)@([a-zA-Z0-9]+)\.([a-zA-Z\.]){2,8}$/;
    if(!exp.test(email.value))
    {
        console.log("Error in email");
        emessage[1].style.display = "block";
        input[1].classList.add("is-invalid");
        input[1].classList.remove("is-valid");
    }
    else{
        emessage[1].style.display = "none";
        input[1].classList.add("is-valid");
        input[1].classList.remove("is-invalid");
        return 1;
    }
}

function validatephone(){
    let exp = /^\d{10}$/;
    if(!exp.test(phone.value))
    {
        console.log("Error in phone number");
        emessage[2].style.display = "block";
        input[2].classList.add("is-invalid");
        input[2].classList.remove("is-valid");
    }
    else{
        emessage[2].style.display = "none";
        input[2].classList.add("is-valid");
        input[2].classList.remove("is-invalid");
        return 1;
    }
}

function validatepass(){
    let exp1 = /^(?=.*[a-z])/;
    let exp2 = /^(?=.*[A-Z])/;
    let exp3 = /^(?=.*[0-9])/;
    let exp4 = /^(?=.*[!@#\$%\^&\*])/;
    if(!exp1.test(pass.value) || !exp2.test(pass.value) || !exp3.test(pass.value) || !exp4.test(pass.value) || String(pass.value).length < 6)
    {
        console.log("Error in password");
        emessage[3].style.display = "block";
        input[3].classList.add("is-invalid");
        input[3].classList.remove("is-valid");
        if(!exp1.test(pass.value))
            emessage[3].innerText = "password must contain 1 small case letter";
        else if(!exp2.test(pass.value))
            emessage[3].innerText = "password must contain 1 upper case letter";
        else if(!exp3.test(pass.value))
            emessage[3].innerHTML = "password must contain 1 numerical number";
        else if(!exp4.test(pass.value))
            emessage[3].innerHTML = "password must contain 1 special character";
        else if(String(pass.value).length < 6)
            emessage[3].innerHTML = "password lenght must be greater tham 6";
    }
    else{
        emessage[3].style.display = "none";
        input[3].classList.add("is-valid");
        input[3].classList.remove("is-invalid");
        return 1;
    }
}

function validaterepass(){
    if(repass.value!=pass.value || pass.value == "")
    {
        console.log("Confirm Password not Matched");
        emessage[4].style.display = "block";
        input[4].classList.add("is-invalid");
        input[4].classList.remove("is-valid");
    }
    else{
        emessage[4].style.display = "none";
        input[4].classList.add("is-valid");
        input[4].classList.remove("is-invalid");
        return 1;
    }
}

function submitform()
{
    var a = validatename();
    var b = validateemail();
    var c = validatephone();
    var d = validatepass();
    var e = validaterepass();
}

var user = document.getElementById("inputuser");
    var block = document.getElementById("specification");
    setInterval(function() {
        if (user.value == "doctor") {
            console.log(user.value);
            block.style.display = "block";
        } 
        else {
            block.style.display = "none";
        }
    }, 100);