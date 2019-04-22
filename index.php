<?php

	include("includes/config.php");

	$fname = '';
	$lname = '';
	$mailFrom = '';
	$subject = '';
	$message = '';

	$error_status1 = '';
	$error_status2 = '';
	$error_status3 = '';
	$error_status4 = '';
	$error_status5 = '';
	$error_status6 = '';

	$success_message = '';

	if(isset($_POST['submit'])) {
		$fname = mysqli_real_escape_string($con, $_POST['fname']);
		$lname = mysqli_real_escape_string($con, $_POST['lname']);
		$mailFrom = mysqli_real_escape_string($con, $_POST['mail']);
		$subject = mysqli_real_escape_string($con, $_POST['subject']);
		$message = mysqli_real_escape_string($con, $_POST['message']);

		$secretKey = "6Lfed5wUAAAAAPDdjHEoT4GTaTOesZ1_uxjTZblK";
		$responseKey = $_POST['g-recaptcha-response'];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" .$secretKey. "&response=" .$responseKey;

		$response = file_get_contents($url);
		$data = json_decode($response);

		if(empty($fname)) {
			$error_status1 = "First name is empty.";
		}

		else if(empty($lname)) {
			$error_status2 = "Last name is empty.";
		}

		else if(empty($mailFrom)) {
			$error_status3 = "Email is empty.";
		}

		else if(!empty($mailFrom) && filter_var($mailFrom, FILTER_VALIDATE_EMAIL) === false) {
			$error_status3 = "Email provided is invalid.";
		}

		else if(empty($subject)) {
			$error_status4 = "Subject is empty.";
		}

		else if(empty($message)) {
			$error_status5 = "Message box is empty.";
		}

		else {
			if ($data -> success) {
				$mailTo = 'gtmservicesnaples@gmail.com';
				$headers = "From: ".$mailFrom;
				$txt = $message;
				mail($mailTo, $subject, $txt, $headers);
				header("Location: index.php?mailsend");
				$success_message = "<div class='success'>Message sent successfully!</div>";
			}
			else {
				$error_status6 = "<div class='error'>Verification failed! Please check the Captcha box above!</div>";
			}  
		}	
	}
?>

<style type="text/css">

.error {
    padding-top: 5px;
    color:red;
}

.success {
    color:green;
}

.captcha-wrapper {
	text-align: center;
}
.g-recaptcha {
	display: inline-block;
}

</style>

