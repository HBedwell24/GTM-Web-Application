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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <style type="text/css">

li,ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.home {
    background: #f6f7fa;
}

#navigation {
    background: #0e1a35;
}

#navigation {
    padding: 0;
}

.display-table {
    display: table;
    padding: 0;
    height: 100%;
    width: 100%;
}

.display-table-row {
    display: table-row;
    height: 100%;
}

.display-table-cell {
    display: table-cell;
    float: none;
    height: 100%;
}

.v-align {
    vertical-align: top;
}
.logo img {
    max-width: 50px;
    padding: 16px 0 17px;
    width: 100%;
}

.header-top {
    margin: 0;
    padding-top: 2px;
}

.header-top img {
    border-radius: 50%;
    max-width: 48px !important;
    width: 100%;
}

.add-project {
    background: #5584ff none repeat scroll 0 0;
    border-radius: 100px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 27px 10px 45px;
    position: relative;
}

.header-rightside .nav > li > a:focus,
.header-rightside .nav > li > a:hover {
    background: none;
    text-decoration: none;
}

.add-project::before {
    background: rgba(0, 0, 0, 0) url("../images/plus.png") no-repeat scroll 0 0;
    content: "";
    ;
    height: 12px;
    left: 17px;
    position: absolute;
    top: 12px;
    width: 12px;
}

.add-project:hover {
    color: #ffffff;
}

.header-top i {
    color: #0e1a35;
}

.icon-info {
    position: relative;
}
.navi i {
    font-size: 20px;
}
.label.label-primary {
    border-radius: 50%;
    font-size: 9px;
    left: 8px;
    position: absolute;
    top: -9px;
}

.icon-info .label {
    border: 2px solid #ffffff;
    font-weight: 500;
    padding: 3px 5px;
    text-align: center;
}

.header-top li {
    display: inline-block;
    text-align: center;
}

.header-top .dropdown-toggle {
    color: #0e1a35;
}

.header-top .dropdown-menu {
    border: medium none;
    left: -85px;
    padding: 17px;
}
.view {
    background: #5584ff none repeat scroll 0 0;
    border-radius: 100px;
    color: #ffffff;
    display: inline-block;
    font-size: 14px;
    font-weight: 600;
    margin-top: 10px;
    padding: 10px 15px;
}

.navbar-content > span {
    font-size: 13px;
    font-weight: 700;
}

.img-responsive {
    width: 100%;
}
#navigation{
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}
.search input {
    border: none;
    font-size: 15px;
    padding: 15px 9px;
    width: 100%;
    background: rgba(0, 0, 0, 0) url("../images/search.png") no-repeat scroll 99% 12px;
    color: #8492af;
}

