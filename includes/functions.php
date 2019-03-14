<?php
// checks if account already exists in database with email provided
function email_exists($email,  $con) {
    $row=mysqli_query($con, "SELECT id FROM users WHERE email='$email'");
    {
        if(mysqli_num_rows($row)==1) {
            return true;
        }
        else {
            return false;
        }
    }
}

// checks if user is currently logged into account
function logged_in() {
    if(isset($_SESSION['mail']) || isset($_COOKIE['name'])) {
        return false;
    }
    else {
        return true;
    }
}

// checks if password request has been sent to account
function passwordRequestSent() {
    if(isset($_GET['key']) && isset($_GET['reset'])) {
        return true;
    }
    else {
        return false;
    }
}
?>