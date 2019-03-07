<?php
// included files
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
 ?>

<title>Forgot Password</title>
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
</style>
    <body id='body-bg'>
        <div class='container'>
            <div class='login-form col-md-5 offset-md-4'>
                <div class='jumbotron' style='margin-top:20px;padding-top:20px;padding-bottom:20px;'>
                    <h3 align='center'>Forgot Password</h3></br>
                    <form method='post'>
                    <div class='form-group'>
                    <label>Email:</label>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>