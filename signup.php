<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

// instantiate error strings
$error_status = '';

// instantiate defaut user state
$default_access = 'user';

// instantiate variables
$first_name = '';
$last_name = '';
$email = '';
$phone_number = '';
$address = '';
$city = '';
$state = '';
$zip_code = '';
$password = '';
$c_password = '';

// get strings from input fields
if(isset($_POST['submit'])) {
    // prepare input fields for database insertion
    $stmt = $con->prepare("INSERT INTO verify
        (first_name, last_name, email, phone, address, city, state, zip_code, user_type, password, code) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['mail'];
    $phone_number = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zcode'];
    $password = $_POST['pass'];
    $c_password = $_POST['cpass'];

    // if any of the login fields are empty, throws error
    if(empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($address) 
    || empty($city) || empty($state) || empty($zip_code) || empty($password) || empty($c_password)) {
        $error_status = "<div class='error' id='status'>Please fill in all fields.</div>";
    }
    // if first name does not contain at least 3 characters, throws error
    else if(strlen($first_name) < 3) {
        $error_status = "<div class='error' id='status'>First name must contain at least 3 characters.</div>";
    }
    // if last name does not contain at least 3 characters, throws error
    else if(strlen($last_name) < 3) {
        $error_status = "<div class='error' id='status'>Last name must contain at least 3 characters.</div>";
    }
    // if email provided is not valid, throws error
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_status = "<div class='error' id='status'>Email provided is invalid.</div>";
    }
    // if account with email provided already exists, throws error
    else if(email_exists($email, $con)) {
        $error_status = "<div class='error' id='status'>An account already exists with the email provided.</div>";
    }
    // if password does not contain at least 8 characters, throws error
    else if(strlen($password) < 8) {
        $error_status = "<div class='error' id='status'>Password must contain at least 8 characters.</div>";
    }
    // if confirmed password does not match password, throws error
    else if($password !== $c_password) {
        $error_status = "<div class='error' id='status'>Password provided does not match.</div>";
    }
    // if all fields are filled appropriately, insert data into database
    else {
        // encrypt the verification code using md5 encryption
        $code = substr(md5(mt_rand()), 0, 15);

        // encrypt the password using md5 encryption
        $hashed_password = md5($password);

        // bind input fields for database insertion
        $stmt->bind_param("sssssssssss", $first_name, $last_name, $email, $phone_number, $address, $city, $state, $zip_code, $default_access, $hashed_password, $code);
        
        // insert fields into verify database
        $stmt->execute();
        $db_id = mysqli_insert_id($con);
        $stmt->close();

        // generate email recipient name
        $recipient_name = '' .$first_name. ' ' .$last_name. '';
        $recipient_email = $email;

        // generate link to reset password
        $dir = 'www.gtm-services.com/';
        $link = ''.$dir. 'signup.php?id=' .$db_id. '&code=' .$code.'';

        // import PHPMailer library for sending SMTP mail
        require_once('PHPMailer/PHPMailerAutoload.php');

        // instantiate a new PHPMailer
        $mail = new PHPMailer;
        $mail->CharSet = "utf-8";

        // tell PHPMailer to use SMTP mail
        $mail->isSMTP();

        // set sender email address
        $mail->setFrom('gtmservicesnaples@gmail.com', 'GTM Home Services');

        // set recipient email address
        $mail->addAddress($recipient_email, $recipient_name);

        // Amazon SES SMTP user name
        $mail->Username = 'SMTP_Username';

        // Amazon SES SMTP password
        $mail->Password = 'SMTP_Password';

        // the region of the email host
        $mail->Host = 'email-smtp.us-west-2.amazonaws.com';

        // the subject line of the email
        $mail->Subject = 'Activation code for gtmwebservices.com';

        // the HTML-formatted body of the email
        $mail->Body = 'Your activation code is '.$code.'. Please click on this link to activate your account: <a href="'.$link.'">'.$link.'</a>';

        // tell PHPMailer to use SMTP authentication
        $mail->SMTPAuth = true;

        // enable SSL encryption over port 465
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // tells PHPMailer to send HTML-formatted email
        $mail->isHMTL(true);

        // if error occurs in sending mail, throws error
        if(!$mail->send()) {
            $error_status = "<div class='error' id='status'>Email not sent. -> $mail->ErrorInfo</div>";
        }
        // if mail is sent successfully, throw success message
        else {
            $error_status = "<div class='success' id='status'>Please check your email for an account activation code.</div>";
        }
    }
}

