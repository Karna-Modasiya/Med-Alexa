
<?php 
session_start();
$con = mysqli_connect('localhost', 'root', '', 'medalexa');
// $_SESSION['info']= "";
$errors = array();

//if user click on signup button
if(isset($_POST['signup'])){
    $type = $_POST['inputUser'];
    $name = $_POST['inputName'];
    $email = $_POST['inputEmail'];
    $phone = $_POST['inputPhone'];
    $password = $_POST['inputPassword'];
    $cpassword = $_POST['RePassword'];
    $Dtype =  $_POST['inputDtype'];

    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }

    if($type == 'doctor')
        $ptype="DR";
    else if($type == 'operator')
        $ptype="OP";
    else if($type == 'pharmacist')
        $ptype="PH";
    else
        $ptype="PA";
    
    $email_check = "SELECT * FROM $type WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }

    if(count($errors) === 0){
        $id=$ptype.chr(rand(97,122)).chr(rand(97,122)).rand(0,9).rand(0,9);
        $from="team.medalexa@gmail.com";
        $fromName="Team Med-Alexa";
        $subject="OTP for registration to Med-Alexa";
        $otp=rand(99999,999999);
        $headers="Content-Type: text/html; charset=UTF-8\r\n";
        $message="<h4> Dear <b>$name</b>,<br><br>\tYour One Time Password (OTP) for registration in Med-Alexa is <b style='color: blue;'>$otp</b>.</h4><br>
        <h4>Do not share this OTP with anyone.<br><br>Team Med-alexa</h4>";
        if(mail($email, $subject, $message, $headers)){
            $info = "We've sent a verification code to your email - '$email'";
            echo $type;
            $_SESSION['type'] = $type;
            $_SESSION['Dtype'] = $Dtype;
            $_SESSION['info'] = $info;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['name'] = $name;
            $_SESSION['phone'] = $phone;
            $_SESSION['otp'] = $otp; 
            header('location: user-otp.php');
            exit();
        }
        else{
            $errors['otp-error'] = "Failed while sending code!";
        }
    }
}