<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GTM Home Services</title>

		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="animate.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	</head>
	<body>
		<section id="nav-bar">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="#"><img src="img/logo.png"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarNav">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
							  	<a class="nav-link" href="#">HOME</a>
							</li>
							<li class="nav-item">
							  	<a class="nav-link" href="#about">ABOUT US</a>
							</li>
							<li class="nav-item">
							  	<a class="nav-link" href="#services">SERVICES</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#team">MEET THE TEAM</a>
							</li>
							<li class="nav-item">
							  	<a class="nav-link" href="#contact">CONTACT US</a>
							</li>
							<li>
								<a href="login.php" class="btn btn-primary" role="button">Log In</a>
							</li>	
							<li>
								<a href="signup.php" class="btn btn-primary" role="button">Register</a>
							</li>							
						</ul>
					</div>
			</nav>
		</section>
		<div id="slider">
			<div id="headerSlider" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#headerSlider" data-slide-to="0" class="active"></li>
					<li data-target="#headerSlider" data-slide-to="1"></li>
					<li data-target="#headerSlider" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="img/banner1.png" class="d-block img-fluid">
						<div class="carousel-caption">
							<h2 class="animated bounceInRight" style="animation-delay: 1s">Can't Make It To The Grocery Store? Full Home Concierge Ensures Goods Are Delivered In A Timely Manner!</h2>
							<p class="animated bounceInLeft" style="animation-delay: 2s"><a href="#contact">Contact us</a></p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="img/banner2.jpeg" class="d-block img-fluid">
						<div class="carousel-caption">
							<h2 class="animated slideInDown" style="animation-delay: 1s">Secure Your Home While You Are Away! Enlist our Services Today!</h2>
							<p class="animated fadeInUp" style="animation-delay: 2s"><a href="#contact">Contact us</a></p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="img/banner3.jpg" class="d-block img-fluid">
						<div class="carousel-caption">
							<h2 class="animated zoomIn" style="animation-delay: 1s">Need Your Pool to be Serviced? We Got You Covered!</h2>
							<p class="animated fadeInLeft" style="animation-delay: 2s"><a href="#contact">Contact us</a></p>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#headerSlider" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#headerSlider" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<section id="about">
		<div class="container">
		<div class="row">
		<div class="col-md-6">
			<h2>About Us</h2>
			<div class="about-content">
				The GTM Home Services team knows that sometimes your to-do list needs a little help. For those of us who can't be in ten places at once, 
				look to GTM for your home watch and maintenance needs. We're locally owned and operated, serving our neighbors in the Southwest Florida region.
				Have a one-time job that needs to be taken care of? Need regular service or maintenance? See what GTM can do for you!
			</div>
		</div>
		<div class="col-md-6">
			<h2>Total Home Care</h2>
			<div class="about-content">
				Let GTM Home Services provide you the assurance that your home is safe and maintained. We're experts in home care and all services are 
				custom-tailored to your needs by our team. Rest easy knowing GTM will alert you of anything needing your attention and will be there 
				to help take care of the situation.
			</div>
		</div>
		</div>
		</div>
		</section>
				<section id="services">
			<div class="container">
				<h1>Our Services</h1>
				<div class="row services">
					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-home"></i>
						</div>
						<h3>Home Watch</h3>
						<p>Discreet and professional home watch and monitoring services. Thorough interior and exterior inspections of your property.</p>
					</div>

					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-tint"></i>
						</div>
						<h3>Pool Services</h3>
						<p>Complete pool maintenance and upkeep services. Keep your pool in top shape.  </p>
					</div>
					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-cutlery"></i>
						</div>
						<h3>Concierge Services</h3>
						<p>Customized solutions and services from our expert staff. From small tasks to expert referrals.</p>
					</div>
				</div>				
				<div class="row services">
					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-plane"></i>
						</div>
						<h3>Airport Transportation</h3>
						<p>Door-to-door transportation services for local Southwest Florida airports.</p>
					</div>
					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-tree"></i>
						</div>
						<h3>Landscaping</h3>
						<p>Complete one-time or regularly scheduled landscaping services. Year-round 
							maintenance and up-keep.</p>
					</div>

					<div class="col-md-4 text-center">
						<div class="icon">
							<i class="fa fa-bolt"></i>
						</div>
						<h3>Hurricane Prep/Cleanup</h3>
						<p>Home and property hurricane preparation and cleanup/restoration services.</p>
					</div>
				</div>
			</div>
		</section>

		<section id="team">
			<div class="container">
				<h1>Meet the Team</h1>
				<div class="row">
					<div class="col-md-4 profile-pic text-center">
						<div class="img-box">
							<img src="img/team.png" class="img-responsive">
							<ul>
								<a href="#"><li><i class="fa fa-facebook"></i></li></a>
								<a href="#"><li><i class="fa fa-linkedin"></i></li></a>
							</ul>
						</div>
						<h2>Mark Hemmings</h2>
						<h3>Co-Founder</h3>
					</div>	
					<div class="col-md-4 profile-pic text-center">
						<div class="img-box">
							<img src="img/team.png" class="img-responsive">
							<ul>
								<a href="#"><li><i class="fa fa-facebook"></i></li></a>
								<a href="#"><li><i class="fa fa-linkedin"></i></li></a>
							</ul>
						</div>
						<h2>Greg Moore</h2>
						<h3>Co-Founder</h3>
					</div>
					<div class="col-md-4 profile-pic text-center">
						<div class="img-box">
							<img src="img/team.png" class="img-responsive">
							<ul>
								<a href="#"><li><i class="fa fa-facebook"></i></li></a>
								<a href="#"><li><i class="fa fa-linkedin"></i></li></a>
							</ul>
						</div>
						<h2>Todd Ovenhouse</h2>
						<h3>Co-Founder</h3>
					</div>		
				</div>
			</div>
		</section>

		<section id="contact">
			<div class="container">
				<h1>Contact Us</h1>
				<div class="form-group">
					<form class="contact-form" method="POST">
						<div class="form-row">
							<div class="col">
								<label>First Name*</label>
								<input type="text" name="fname" class="form-control" placeholder="First Name" value = '<?php echo $fname; ?>'/>
								<div class="error">
									<?php echo $error_status1; ?>
								</div>
							</div>
							<div class="col">
								<label>Last Name*</label>
								<input type="text" name="lname" class="form-control" placeholder="Last Name" value = '<?php echo $lname; ?>'/>
								<div class="error">
									<?php echo $error_status2; ?>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Email*</label>
							<input type="email" name="mail" class="form-control" placeholder="Email" value = '<?php echo $mailFrom; ?>'/>
							<div class="error">
								<?php echo $error_status3; ?>
							</div>
						</div>
						<div class="form-group">
							<label>Subject*</label>
							<input type="text" name="subject" class="form-control" placeholder="Subject" value = '<?php echo $subject; ?>'/>
							<div class="error">
								<?php echo $error_status4; ?>
							</div>
						</div>		
						<div class="form-group">
							<label>Message*</label>
							<textarea class="form-control" name="message" rows="4" placeholder="Tell Us How We Can Help You"><?php echo $message; ?></textarea>
							<div class="error">
								<?php echo $error_status5; ?>
							</div>
						</div>
						<div class="form-group text-center">
							<div class="g-recaptcha" data-sitekey="6Lfed5wUAAAAAE2GNzOVO2V1Q1UaSHc-JjNreqsq"></div>
							<center><div class="error">
								<?php echo $error_status6; ?>
							</div></center>
						</div>
						<div class="submit-button">
							<button type="submit" name="submit" id="paddingButton" class="btn btn-primary">Submit</button>
						</div>
						<center><div class="success">
							<?php echo $success_message; ?>
						</div></center>
					</form>
				</div>					
				<h4>OR</h4>
				<h1>Schedule An Appointment</h1>
				<div class="appointment-button">
					<a href="makeAppointment.php" id="paddingButton" class="btn btn-primary">Schedule An Appointment</a>
				</div>
			</div>
		</section>
		<section id="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-6 text-center">
						<p>&copy; 2019 GTM Home Services</p>
						<p>The GTM logo, and all other respective assets,<br /> are property of GTM Home Services.</p>
						<img class="footer-image" src="img/icon.png">
					</div>
					<div class="col-md-6 contact-info">
						<div class="follow"><b>Email:</b><i class="fa fa-envelope-o"></i><a href="mailto:toddservices@comcast.net" style="color:rgb(255,255,255)">toddservices@comcast.net</a></div>
						<div class="follow"><label><b>Get Social:</b></label>
							<a href='https://www.facebook.com/GTM-Home-Services-407770363408039/' target="_blank"><i class="fa fa-facebook"></i></a>
							<a href='https://www.linkedin.com/in/gtm-services-222350185/' target="_blank"><i class="fa fa-linkedin"></i></a>
						</div>	
					</div>
				</div>
			</div>
		</section>
		<script src="js/smooth-scroll.js"></script>
		<script>
			var scroll = new SmoothScroll('a[href*="#"]');
		</script>
	</body>
</html>