<?php
// 57.28

// included files
include("includes/header.php");
include("includes/config.php");

// instantiate error strings
$first_name_status='';
$last_name_status='';
$email_status='';
$address_status='';
$city_status='';
$state_status='';
$zip_code_status='';
$password_status='';
$c_password_status='';
$database_status='';

// instantiate variables
$firstname='';
$lastname='';
$email='';
$address='';
$city='';
$state='';
$zipcode='';
$password='';
$c_password='';

// get strings from input fields
if(isset($_POST['submit'])) {
    $firstname=$_POST['fname'];
    $lastname=$_POST['lname'];
    $email=$_POST['mail'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $zipcode=$_POST['zcode'];
    $password=$_POST['pass'];
    $c_password=$_POST['cpass'];
    // echo $firstname."</br>".$lastname."</br>".$email."</br>"
    // .$address."</br>".$city."</br>".$state."</br>".$zipcode."</br>"
    // .$password."</br>".$c_password;

    // if first name field is empty
    if(empty($firstname)) {
        $first_name_status="<div class='error'>First name field is empty.</div>";
    }
    // if first name does not contain at least 3 characters
    else if(strlen($firstname)<3) {
        $first_name_status="<div class='error'>First name must contain at least 3 characters.</div>";
    }
    // if last name field is empty
    else if(empty($lastname)) {
        $last_name_status="<div class='error'>Last name field is empty.</div>";
    }
    // if last name does not contain at least 3 characters
    else if(strlen($lastname)<3) {
        $last_name_status="<div class='error'>Last name must contain at least 3 characters.</div>";
    }
    // if email field is empty
    else if(empty($email)) {
        $email_status="<div class='error'>Email field is empty.</div>";
    }
    // if email provided is not valid
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_status="<div class='error'>Email provided is invalid.</div>";
    }
    // if address field is empty
    else if(empty($address)) {
        $address_status="<div class='error'>Address field is empty.</div>";
    }
    // if city field is empty
    else if(empty($city)) {
        $city_status="<div class='error'>City field is empty.</div>";
    }
    // if state field is empty
    else if(empty($state)) {
        $state_status="<div class='error'>State field is empty.</div>";
    }
    // if zip code field is empty
    else if(empty($zipcode)) {
        $zip_code_status="<div class='error'>Zip code field is empty.</div>";
    }
    // if password field is empty
    else if(empty($password)) {
        $password_status="<div class='error'>Password field is empty.</div>";
    }
    // if password does not contain at least 8 characters 
    else if(strlen($password)<8) {
        $password_status="<div class='error'>Password must contain at least 8 characters.</div>";
    }
    // if confirm password field is empty
    else if(empty($c_password)) {
        $c_password_status="<div class='error'>Confirm password field is empty.</div>";
    }
    // if confirmed password does not match password
    else if($password!==$c_password) {
        $c_password_status="<div class='error'>Password provided does not match.</div>";
    }
    // if all fields are filled appropriately, insert into database
    else {
        mysqli_query($con, "INSERT INTO users
            (first_name, last_name, email, address, city, state, zip_code, password) 
            VALUES ('$firstname', '$lastname', '$email', '$address', '$city', '$state', '$zipcode', '$password')");
        $database_status="<div class='success'><center>You are successfully registered!</center></div>";
    }
}
?>

<title>Registration Form</title>
</head>

<!-- style sheet for login page -->
<style type='text/css'>
#body-bg
{
    background: url("img/services.jpg") center no-repeat fixed;
}
.error
{
    color:red;
}
.success
{
    color:green;
    font-weight:bold;
}
</style>
    <body id='body-bg'>
        <div class='container'>
            <div class='login-form col-md-5 offset-md-4'>
                <div class='jumbotron' style='margin-top:20px;padding-top:20px'>
                    <h3 align='center'>Registration Form</h3></br>
                    <?php echo $successful_insertion_message; ?>
                    <form method='post' enctype="multipart/form-data">
                    <div class='form-row'>
                        <div class='col'>
                            <label>First Name:</label>
                            <input type='text' name='fname' placeholder="Your First Name" class='form-control' value='<?php echo $firstname; ?>'>
                            <?php echo $first_name_status; ?>
                        </div>
                        <div class='col'>
                            <label>Last Name:</label>
                            <input type='text' name='lname' placeholder="Your Last Name" class='form-control' value='<?php echo $lastname; ?>'>
                            <?php echo $last_name_status; ?>
                        </div>
                    </div>            
                    <div class='form-group'>
                        <label>Email Address:</label>
                        <input type='email' name='mail' placeholder="Your Email" class='form-control' value='<?php echo $email; ?>'>
                        <?php echo $email_status; ?>
                    </div>
                    <div class='form-group'>
                        <label>Address:</label>
                        <input type='text' name='address' placeholder="Your Address" class='form-control' value='<?php echo $address; ?>'>
                        <?php echo $address_status; ?>
                    </div>
                    <div class='form-row'>
                        <div class='col'>
                            <label>City:</label>
                            <input type='text' name='city' placeholder="Your City" class='form-control' value='<?php echo $city; ?>'>
                            <?php echo $city_status; ?>
                        </div>
                        <div class='col'>
                            <label>State:</label>
                            <input type='text' name='state' placeholder="Your State" class='form-control' value='<?php echo $state; ?>'>
                            <?php echo $state_status; ?>
                        </div>
                        <div class='col'>
                            <label>Zip Code:</label>
                            <input type='text' name='zcode' placeholder="Your Zip Code" class='form-control' value='<?php echo $zipcode; ?>'>
                            <?php echo $zip_code_status; ?>
                        </div>
                    </div>           
                    <div class='form-group'>
                        <label>Password:</label>
                        <input type='password' name='pass' placeholder="Password" class='form-control' value='<?php echo $password; ?>'>
                        <?php echo $password_status; ?>
                    </div>
                    <div class='form-group'>
                        <label>Confirm Password:</label>
                        <input type='password' name='cpass' placeholder="Confirm Password" class='form-control' value='<?php echo $c_password; ?>'>
                        <?php echo $c_password_status; ?>
                    </div>
                    <center><input type='submit' value='Submit' name='submit' class='btn btn-success'/></center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>