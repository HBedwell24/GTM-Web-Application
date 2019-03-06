<?php
// checks if account already exists in database with email provided
function email_exists($email,$con) {
    $row=mysqli_query($con,"SELECT id FROM users WHERE mail='$email'");
    {
        if(mysqli_num_rows($row)==1) {
            return true;
        }
        else {
            return false;
        }
    }
}
 ?>