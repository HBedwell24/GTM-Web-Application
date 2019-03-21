<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

// instantiate error strings
$error_status = '';

// instantiate variables
$email = '';

// get strings from input fields
if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['mail']);

    // if any of the reset password fields are empty, throws error
    if(empty($email)) {
        $error_status = "<div class='error'>Please fill in all fields.</div>";
    }
    // if email provided does not exist, throws error
    else if(!email_exists($email, $con)) {
        $error_status = "<div class='error'>Email provided is not associated with any account.</div>";
    }
    // if all fields are filled appropriately, send reset password link to email
    else {
        $select = mysqli_query($con, "SELECT first_name, last_name, email, password FROM users WHERE email='$email'");

        if(mysqli_num_rows($select) == 1) {

            while($row = mysqli_fetch_array($select)) {
                // encrypt both email and password
                $email = md5($row['email']);
                $pass = md5($row['password']);
                $recipient_email = $row['email'];
                $recipient_name = '' .$row['first_name']. ' ' .$row['last_name']. '';
            }
            $dir = 'localhost/GTM-Web-Application-V2/';
            $link = '' .$dir. 'resetPassword.php?key=' .$email. '&reset=' .$pass. '';
            require_once('PHPMailer/PHPMailerAutoload.php');
            $mail = new PHPMailer();
            $mail->CharSet = "utf-8";
            $mail->isSMTP();
            // enable SMTP authentication
            $mail->SMTPAuth = true;                  
            // GMAIL username
            $mail->Username = "";
            // GMAIL password
            $mail->Password = "";
            $mail->SMTPSecure = "ssl";  
            // sets GMAIL as the SMTP server
            $mail->Host = "smtp.gmail.com";
            // set the SMTP port for the GMAIL server
            $mail->Port = "465";
            $mail->From = '';
            $mail->FromName = '';
            $mail->AddAddress($recipient_email, $recipient_name);
            $mail->Subject = 'Reset Password';
            $mail->IsHTML(true);
            $mail->Body = 'Hello ' .$recipient_name. ', Click on this link to reset password: <a href="'.$link.'">' .$link.'</a>';
            if($mail->Send()) {
                $error_status = "<div class='success'>Check your email for link to reset password.</div>";
            }
            else {
                $error_status = "<div class='error'>Mail error -> $mail->ErrorInfo</div>";
            }
        }	
    }
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
.reset_password_btn {
	width: 100%;
	background: #4B71BA !important;
	color: white !important;
}
.reset_password_btn:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
.reset_password_container {
    padding: 0 2rem;
}
.input-group-text {
	background: #4B71BA !important;
	color: white !important;
	border: 0 !important;
	border-radius: 0.25rem 0 0 0.25rem !important;
}
.input_email {
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
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="mail" placeholder="Email Address" class="form-control input_email" value='<?php echo $email; ?>'/>
                            </div>
                            <div class="d-flex justify-content-center mt-1 reset_password_container">
                                <button type='submit' name='submit' class='btn reset_password_btn'>Send Request</button>
                            </div>
                        </form>
                    </div>             
                </div>
            </div>
        </div>
    </body>
</html>