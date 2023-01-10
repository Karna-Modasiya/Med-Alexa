let name = document.getElementById('name');
let email = document.getElementById('email');
let phone = document.getElementById('phone');

let emessage = document.querySelectorAll('.error');

let input = document.querySelectorAll('input')

function validatename(){
    let exp = /([a-zA-Z]){2,50}/;
    if(!exp.test(name.value))
    {
        console.log("Error in name");
        input[0].classList.add("is-invalid");
        input[0].classList.remove("is-valid");
    }
    else{
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
        input[2].classList.add("is-invalid");
        input[2].classList.remove("is-valid");
    }
    else{
        input[2].classList.add("is-valid");
        input[2].classList.remove("is-invalid");
        return 1;
    }
}

function validatephone(){
    let exp = /^\d{10}$/;
    if(!exp.test(phone.value))
    {
        console.log("Error in phone number");
        input[3].classList.add("is-invalid");
        input[3].classList.remove("is-valid");
    }
    else{
        input[3].classList.add("is-valid");
        input[3].classList.remove("is-invalid");
        return 1;
    }
}

function submitform()
{
    var a = validatename();
    var b = validateemail();
    var c = validatephone();
}