// verify the user using id and activation code
if(isset($_GET['id']) && isset($_GET['code'])) {
	$id = $_GET['id'];
    $code = $_GET['code'];
    $stmt = $con->prepare("SELECT first_name, last_name, email, phone, address, city, state, zip_code, user_type, password FROM verify WHERE id = ? AND code = ?");
    $stmt->bind_param("is", $id, $code);
    $stmt->execute();
    $select = $stmt->get_result();
    
	if(mysqli_num_rows($select) == 1) {

		while($row = mysqli_fetch_array($select)) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $phone_number = $row['phone'];
            $address = $row['address'];
            $city = $row['city'];
            $state = $row['state'];
            $zip_code = $row['zip_code'];
            $user_type = $row['user_type'];
            $password = $row['password'];
        }
        
        // insert fields into users database
        $stmt = $con->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssssssss", $id, $first_name, $last_name, $email, $phone_number, $address, $city, $state, $zip_code, $user_type, $password);
        $stmt->execute();
        $stmt->close();
        
        // delete fields from verify database, since user is now verified
        $stmt = $con->prepare("DELETE FROM verify WHERE id = ? AND code = ?");
        $stmt->bind_param("ss", $id, $code);
        $stmt->execute();
        $stmt->close();
        
        // redirect to login page
        header("location:login.php");
    }    
    $stmt->close();
}

