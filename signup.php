<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

// instantiate error strings
$error_status='';

// instantiate variables
$first_name='';
$last_name='';
$email='';
$phone_number='';
$address='';
$city='';
$state='';
$zip_code='';
$password='';
$c_password='';

// get strings from input fields
if(isset($_POST['submit'])) {
    $first_name=mysqli_real_escape_string($con, $_POST['fname']);
    $last_name=mysqli_real_escape_string($con, $_POST['lname']);
    $email=mysqli_real_escape_string($con, $_POST['mail']);
    $phone_number=mysqli_real_escape_string($con, $_POST['phone']);
    $address=mysqli_real_escape_string($con, $_POST['address']);
    $city=mysqli_real_escape_string($con, $_POST['city']);
    $state=mysqli_real_escape_string($con, $_POST['state']);
    $zip_code=mysqli_real_escape_string($con, $_POST['zcode']);
    $password=$_POST['pass'];
    $c_password=$_POST['cpass'];

    // if any of the login fields are empty, throws error
    if(empty($first_name) || empty($last_name) || empty($email) || empty($address) 
    || empty($city) || $state == '' || empty($zip_code) || empty($password) || empty($c_password)) {
        $error_status="<div class='error'>Please fill in all fields.</div>";
    }
    // if first name does not contain at least 3 characters, throws error
    else if(strlen($first_name)<3) {
        $error_status="<div class='error'>First name must contain at least 3 characters.</div>";
    }
    // if last name does not contain at least 3 characters, throws error
    else if(strlen($last_name)<3) {
        $error_status="<div class='error'>Last name must contain at least 3 characters.</div>";
    }
    // if email provided is not valid, throws error
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_status="<div class='error'>Email provided is invalid.</div>";
    }
    // if account with email provided already exists, throws error
    else if(email_exists($email, $con)) {
        $error_status="<div class='error'>An account already exists with the email provided.</div>";
    }
    // if password does not contain at least 8 characters, throws error
    else if(strlen($password)<8) {
        $error_status="<div class='error'>Password must contain at least 8 characters.</div>";
    }
    // if confirmed password does not match password, throws error
    else if($password!==$c_password) {
        $error_status="<div class='error'>Password provided does not match.</div>";
    }
    // if all fields are filled appropriately, insert data into database
    else {
        // encrypt the password using md5 encryption
        $password=md5($password);
        mysqli_query($con, "INSERT INTO users
            (first_name, last_name, email, phone, address, city, state, zip_code, password) 
            VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address', '$city', '$state', '$zip_code', '$password')");

        // redirect to login page
        header("location:login.php");
    }
}
 ?>

<!-- style sheet for signup page -->
<style type='text/css'>
.error {
    color:red;
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
}
.user_card {
	height: 650px;
	width: 500px;
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
.register_btn {
	width: 100%;
	background: #4B71BA !important;
	color: white !important;
}
.register_btn:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
.register_container {
    padding: 0 2rem;
}
.input-group-text {
	background: #4B71BA !important;
	color: white !important;
	border: 0 !important;
	border-radius: 0.25rem 0 0 0.25rem !important;
}
.input_first_name, .input_last_name, 
.input_email, .input_phone_number, .input_address, 
.input_city, .input_state, .input_zip_code, 
.input_pass, .input_cpass:focus {
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

<!DOCTYPE html>
<html>
    <head>
        <title>Account Registration</title>
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
                            <center><?php echo $error_status; ?></center></br>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="fname" placeholder="First Name" class="form-control input_first_name" value='<?php echo $first_name; ?>'/>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="lname" placeholder="Last Name" class="form-control input_last_name" value='<?php echo $last_name; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="mail" placeholder="Email Address" class="form-control input_email" value='<?php echo $email; ?>'/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                <input type="text" name="address" placeholder="Home Address" class="form-control input_address" value='<?php echo $address; ?>'/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="phone" placeholder="Phone Number" class="form-control input_phone_number" value='<?php echo $phone_number; ?>'/>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-building"></i></span>
                                        </div>
                                        <input type="text" name="city" placeholder="City" class="form-control input_city" value='<?php echo $city; ?>'/>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group input-group mb-2">
                                        <select class="form-control input_state" name="state" id="state">
                                            <option value=""selected disabled>State</option>
                                            <option value="AK">Alaska</option>
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="AZ">Arizona</option>
                                            <option value="CA">California</option>
                                            <option value="CO">Colorado</option>
                                            <option value="CT">Connecticut</option>
                                            <option value="DC">District of Columbia</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="HI">Hawaii</option>
                                            <option value="IA">Iowa</option>
                                            <option value="ID">Idaho</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IN">Indiana</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MD">Maryland</option>
                                            <option value="ME">Maine</option>
                                            <option value="MI">Michigan</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MO">Missouri</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MT">Montana</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="NV">Nevada</option>
                                            <option value="NY">New York</option>
                                            <option value="OH">Ohio</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="OR">Oregon</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="PR">Puerto Rico</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="TX">Texas</option>
                                            <option value="UT">Utah</option>
                                            <option value="VA">Virginia</option>
                                            <option value="VT">Vermont</option>
                                            <option value="WA">Washington</option>
                                            <option value="WI">Wisconsin</option>
                                            <option value="WV">West Virginia</option>
                                            <option value="WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" name="zcode" placeholder="Zip Code" class="form-control input_zip_code" value='<?php echo $zip_code; ?>'/>
                                    </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col xs-6 col-sm-6 col-md-6">                        
                                    <div class="input-group mb-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        </div>
                                        <input type="password" name="pass" placeholder="Password" class="form-control input_pass" value='<?php echo $password; ?>'/>
                                    </div>
                                </div>
                                <div class="col xs-6 col sm-6 col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="password" name="cpass" placeholder="Confirm Password" class="form-control input_cpass" value='<?php echo $c_password; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3 register_container">
                                <button type='submit' name='submit' class='btn register_btn'>Register</button>
                            </div>
                            <div class="mt-2">
                                <div class="d-flex justify-content-center links">
                                    <font size="2">Already have an account?</font><a href="login.php" class="ml-2"><font size="2">Login here</font></a>
                                </div>                       
                            </div>
                        </form>
                    </div>             
                </div>
            </div>
        </div>