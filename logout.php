<?php
session_start();
session_destroy();
header("location:login.php");
setcookie('name','',time()-30);
?>