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







// $firstname = $_POST['firstname'];
// $lastname = $_POST['lastname'];
// $name = $firstname . ' ' . $lastname;
// $mail = $_POST['mail'];
// $address = $_POST['address'];
// $city = $_POST['city'];
// $state = $_POST['state'];
// $zip = $_POST['zip'];

// if (!empty($firstname) || !empty($lastname) || !empty($name) || !empty($mail) || !empty($address) || !empty($city) || !empty($state) || !empty($zip)) {
//     $host = "localhost";
//     $dbUsername = "root";
//     $dbPassword = "";
//     $dbname = "contact-form";

//     $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

//     if(mysqli_connect_error()) {
//         die('Connection Error('. mysqli_connect_errno().')'. mysqli_connect_error());
//     }
//     else {
//         $SELECT = "SELECT email FROM register WHERE email = ? Limit 1";
//         $INSERT = "INSERT Into register (name, mail, address, city, state, zip) values(?, ?, ?, ?, ?, ?)";
//     }
// }

// else {
//     echo "All fields are required";
//     die();
// }
?>