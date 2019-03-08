<?php

// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
session_start();

// instantiate error strings
$error_status='';

// instantiate variables
$email='';
$password='';

// get strings from input fields
if(isset($_POST['submit'])) {
    $email=$_POST['mail'];
    $password=$_POST['pass'];
    $checkbox=isset($_POST['check']);

    // if email or password field is empty, throws error
    if(empty($email) || empty($password)) {
        $error_status='<div class="error">Please fill in all fields.</div>';
    }
    // if email provided exists
    else if(email_exists($email, $con)) {
        $pass=mysqli_query($con,"SELECT password FROM users WHERE email='$email'");
        $pass_w=mysqli_fetch_array($pass);
        $dpass=$pass_w['password'];
        $password=md5($password);

        // if password provided does not correspond to email, throws error
        if($password !== $dpass) {
            $error_status='<div class="error">Incorrect password provided.</div>';
            $password='';
        }
        // if password provided corresponds to email, redirects to profile
        else {
            $_SESSION['mail']=$email;
            if($checkbox=='on') {
                setcookie('name',$email,time()+30);
            }
            header("location:profile.php");
        }
    }
    // if email provided does not exist, throws error
    else {
        $error_status='<div class="error">Email does not exist.</div>';
        $email='';
    }
}
 ?>

<!-- style sheet for login page -->
<style type="text/css">
.error {
    color: red;
}
body, html {
	margin: 0;
	padding: 0;
	height: 100%;
	background-image: url("img/login_background.jpg") !important;
}
.user_card {
	height: 440px;
	width: 350px;
	margin-top: auto;
	margin-bottom: auto;
	background: #E9EAEE;
	position: relative;
	display: flex;
	justify-content: center;
	flex-direction: column;
	padding: 10px;
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	border-radius: 5px;
}
.brand_logo_container {
	position: absolute;
	height: 170px;
	width: 170px;
	top: -75px;
	border-radius: 50%;    
	background: #FFFFFF;
	padding: 10px;
	text-align: center;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.brand_logo {
	height: 150px;
	width: 150px;
	border-radius: 50%;
}
.form_container {
	margin-top: 100px;
}
.login_btn {
	width: 100%;
	background: #4B71BA !important;
	color: white !important;
}
.login_btn:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
.login_container {
    padding: 0 2rem;
}
.input-group-text {
	background: #4B71BA !important;
	color: white !important;
	border: 0 !important;
	border-radius: 0.25rem 0 0 0.25rem !important;
}
.input_email, .input_pass, .input_pass:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
	background-color: #4B71BA !important;
}
.custom-control {
    padding-right: 20px;
}
</style>

<html>
    <head>
        <title>Account Login</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    </head>
    <body>
        <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="img/icon.png" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form method='post'>
                            <center><h2 style="color:#555555;">Login</h2></center>
                            <center><?php echo $error_status; ?></center></br>                            
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="mail" placeholder="Email Address" class="form-control input_email" value='<?php echo $email; ?>'/>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="pass" placeholder="Password" class="form-control input_pass" value='<?php echo $password; ?>'/>
                            </div>
                            <div class="form-row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name='check' class="custom-control-input" id="customControlInline">
                                    <label class="custom-control-label" for="customControlInline"><font size="2">Remember me</font></label>
                                </div>
                                <div class="d-flex justify-content-center links">
                                    <a href="forgotPassword.php"><font size="2">Forgot your password?</font></a>
                                </div> 
                            </div>
                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type='submit' name='submit' class='btn login_btn'>Login</button>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-center links">
                                    <font size="2">Don't have an account?</font><a href="signup.php" class="ml-1"><font size="2">Register here</font></a>
                                </div>                       
                            </div>
                        </form>
                    </div>                   
                    
                </div>
            </div>
        </div>
    </body>
</html>