header {
    background: #ffffff none repeat scroll 0 0;
    box-shadow: 0 1px 12px rgba(0, 0, 0, 0.04);
    display: inline-block !important;
    line-height: 23px;
    padding: 15px;
    transition: all 0.5s ease 0s;
    width: 100%;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.logo {
    text-align: center;
}

.navi a {
    border-bottom: 1px solid #0d172e;
    border-top: 1px solid #0d172e;
    color: #ffffff;
    display: block;
    font-size: 17px;
    font-weight: 500;
    padding: 28px 20px;
    text-decoration: none;
}

.navi i {
    margin-right: 15px;
    color: #4b7aba;
}

.navi .active a {
    background: #122143;
    border-left: 5px solid #4b7aba;
    padding-left: 15px;
}

.navi a:hover {
    background: #122143 none repeat scroll 0 0;
    border-left: 5px solid #4b7aba;
    display: block;
    padding-left: 15px;
}

.navbar-default {
    background-color: #ffffff;
    border-color: #ffffff;
}

.navbar-toggle {
    border: none;
}

.navbar-default .navbar-toggle:focus,
.navbar-default .navbar-toggle:hover {
    background-color: rgba(0, 0, 0, 0);
}

.navbar-default .navbar-toggle .icon-bar {
    background-color: #0e1a35;
}

.circle-logo {
    margin: 0 auto;
    max-width: 30px !important;
    text-align: center;
}
.hidden-xs{
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

.user-dashboard {
    padding: 0 20px;
}

.user-dashboard h1 {
    color: #0e1a35;
    font-size: 30px;
    font-weight: 500;
    margin: 0;
    padding: 21px 0;
}
.sales {
    background: #ffffff none repeat scroll 0 0;
    border: 1px solid #d4d9e3;
    display: inline-block;
    padding: 15px;
    width: 100%;
}
.sales button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 1px solid #dadee7;
    border-radius: 100px;
    font-size: 15px;
    letter-spacing: 0.5px;
    padding-right: 32px;
    color: #0e1a35;
}

.sales button::before {
    content: "";
    font-family: FontAwesome;
    position: absolute;
    right: 12px;
    top: 11px;
}
.sales  .btn-group {
    float: right;
}
.sales h2 {
    color: #8492af;
    float: left;
    font-size: 21px;
    font-weight: 600;
    margin: 0;
    padding: 9px 0 0;
}
.btn.btn-secondary.btn-lg.dropdown-toggle > span {
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 0.5px;
}
.sales .dropdown-menu{
    margin: 0px;
    padding: 0px;
    border: 0px;
    border-radius: 8px;
    width: 100%;
    color: #0e1a35;
}
.sales .btn-group.open .dropdown-toggle, .btn.active, .btn:active{
    box-shadow: none;
}
.sales .dropdown-menu > a {
    color: #0e1a35;
    display: inline-block;
    font-weight: 800;
    padding: 9px 0;
    text-align: center;
    width: 100%;
}
#my-cool-chart svg {
    width: 100%;
}
.sales .dropdown-menu > a:hover{
    color: #5584FF;   
}
.shield-buttons {
    display: none;
}
.close, .close:focus, .close:hover {
    color: #fff;;
    opacity: 1;
    text-shadow: none;
}
.modal-body input {
    border: 1px solid #d4d9e3;
    font-size: 14px;
    font-weight: 300;
    margin: 5px 0;
    padding: 14px 10px;
    width: 100%;
    color: #8492af;
}
.modal-body textarea {
    border: 1px solid #d4d9e3;
    font-size: 14px;
    font-weight: 300;
    height: 200px;
    margin-top: 5px;
    padding: 9px 10px;
    width: 100%;
    color: #8492af;
}
.modal-header.login-header h4 {
    color: #ffffff;
}
.modal-footer .add-project {
    background: #5584ff none repeat scroll 0 0;
    border: medium none;
    border-radius: 100px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 30px;
    position: relative;
}
.modal-footer .add-project::before{display: none;}
.modal-footer {
    border: 0 none;
    padding: 10px 15px 26px;
    text-align: right;
}
.cancel {
    background: #0E1A35     ;
    border: medium none;
    border-radius: 100px;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    padding: 10px 30px;
    position: relative;
    
}
.modal{
    top: 20%; 
}
.modal-header .close {
    margin-top: 2px;
}
.search input:focus{
    border-bottom: 1px solid #BDC4D4;
    line-height:22px;
    transition: 0.1s all;
}
.modal-header.login-header {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

@media only screen and (max-device-width: 767px) {
    .login-logo img {
        margin: 0 auto;
    }
    .login-details .nav-tabs > li {
        text-align: center;
        width: 50%;
    }
    .login-signup .login-inner h1 {
        font-size: 26px;
        margin-bottom: 0;
        margin-top: 10px;
    }
    .login-inner .login-form input {
        font-size: 15px;
        max-width: 100%;
        padding: 15px 45px;
    }
    .login-inner .form-details {
        padding: 25px;
    }
    .login-inner .login-form label {
        margin-bottom: 20px;
        width: 100%;
    }
    .login-inner .form-btn {
        margin: 0;
        max-width: 180px;
    }
    .tab-content .tab-pane {
        padding: 20px 0;
    }
    #navigation .navi a {
        font-size: 14px;
        padding: 20px;
        text-align: center;
    }
    #navigation .navi i {
        margin-right: 0px;
    }
    #navigation .navi a:hover,
    #navigation .navi .active a {
        background: #122143 none repeat scroll 0 0;
        border-left: none;
        display: block;
        padding-left: 20px;
    }
    header .header-top img {
        max-width: 38px !important;
    }
    .v-align header {
        padding: 12px 15px;
    }
    header .header-top li {
        padding-left: 13px;
        padding-right: 6px;
    }
    .navbar-default .navbar-toggle {
        border-color: rgba(0, 0, 0, 0);
    }
    .navbar-header .navbar-toggle {
        float: left;
        margin: 0;
        padding: 0;
        top: 12px;
    }
    button,html [type="button"],[type="reset"],[type="submit"] {
        outline: medium none;
    }
    .user-dashboard .sales h2 {
        color: #8492af;
        float: left;
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        padding: 13px 0 0;
    }
    .user-dashboard .btn.btn-secondary.btn-lg.dropdown-toggle > span {
        font-size: 11px;
    }
    .user-dashboard .sales button {
        font-size: 11px;
        padding-right: 23px;
    }  
    .user-dashboard .sales h2 {
        font-size: 12px;
    }
    .gutter{
        padding: 0;
    }
}