//if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $type = $_SESSION['type'];
        $id = $_SESSION['id'];
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $phone = $_SESSION['phone'];
        $password = $_SESSION['password'];
        $Dtype =  $_SESSION['Dtype'];
        $entered_otp = $_POST['otp'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        if($entered_otp == $_SESSION['otp'])
        {
            $_SESSION['info'] = "You have been Succcesfully Verified";  
            if($type == 'doctor')
            {
                $insert_data = "INSERT INTO $type (`id`, `speci`, `name`, `email`, `phone`, `pass`, `dt`) VALUES ('$id', '$Dtype', '$name', '$email', '$phone', '$encpass', current_timestamp())";
            }
            else{
                $insert_data = "INSERT INTO $type (`id`, `name`, `email`, `phone`, `pass`, `dt`) VALUES ('$id', '$name', '$email', '$phone', '$encpass', current_timestamp())";
            }
            $data_check = mysqli_query($con, $insert_data);
            if (!$data_check) {
                $errors['db-error'] = "Data not inserted!";
            }
            else{
                $from="Team Med-Alexa";
                $fromName="Team Med-Alexa";
                $subject="Greetings From Med-Alexa";
                $otp=rand(99999,999999);
                $headers="Content-Type: text/html; charset=UTF-8\r\n";
                $message=" <h4 style='color: white;'>Welcome, $name <br><br></h4>
                <h4 style='color: white;'>You have succesfully Registered yourself to Med-Alexa.<br><br></h4>
                <h4 style='color: blue;'><b>Your ID </b> : $id<br></h4>
                <h4>For any Quries, Suggestions, or technical issue you can write us <b>team.medalexa@gmail.com</b><br></h4>";
                if(mail($email, $subject, $message, $headers)){
                    $info = "We've sent a verification code to your email - '$email'";
                }
                if($type=="doctor")
                {
                    header('location: doctor.php');
                    exit();
                }
                else if($type=="operator")
                {
                    header('location: operator.php');
                    exit();
                }
                else if($type=="pharmacist")
                {
                    header('location: pharmacist.php');
                }
                else
                {
                    header('location: pathologist.php');
                }
                // header('location: operator.php');
                exit();
            }
        }
        else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $user = $_POST['user'];
        
        $check_id = "SELECT * FROM $user WHERE id = '$userid'";
        $res = $con->query($check_id);
        // $res = mysqli_query($con,$check_id);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_array($res);
            $fetch_pass = $fetch['pass'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['type'] = $user;
                $_SESSION['id'] = $userid;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $fetch['email'];
                $_SESSION['name'] = $fetch['name'];
                $_SESSION['phone'] = $fetch['phone'];
                $_SESSION['info'] = '';
                if($user=="doctor")
                {
                    $_SESSION['Dtype'] = $fetch['speci'];
                    header('location: doctor.php');
                    exit();
                }
                else if($user=="operator")
                {
                    header('location: operator.php');
                    exit();
                }
                else if($user=="pharmacist")
                {
                    header('location: pharmacist.php');
                    exit();
                }
                else
                {
                    header('location: pathologist.php');
                    exit();
                }
                // header('location: doctor.php');
                
            }
            else
            {   
                $errors['password'] = "You Entered wrong password.";
            }
        }
        else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $id = $_POST['uid'];
        $user = $_POST['user'];
        echo $user;
        // $check_email = "SELECT * FROM $user WHERE email = '$email'";
        $check_id = "SELECT * FROM $user WHERE id = '$id'";
        $res = mysqli_query($con, $check_id);
        if(mysqli_num_rows($res) > 0)
        {
            $fetch = mysqli_fetch_assoc($res);
            $email = $fetch['email'];
                $otp = rand(999999, 111111);
                $subject = "Password Reset Code";
                $message = "<h4><br>\tYour One Time Password (OTP) for Password Reset in Med-Alexa is <b style='color: blue;'>$otp</b>.</h4><br>
                <h4>Do not share this OTP with anyone.<br><br>Team Med-alexa</h4>";
                $sender = "From: team.medalexa@gmail.com";
                $headers="Content-Type: text/html; charset=UTF-8\r\n";
                if(mail($email, $subject, $message, $headers)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['id'] = $id;
                    $_SESSION['type'] = $user;
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['otp'] = $otp;
                    header('location: reset-code.php');
                    exit();
                }
                else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
        }
        else{
            $errors['email'] = "This user id does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $formotp = $_POST['otp'];
        $genotp = $_SESSION['otp'];
        if($formotp == $genotp){
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }
        else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $user = $_SESSION['type'];
        $id = $_SESSION['id'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
        else{
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE $user SET pass = '$encpass' WHERE id = '$id'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: login-user.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    if(isset($_POST['patient-otp']))
    {
        $ptype = 'PT';
        $name = $_POST['Name'];
        $email = $_POST['Email'];
        $phone = $_POST['Phone'];
        $dob = $_POST['Dob'];
        $gender = $_POST['Gender'];
        $email_check = "SELECT * FROM `patient` WHERE email = '$email'";
        $res = mysqli_query($con, $email_check);
        if(mysqli_num_rows($res) > 0){
            $errors['email'] = "Email that you have entered is already exist!";
        }
        if(count($errors) === 0){
            $id=$ptype.chr(rand(97,122)).chr(rand(97,122)).rand(0,9).rand(0,9);
            $otp=rand(99999,999999);
            $sender="team.medalexa@gmail.com";
            $subject="OTP for Patient Registration to Med-Alexa";
            $message="<h4> Dear <b>$name</b>,<br><br>\tYour One Time Password (OTP) for registration in Med-Alexa is <b style='color: blue;'>$otp</b>.</h4><br>
            <h4>Do not share this OTP with anyone.<br><br>Team Med-alexa</h4>";
            $headers="Content-Type: text/html; charset=UTF-8\r\n";
            if(mail($email, $subject, $message, $headers)){
                $info = "We've sent a verification code to your email - '$email'";
                $_SESSION['info'] = $info;
                $_SESSION['pid'] = $id;
                $_SESSION['pemail'] = $email;
                $_SESSION['pname'] = $name;
                $_SESSION['pphone'] = $phone;
                $_SESSION['dob'] = $dob;
                $_SESSION['gender'] = $gender;
                $_SESSION['otp'] = $otp; 
                header('location: patient-otp.php');
                exit();
            }
            else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
    }  
?>