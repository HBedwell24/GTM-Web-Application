<?php
// 57.28
// instantiate error strings
$first_name_error='';
$last_name_error='';
$email_error='';
$password_error='';
$mismatched_password_error='';

include("includes/header.php");

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

    // if first name does not contain at least 5 characters
    if(strlen($firstname)<3) {
        $first_name_error="<div class='error'>First name must contain at least 3 characters.</div>";
    }

    // if last name does not contain at least 5 characters
    else if(strlen($lastname)<3) {
        $last_name_error="<div class='error'>Last name must contain at least 3 characters.</div>";
    }

    // if email provided is not valid
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error="<div class='error'>Email provided is invalid.</div>";
    }

    // if password does not contain at least 8 characters 
    else if(strlen($password)<8) {
        $password_error="<div class='error'>Password must contain at least 8 characters.</div>";
    }

    // if confirmed password does not match password
    else if($password!==$c_password) {
        $mismatched_password_error="<div class='error'>Password provided does not match.</div>";
    }
}
?>

<title>Registration Form</title>
</head>
<style type='text/css'>
#body-bg
{
    background: url("img/services.jpg") center no-repeat fixed;
}
.error
{
    color:red;
}
</style>
    <body id='body-bg'>
        <div class='container'>
            <div class='login-form col-md-5 offset-md-4'>
                <div class='jumbotron' style='margin-top:20px;padding-top:20px'>
                    <h3 align='center'>Registration Form</h3></br>
                    <form method='post' enctype="multipart/form-data">
                    <div class='form-row'>
                        <div class='col'>
                            <label>First Name:</label>
                            <input type='text' name='fname' placeholder="Your First Name" class='form-control'>
                            <?php echo $first_name_error; ?>
                        </div>
                        <div class='col'>
                            <label>Last Name:</label>
                            <input type='text' name='lname' placeholder="Your Last Name" class='form-control'>
                            <?php echo $last_name_error; ?>
                        </div>
                    </div>            
                    <div class='form-group'>
                        <label>Email Address:</label>
                        <input type='email' name='mail' placeholder="Your Email" class='form-control'>
                        <?php echo $email_error; ?>
                    </div>
                    <div class='form-group'>
                        <label>Address:</label>
                        <input type='text' name='address' placeholder="Your Address" class='form-control'>
                    </div>
                    <div class='form-row'>
                        <div class='col'>
                            <label>City:</label>
                            <input type='text' name='city' placeholder="Your City" class='form-control'>
                        </div>
                        <div class='col'>
                            <label>State:</label>
                            <input type='text' name='state' placeholder="Your State" class='form-control'>
                        </div>
                        <div class='col'>
                            <label>Zip Code:</label>
                            <input type='text' name='zcode' placeholder="Your Zip Code" class='form-control'>
                        </div>
                    </div>           
                    <div class='form-group'>
                        <label>Password:</label>
                        <input type='password' name='pass' placeholder="Password" class='form-control'>
                        <?php echo $password_error; ?>
                    </div>
                    <div class='form-group'>
                        <label>Confirm Password:</label>
                        <input type='password' name='cpass' placeholder="Confirm Password" class='form-control'>
                        <?php echo $mismatched_password_error; ?>
                    </div>
                    <center><input type='submit' value='Submit' name='submit' class='btn btn-success'/></center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>