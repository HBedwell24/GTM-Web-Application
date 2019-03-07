<?php

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname . ' ' . $lname;
    $mailFrom = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mailTo = 'bedwellhb@gmail.com';
    $headers = "From: ".$mailFrom;
    $txt = $message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: index.php?mailsend");
}
?>