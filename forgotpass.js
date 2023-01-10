let pass = document.getElementById('pass');
let repass = document.getElementById('repass');

let emessage = document.querySelectorAll('.error');
 
let input = document.querySelectorAll('input')

function validatepass(){
    let exp1 = /^(?=.*[a-z])/;
    let exp2 = /^(?=.*[A-Z])/;
    let exp3 = /^(?=.*[0-9])/;
    let exp4 = /^(?=.*[!@#\$%\^&\*])/;
    if(!exp1.test(pass.value) || !exp2.test(pass.value) || !exp3.test(pass.value) || !exp4.test(pass.value) || String(pass.value).length < 6)
    {
        console.log("Error in password");
        emessage[0].style.display = "block";
        input[0].classList.add("is-invalid");
        input[0].classList.remove("is-valid");
        if(!exp1.test(pass.value))
            emessage[0].innerText = "password must contain 1 small case letter";
        else if(!exp2.test(pass.value))
            emessage[0].innerText = "password must contain 1 upper case letter";
        else if(!exp3.test(pass.value))
            emessage[0].innerHTML = "password must contain 1 numerical number";
        else if(!exp4.test(pass.value))
            emessage[0].innerHTML = "password must contain 1 special character";
        else if(String(pass.value).length < 6)
            emessage[0].innerHTML = "password lenght must be greater tham 6";
    }
    else{
        emessage[0].style.display = "none";
        input[0].classList.add("is-valid");
        input[0].classList.remove("is-invalid");
        return 1;
    }
}

function validaterepass(){
    if(repass.value!=pass.value || pass.value == "")
    {
        console.log("Confirm Password not Matched");
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

function submitform()
{
    var a = validatepass();
    var b = validaterepass();
    console.log("Yes");
    if(a==1 && b==1)
    {
        exit();
    }
    else
    {
        document.getElementById("newpass").submit();
    }
}
