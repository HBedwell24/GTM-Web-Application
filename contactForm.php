<?php

if(isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $name = $fname . ' ' . $lname;
    $mailFrom = $_POST['mail'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $secretKey = "6LeZc5oUAAAAANztEF-i1pLQblo-kuVYaYCcJImg";
    $responseKey = $_POST['g-recaptcha-response'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $responseKey;
    $response = file_get_contents($url);
    $data = json_decode($response);
    if ($data -> success) {

        $mailTo = 'bedwellhb@gmail.com';
        $headers = "From: ".$mailFrom;
        $txt = $message;
        mail($mailTo, $subject, $txt, $headers);
        header("Location: index.php?mailsend");
    }
    else {
        echo "Verification failed! Please check the Captcha box below!";
    }    
}
?>