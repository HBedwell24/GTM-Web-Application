<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

// instantiate error strings
$error_status = '';

// instantiate variables
$email = '';
$password = '';

if(isset($_GET['key']) && isset($_GET['reset'])) {

  $email = $_GET['key'];
  $pass = $_GET['reset'];
  $select = mysqli_query($con, "SELECT email, password FROM users WHERE md5(email) = '$email' AND password = '$pass'");
}

// update the password with new password
if(isset($_POST['submit_password'])) {
  
  $email = mysqli_real_escape_string($con, $_POST['email']);
  $pass = md5($_POST['password']);
  $select = mysqli_query($con, "UPDATE users SET password = '$pass' WHERE md5(email) = '$email'");

  header("location:login.php");
}
?>

<!-- style sheet for signup page -->
<style type='text/css'>
.error {
    color:red;
}
.success {
    color:green;
}
.form-row {
    padding-bottom:15px;
}
select option {
	color:black;
}
select option:first-child {
	color:grey;
}
select option[disabled]:first-child {
	display:none;
}
body, html {
	margin: 0;
	padding: 0;
	height: 100%;
	background-image: url("img/login_background.jpg") !important;
    background-repeat: no-repeat;
    background-size: cover;
}
.user_card {
	height: 330px;
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
    margin-left: 40px;
    margin-right: 40px;
}
.submit_password_btn {
	width: 75%;
	background: #4B71BA !important;
	color: white !important;
}
.submit_password_btn:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
.submit_password_container {
    padding: 0 2rem;
}
.input-group-text {
	background: #4B71BA !important;
	color: white !important;
	border: 0 !important;
	border-radius: 0.25rem 0 0 0.25rem !important;
}
.input_password {
	box-shadow: none !important;
	outline: 0px !important;
}
</style>

<!DOCTYPE html>
<html>
    <head>
    <title>Reset Password</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <script src="js/bootstrap-formhelpers-phone.format.js"></script>
        <script src="js/bootstrap-formhelpers-phone.js"></script>
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
                            <center><h2 style="color:#555555;">Reset Password</h2></center>
                            <center><?php echo $error_status; ?></center></br>
                            <div class="input-group mb-3">
                                <input type="hidden" name="email" value='<?php echo $email; ?>'/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" placeholder="New Password" class="form-control input_password" value='<?php echo $password; ?>'/>
                            </div>
                            <div class="d-flex justify-content-center mt-1 reset_password_container">
                                <button type='submit' name='submit_password' class='btn submit_password_btn'>Reset Password</button>
                            </div>
                        </form>
                    </div>             
                </div>
            </div>
        </div>
    </body>
</html>