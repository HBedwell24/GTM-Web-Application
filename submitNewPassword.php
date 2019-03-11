<?php
// included files
include("includes/config.php");

// update the password with new password
if(isset($_POST['submit_password']) && $_POST['key'] && $_POST['reset'])
{
  $email=$_POST['email'];
  $pass=$_POST['password'];
  $select=mysqli_query("UPDATE users SET password='$pass' WHERE email='$email'");
}
?>