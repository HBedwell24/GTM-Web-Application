<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");

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
    $firstname=mysql_real_escape_string($_POST['fname']);
    $lastname=mysql_real_escape_string($_POST['lname']);
    $email=mysql_real_escape_string($_POST['mail']);
    $address=mysql_real_escape_string($_POST['address']);
    $city=mysql_real_escape_string($_POST['city']);
    $state=mysql_real_escape_string($_POST['state']);
    $zipcode=mysql_real_escape_string($_POST['zcode']);
    $password=$_POST['pass'];
    $c_password=$_POST['cpass'];

    // if first name field is empty, throws error
    if(empty($firstname)) {
        $first_name_status="<div class='error'>First name field is empty.</div>";
    }
    // if first name does not contain at least 3 characters, throws error
    else if(strlen($firstname)<3) {
        $first_name_status="<div class='error'>First name must contain at least 3 characters.</div>";
    }
    // if last name field is empty, throws error 
    else if(empty($lastname)) {
        $last_name_status="<div class='error'>Last name field is empty.</div>";
    }
    // if last name does not contain at least 3 characters, throws error
    else if(strlen($lastname)<3) {
        $last_name_status="<div class='error'>Last name must contain at least 3 characters.</div>";
    }
    // if email field is empty, throws error
    else if(empty($email)) {
        $email_status="<div class='error'>Email field is empty.</div>";
    }
    // if email provided is not valid, throws error
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_status="<div class='error'>Email provided is invalid.</div>";
    }
    // if account with email provided already exists, throws error
    else if(email_exists($email, $con)) {
        $email_status="<div class='error'>An account already exists with the email provided.</div>";
    }
    // if address field is empty, throws error
    else if(empty($address)) {
        $address_status="<div class='error'>Address field is empty.</div>";
    }
    // if city field is empty, throws error
    else if(empty($city)) {
        $city_status="<div class='error'>City field is empty.</div>";
    }
    // if state field is empty, throws error
    else if(empty($state)) {
        $state_status="<div class='error'>State field is empty.</div>";
    }
    // if zip code field is empty, throws error
    else if(empty($zipcode)) {
        $zip_code_status="<div class='error'>Zip code field is empty.</div>";
    }
    // if password field is empty, throws error
    else if(empty($password)) {
        $password_status="<div class='error'>Password field is empty.</div>";
    }
    // if password does not contain at least 8 characters, throws error
    else if(strlen($password)<8) {
        $password_status="<div class='error'>Password must contain at least 8 characters.</div>";
    }
    // if confirm password field is empty, throws error
    else if(empty($c_password)) {
        $c_password_status="<div class='error'>Confirm password field is empty.</div>";
    }
    // if confirmed password does not match password, throws error
    else if($password!==$c_password) {
        $c_password_status="<div class='error'>Password provided does not match.</div>";
    }
    // if all fields are filled appropriately, insert data into database
    else {
        // encrypt the password using md5 encryption
        $password=md5($password);
        mysqli_query($con, "INSERT INTO users
            (first_name, last_name, email, address, city, state, zip_code, password) 
            VALUES ('$firstname', '$lastname', '$email', '$address', '$city', '$state', '$zipcode', '$password')");
        $database_status="<div class='success'><center>You are successfully registered!</center></div>";

        // redirect to login page
        header("location:login.php");
    }
}
 ?>

<title>Account Registration</title>
</head>

<!-- style sheet for signup page -->
<style type='text/css'>
#body-bg {
    background: url("img/services.jpg") center no-repeat fixed;
}
.error {
    color:red;
}
.success {
    color:green;
    font-weight:bold;
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
</style>
    <body id='body-bg'>
        <div class='container'>
            <div class='login-form col-md-5 offset-md-4'>
                <div class='jumbotron' style='margin-top:20px;padding-top:20px;padding-bottom:20px;'>
                    <h3 align='center'>Account Registration</h3></br>
                    <?php echo $database_status; ?>
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
                        <div class="form-group">
	                        <label for="state" class="col-sm-2 control-label">State</label>
	                        <div class="col-sm-10">
		                        <select class="form-control" id="state" name="state">
                                    <option value=""selected disabled>Please select</option>
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
                    <center><input type='submit' value='Submit' name='submit' class='btn btn-success'/></center></br>
                    <center><a href='login.php'>Already Have An Account? Login Here</a></center>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>