function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
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
	height: auto;
	width: auto;
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
.register_btn {
	width: 40%;
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
.input_first_name, .input_last_name, 
.input_email, .input_phone_number, .input_address, 
.input_city, .input_state, .input_zip_code, 
.input_pass, .input_cpass:focus {
	box-shadow: none !important;
	outline: 0px !important;
}
label {
    color: #4B71BA;
    font-weight: bold;
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <title>Account Registration</title>
        <link href = "//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel = "stylesheet" id = "bootstrap-css">
        <script src = "//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src = "//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel = "stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity = "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <link rel = "stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity = "sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <script src = "js/bootstrap-formhelpers-phone.format.js"></script>
        <script src = "js/bootstrap-formhelpers-phone.js"></script>
    </head>
    <body>
        <div class = "container h-100">
            <div class = "d-flex justify-content-center h-100">
                <div class = "user_card">
                    <div class = "d-flex justify-content-center">
                        <div class = "brand_logo_container">
                            <img src = "img/icon.png" class = "brand_logo" alt = "Logo">
                        </div>
                    </div>
                    <div class = "d-flex justify-content-center form_container">
                        <form method = 'post'>
                            <center><h2 style = "color:#555555;">Register</h2></center>
                            <center><?php echo $error_status; ?></center></br>
                            <div class = "row">
                                <div class = "col-xs-6 col-sm-6 col-md-6">
                                    <label>First Name*</label>    
                                    <div class = "input-group mb-2">                        
                                        <input type = "text" name = "fname" placeholder = "At least 3 characters" class = "form-control input_first_name" value = '<?php echo $first_name; ?>'/>
                                    </div>
                                </div>
                                <div class = "col-xs-6 col-sm-6 col-md-6">
                                    <label>Last Name*</label>   
                                    <div class = "input-group mb-3"> 
                                        <input type = "text" name = "lname" placeholder = "At least 3 characters" class = "form-control input_last_name" value = '<?php echo $last_name; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <label>Email Address*</label>   
                            <div class = "input-group mb-3">                         
                                <input type = "text" name = "mail" placeholder = "Email Address" class = "form-control input_email" value = '<?php echo $email; ?>'/>
                            </div>
                            <label>Phone Number*</label> 
                            <div class = "input-group mb-3"> 
                                <input type = "tel" name = "phone" placeholder = "Phone Number" class = "form-control bfh-phone" data-format = "(ddd) ddd-dddd" value = '<?php echo $phone_number; ?>'/>
                            </div>
                            <label>Home Address*</label> 
                            <div class = "input-group mb-3">
                                <input type = "text" name = "address" placeholder = "Home Address" class = "form-control input_address" value = '<?php echo $address; ?>'/>
                            </div>
                            <div class = "row">
                                <div class = "col-xs-4 col-sm-4 col-md-4">
                                    <label>City*</label>   
                                    <div class = "input-group mb-3">
                                        <input type = "text" name = "city" placeholder = "City" class = "form-control input_city" value = '<?php echo $city; ?>'/>
                                    </div>
                                </div>
                                <div class = "col-xs-4 col-sm-4 col-md-4">
                                    <label>State*</label>   
                                    <div class = "form-group input-group mb-2">
                                        <select class = "form-control input_state" name = "state" id = "state">
                                            <option value = ""selected>State</option>
                                            <option value = "AK">Alaska</option>
                                            <option value = "AL">Alabama</option>
                                            <option value = "AR">Arkansas</option>
                                            <option value = "AZ">Arizona</option>
                                            <option value = "CA">California</option>
                                            <option value = "CO">Colorado</option>
                                            <option value = "CT">Connecticut</option>
                                            <option value = "DC">District of Columbia</option>
                                            <option value = "DE">Delaware</option>
                                            <option value = "FL">Florida</option>
                                            <option value = "GA">Georgia</option>
                                            <option value = "HI">Hawaii</option>
                                            <option value = "IA">Iowa</option>
                                            <option value = "ID">Idaho</option>
                                            <option value = "IL">Illinois</option>
                                            <option value = "IN">Indiana</option>
                                            <option value = "KS">Kansas</option>
                                            <option value = "KY">Kentucky</option>
                                            <option value = "LA">Louisiana</option>
                                            <option value = "MA">Massachusetts</option>
                                            <option value = "MD">Maryland</option>
                                            <option value = "ME">Maine</option>
                                            <option value = "MI">Michigan</option>
                                            <option value = "MN">Minnesota</option>
                                            <option value = "MO">Missouri</option>
                                            <option value = "MS">Mississippi</option>
                                            <option value = "MT">Montana</option>
                                            <option value = "NC">North Carolina</option>
                                            <option value = "ND">North Dakota</option>
                                            <option value = "NE">Nebraska</option>
                                            <option value = "NH">New Hampshire</option>
                                            <option value = "NJ">New Jersey</option>
                                            <option value = "NM">New Mexico</option>
                                            <option value = "NV">Nevada</option>
                                            <option value = "NY">New York</option>
                                            <option value = "OH">Ohio</option>
                                            <option value = "OK">Oklahoma</option>
                                            <option value = "OR">Oregon</option>
                                            <option value = "PA">Pennsylvania</option>
                                            <option value = "PR">Puerto Rico</option>
                                            <option value = "RI">Rhode Island</option>
                                            <option value = "SC">South Carolina</option>
                                            <option value = "SD">South Dakota</option>
                                            <option value = "TN">Tennessee</option>
                                            <option value = "TX">Texas</option>
                                            <option value = "UT">Utah</option>
                                            <option value = "VA">Virginia</option>
                                            <option value = "VT">Vermont</option>
                                            <option value = "WA">Washington</option>
                                            <option value = "WI">Wisconsin</option>
                                            <option value = "WV">West Virginia</option>
                                            <option value = "WY">Wyoming</option>
                                        </select>
                                    </div>
                                </div>
                                <div class = "col-xs-4 col-sm-4 col-md-4">
                                    <label>Zip Code*</label>   
                                    <div class = "input-group mb-3">
                                        <input type = "text" name = "zcode" placeholder = "Zip Code" class = "form-control input_zip_code" pattern = "[0-9]{5}" value = '<?php echo $zip_code; ?>'/>
                                    </div>
                                </div>
                            </div>  
                            <div class = "row">
                                <div class = "col xs-6 col-sm-6 col-md-6">  
                                    <label>Password*</label>                       
                                    <div class = "input-group mb-2">
                                        <input type = "password" name = "pass" placeholder = "At least 8 characters" class = "form-control input_pass" value = '<?php echo $password; ?>'/>
                                    </div>
                                </div>
                                <div class = "col xs-6 col sm-6 col-md-6">
                                    <label>Confirm Password*</label>   
                                    <div class = "input-group mb-3">
                                        <input type = "password" name = "cpass" placeholder = "Confirm Password" class = "form-control input_cpass" value = '<?php echo $c_password; ?>'/>
                                    </div>
                                </div>
                            </div>
                            <div class = "d-flex justify-content-center mt-1 register_container">
                                <button type = 'submit' name = 'submit' class = 'btn register_btn'>Register</button>
                            </div>
                            <div class = "mt-2">
                                <div class = "d-flex justify-content-center links">
                                    <font size = "2">Already have an account?</font><a href = "login.php" class="ml-1"><font size = "2">Login here</font></a>
                                </div>                       
                            </div>
                        </form>
                    </div>             
                </div>
            </div>
        </div>
    </body>
</html>