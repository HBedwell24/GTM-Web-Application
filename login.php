<?php

// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

// instantiate error strings
$email_status='';
$password_status='';

// instantiate variables
$email='';
$password='';

// get strings from input fields
if(isset($_POST['submit'])) {
    $email=$_POST['mail'];
    $password=$_POST['pass'];

    // if email field is empty, throws error
    if(empty($email)) {
        $email_status='<div class="error">Email field is empty.</div>';
    }
    // if password field is empty, throws error
    else if(empty($password)) {
        $password_status='<div class="error">Password field is empty.</div>';
    }
    // if email provided exists
    else if(email_exists($email, $con)) {
        $pass=mysqli_query($con,"SELECT password FROM users WHERE email='$email'");
        $pass_w=mysqli_fetch_array($pass);
        $dpass=$pass_w['password'];
        $password=md5($password);

        // if password provided does not correspond to email, throws error
        if($password!==$dpass) {
            $password_status='<div class="error">Incorrect password provided.</div';
        }
        // if password provided corresponds to email, redirects to profile
        else {
            header("location:profile.php");
        }
    }
    // if email provided does not exist, throws error
    else {
        $email_status='<div class="error">Email does not exist.</div>';
    }
}
 ?>
<title>Login Form</title>

<!-- style sheet for login page -->
<style type="text/css">
#body-bg
{
    background: url("img/services.jpg") center no-repeat fixed;
}
.error
{
    color:red;
}
 </style>
    </head>
        <body id='body-bg'>
            <div class='container'>
                <div class='login-form col-md-4 offset-md-4'>
                    <div class='jumbotron' style='margin-top:50px;padding-top:20px;padding-bottom:10px;'>
                        <h2 align='center'>Login Form</h2></br>
                        <form method='post'>
                        <div class='form-group'>
                            <label>Email Address: </label>
                            <input type='email' name='mail' class='form-control' value='<?php echo $email; ?>'/>
                            <?php echo $email_status; ?>
                        </div>
                        <div class='form-group'>
                            <label>Password: </label>
                            <input type='password' name='pass' class='form-control' value='<?php echo $password; ?>'/>
                            <?php echo $password_status; ?>
                        </div>
                        <div class='form-group'>
                            <input type='checkbox' name='check' />
                            &nbsp; Remember Me
                        </div></br>
                        <div class='form-group'>
                            <center><input type='submit' name='submit' value='Login' class='btn btn-success'/></center></br>
                            <center><a href='signup.php'>Need An Account?</a></center>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>