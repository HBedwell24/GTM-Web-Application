<?php
include("includes/header.php");
include("includes/config.php");
session_start();
include("includes/functions.php");


if(logged_in()) {
    header("location:login.php");
}

else if(isset($_COOKIE['name'])) {

    $email=$_COOKIE['name'];
    $result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$email'");
    $retrieve=mysqli_fetch_array($result);
    $firstname=$retrieve['first_name'];
    $lastname=$retrieve['last_name'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="js/main.js"></script>

    <style type="text/css">

    body {
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    .header {
        position:absolute;
        height: 44px;
        width:100%;
        background-color: #999;
        z-index: 4;
    }

    .side-nav {
        position: absolute;
        width: 100%;
        background-color: #666;
        height: 100vh;
        z-index: 3;
        padding-top: 44px;
    }

    .side-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .side-nav ul li {
        padding: 20px 10px;
        border-bottom: 1px solid #333;
    }

    .side-nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .side-nav ul li i {
        color: #333;
    }

    .main-content {
        padding-top: 44px;
    }
    
    @media screen and (min-width: 600px) {
        .side-nav {
            width: 80px;
        }
        .side-nav ul li {
            text-align: center;
        }
        .side-nav ul li span:nth-child(2) {
            display: none;
        }
        .side-nav ul li i {
            font-size: 26px;
        }

        .main-content {
            margin-left: 80px;
        }
    }
    @media screen and (min-width: 1000px) {
        .side-nav {
            width: 200px;
        }
        .side-nav ul li {
            text-align: left;
        }
        .side-nav ul li span:nth-child(2) {
            display: inline;
        }
        .side-nav ul li i {
            font-size: 16px;
        }
        .main-content {
            margin-left: 200px;
        }
    }

    </style>
    </head>
    <body>
    <div class="header">
        <a href="#" class="nav-trigger"><span></span></a>
    </div>

    <div class="side-nav">
        <nav>
            <ul>
                <li class="active">
                    <a href="#">
                        <span><i class="fa fa-user"></i></span>
                        <span>Users</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="fa fa-envelope"></i></span>
                        <span>Messages</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="fa fa-bar-chart"></i></span>
                        <span>Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="fa fa-credit-card-alt"></i></span>
                        <span>Payments</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h2 align='center'>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?>!</h2>
        <a href='logout.php'><button class='btn btn-outline-success' style='float: right; margin-top: 20px;'>Logout</button></a>
    </div>
    </body>
    </html>
    <?php
}

else {

    $email=$_SESSION['mail'];
    $result=mysqli_query($con,"SELECT first_name,last_name FROM users WHERE email='$email'");
    $retrieve=mysqli_fetch_array($result);
    $firstname=$retrieve['first_name'];
    $lastname=$retrieve['last_name'];
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="js/main.js"></script>

    <style type="text/css">

    body {
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    .header {
        position: absolute;
        height: 44px;
        width:100%;
        background-color: #4FA7E7;
        z-index: 4;
    }

    .side-nav {
        position: absolute;
        width: 100%;
        background-color: #4B71BA;
        height: 100vh;
        z-index: 3;
        padding-top: 44px;
        display: inline-block;
    }

    .side-nav .fa {
        padding-left: 10px;
    }

    .side-nav .vertical-tab {
        padding-left: 15px;
    }

    .side-nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .side-nav ul li {
        padding: 20px 10px;
        border-bottom: 1px solid #333;
    }

    .side-nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    .side-nav ul li i {
        color: #4FA7E7;
    }

    .container {
        padding-top: 44px;
        background-color: #efefef;
        display: inline-block;
        width: 100%;
    }

    .main-content {
        background-color: #fff;
        width: 100%;
    }
    
    @media screen and (min-width: 600px) {
        .side-nav {
            width: 80px;
        }
        .side-nav ul li {
            text-align: center;
        }
        .side-nav ul li span:nth-child(2) {
            display: none;
        }
        .side-nav ul li i {
            font-size: 26px;
        }

        .main-content {
            margin-left: 80px;
        }
    }

    @media screen and (min-width: 1000px) {
        .side-nav {
            width: 200px;
        }
        .side-nav ul li {
            text-align: left;
        }
        .side-nav ul li span:nth-child(2) {
            display: inline;
        }
        .side-nav ul li i {
            font-size: 16px;
        }
        .main-content {
            margin-left: 200px;
        }
    }

    </style>
    </head>
    <body>
    <div class="header">
        <a href="index.php" class="nav-trigger"><span>GTM Home Services</span></a>
    </div>

    <div class="side-nav">
        <nav>
            <ul>
                <li class="active">
                    <a href="profile.php">
                        <span><i class="fa fa-user"></i></span>
                        <span class="vertical-tab">Home</span>
                    </a>
                </li>
                <li>
                    <a href="schedule.php">
                        <span><i class="fa fa-envelope"></i></span>
                        <span class="vertical-tab">Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="fa fa-bar-chart"></i></span>
                        <span class="vertical-tab">Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><i class="fa fa-credit-card-alt"></i></span>
                        <span class="vertical-tab">Payments</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container">
        <div class="main-content">
            <h2>Welcome <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?>!</h2>
            <a href='logout.php'><button class='btn btn-outline-success' style='float: right; margin-top: 20px;'>Logout</button></a>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>