@media only screen and (max-device-width: 992px) {
    header .header-top li {
        padding-left: 20px !important;
        padding-right: 0;
    }
    header .logo img {
        max-width: 125px !important;
    }
}

@media only screen and (min-device-width: 767px) and (max-device-width: 998px){
    .user-dashboard .header-top {
        padding-top: 5px;
    }
    .user-dashboard .header-rightside {
        display: inline-block;
        float: left;
        width: 100%;
    }
    .user-dashboard .header-rightside .header-top img {
        max-width: 41px !important;
    } 
    .user-dashboard .sales button {
    font-size: 10px;
    }
    .user-dashboard .btn.btn-secondary.btn-lg.dropdown-toggle > span {
    font-size: 12px;
    }
    .user-dashboard .sales h2 {
    font-size: 15px;
    }
}

@media only screen and (min-device-width:998px) and (max-device-width: 1350px){
    #navigation .logo img {
        max-width: 130px;
        padding: 16px 0 17px;
        width: 100%;
    }
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo">
                    <a href="index.php"><img src="img/icon.png" alt="merkery_logo" class="hidden-xs hidden-sm">
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class="active"><a href="profile.php"><i class="fa fa-tachometer" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></li>
                        <li><a href="calendar.php"><i class="fa fa-calendar" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Calendar</span></a></li>
                        <li><a href="#"><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Jobs</span></a></li>
                        <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Messages</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align">
                <!--<button type="button" class="slide-toggle">Slide Toggle</button> -->
                <div class="row">
                    <header>
                        <div class="col-md-7">
                            <nav class="navbar-default pull-left">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                            </nav>
                            <div class="search hidden-xs hidden-sm">
                                <input type="text" placeholder="Search" id="search">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="header-rightside">
                                <ul class="list-inline header-top pull-right">
                                    <a href='logout.php'><button class='btn btn-outline-success' style='float: right; background: #4B71BA !important; color: white !important;'>Logout</button></a>
                                </ul>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                    
                    <div class="container-fluid">
                    <h1>Hello, <?php echo ucfirst($firstname)." ".ucfirst($lastname) ?>!</h1>
                        <div class="row">
                            <div class="col-md-6 col-sm-5 gutter">
                                <div class="sales">
                                    <h2>First Block</h2>
                                    <br>
                                    <br>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-5 gutter">
                                <div class="sales">
                                    <h2>Second Block</h2>
                                    <br>
                                    <br>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 gutter">
                                <div class="sales">
                                    <h2>Third block</h2>
                                    <br>
                                    <br>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_project" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header login-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add Project</h4>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Project Title" name="name">
                    <input type="text" placeholder="Post of Post" name="mail">
                    <input type="text" placeholder="Author" name="passsword">
                    <textarea placeholder="Desicrption"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="cancel" data-dismiss="modal">Close</button>
                    <button type="button" class="add-project" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
</body>
<?php
}
?>