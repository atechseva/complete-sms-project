<?php
session_start();
include("database/db.php");
error_reporting(0);

if (isset($_REQUEST['register'])) {
	$errorMsg = "";
	$msg ="";
	$student_name = $_REQUEST['student_name'];
	$cource = $_REQUEST['cource'];
	$student_password = $_REQUEST['student_password'];
	$passwordlength = strlen($student_password);
	$hpassword = password_hash($student_password, PASSWORD_BCRYPT);
	$phone = $_REQUEST['phone'];
	$dob = $_REQUEST['dob'];
	$gender = $_REQUEST['gender'];
	$student_email = mysqli_real_escape_string($conn, $_POST['student_email']);
	$sql = "SELECT * FROM studentregister WHERE student_email = '$student_email'";
	$execute = mysqli_query($conn, $sql);
	if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
		$errorMsg = "Email in not valid try again";
	} else if ($execute->num_rows == 1) {
		$errorMsg = "This Email is already exists";
	} else if ($passwordlength < 6) {
		$errorMsg = "<br><redtext> Invalid password. Password must be at least 6 characters</redtext>";
	} else {
		$query = "insert into studentregister(`student_name`,`cource`,`student_email`,`student_password`,`phone`,`dob`,`gender`) 
        values('$student_name','$cource','$student_email','$hpassword','$phone','$dob','$gender')";
		$result = mysqli_query($conn, $query);
		if ($result == true) {
			
			$msg = '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
			</button>
		<strong>Success!</strong> Account has been created successfully
	  </div>';
	  header('location:student-login.php');
		} else {
			$errorMsg  = "You are not Registred..Please Try again";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>School 1</title>
	<?php include('include/links.php') ?>
</head>
<body>
	<!-- header -->
	<header>
<div class="top-head container">
		<div class="ml-auto text-right right-p">
			<ul>
				<li class="mr-3">
					<span class="fa fa-clock-o"></span> Mon-Sat : 8:00 to 16:00</li>
				<li>
					<span class="fa fa-envelope-open"></span> <a href="mailto:info@example.com">atechseva@gmail.com</a> </li>
			</ul>
		</div>
	</div>
		<div class="container">
			<!-- nav -->
			<nav class="py-3 d-lg-flex">
				<div id="logo">
					<h1> <a href="index.html"><img src="images/s2.png" alt=""> Student Management </a></h1>
				</div>
				<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
				<input type="checkbox" id="drop" />
				<ul class="menu ml-auto mt-1">
				<li class="active"><a href="index.php">Home</a></li>
					<li class=""><a href="#about">About</a></li>
					<li class=""><a href="#services">Courses</a></li>
					<li class=""><a href="#testi">Testimonials</a></li>
					<li class=""><a href="student-login.php">Login/Register</a></li>

				</ul>
			</nav>
			<!-- //nav -->
		</div>
	</header>
	<!-- //header -->

	<!-- banner -->
	<div class="banner" id="home">
		<div class="layer">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 banner-text-w3pvt">
						<!-- banner slider-->
						<div class="csslider infinity" id="slider1">
							<input type="radio" name="slides" checked="checked" id="slides_1" />
							<input type="radio" name="slides" id="slides_2" />
							<input type="radio" name="slides" id="slides_3" />
							<ul class="banner_slide_bg">
								<li>
									<div class="container-fluid">
										<div class="w3ls_banner_txt">
											<h3 class="b-w3ltxt text-capitalize mt-md-4">It’s not about perfect. It’s about effort.</h3>
											
										
											<a href="#about" class="btn btn-banner my-3">Read More</a>
										</div>
									</div>
								</li>
								<li>
									<div class="container-fluid">
										<div class="w3ls_banner_txt">
											<h3 class="b-w3ltxt text-capitalize mt-md-4">Excellence is not a skill. It is an attitude</h3>
											
											
											<a href="#about" class="btn btn-banner my-3">Read More</a>
										</div>
									</div>
								</li>
								<li>
									<div class="container-fluid">
										<div class="w3ls_banner_txt">
											<h3 class="b-w3ltxt text-capitalize mt-md-4">Your time is limited, so don’t waste it living someone else’s life</h3>
											
											<a href="#about" class="btn btn-banner my-3">Read More</a>
										</div>
									</div>
								</li>
							</ul>
							<div class="navigation">
								<div>
									<label for="slides_1"></label>
									<label for="slides_2"></label>
									<label for="slides_3"></label>
								</div>
							</div>
						</div>
						<!-- //banner slider-->
					</div>
					<div class="col-lg-5 col-md-8 px-lg-3 px-0">
						<div class="banner-form-w3 ml-lg-5">
							<div class="padding">
								<!-- banner form -->
								<?php echo $errormsg; ?>
								<?php echo $msg; ?>
								
								<form action="" method="post" enctype="multipart/form-data">
									<h5 class="mb-3">Register Now</h5>
									
									<div class="form-style-w3ls">
										<input placeholder="Full Name" name="student_name" type="text">
										<input placeholder="Contact Number" name="phone" type="text">
										<input placeholder="Your Email Id" name="student_email" type="email">
										<input placeholder="Your Password" name="student_password" type="password">
										<select name="cource" >
											<option>Select Course</option>
											<?php
											$seclect = "select * from cource";
											$sel = mysqli_query($conn, $seclect);
											while ($row = mysqli_fetch_array($sel)) {
												$cource_id = $row['cource_id'];
												$cource = $row['cource'];
											?>

												<option value="<?php echo $cource; ?>">
													<?php echo $cource; ?>
												</option>
											<?php
											}
											?>
										</select>
																			<div class="form-group">
										
											<input type="date" name="dob" class="form-control">
										</div>
										<p>Gender : <label class="radio-inline">
												<input type="radio" name="gender" value="male" checked="checked"> Male
											</label>
											<label class="radio-inline">
												<input type="radio" name="gender" value="female"> Female
											</label>
										</p>
										<button type="submit" class="btn" name="register"> Submit</button>

										<span>By registering, you agree to our <a href="#">Terms & Conditions.</a></span>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<section class="banner-bottom py-5" id="about">
		<div class="container py-lg-5">
			<h2 class="heading mb-sm-5 mb-4"> Build Your Career With Our Education System</h2>
			<div class="row bottom-grids">
				<div class="col-md-3 col-sm-6">
					<div class="three-grids-w3pvt-1 d-flex text-right">
						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">
							<h5 class="text-capitalize text-bl font-weight-bold">Facillities</h5>
							<p>Education</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 mt-sm-0 mt-4">
					<div class="three-grids-w3pvt-2 d-flex text-right">
						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">
							<h5 class="text-capitalize text-bl font-weight-bold">Graduation</h5>
							<p>Education</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 mt-md-0 mt-4">
					<div class="three-grids-w3pvt-3 d-flex text-right">
						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">
							<h5 class="text-capitalize text-bl font-weight-bold">Learning</h5>
							<p>Education</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 mt-md-0 mt-4">
					<div class="three-grids-w3pvt-4 d-flex text-right">
						<div class="text-effect-wthree midd-text-w3ls p-3 w-100">
							<h5 class="text-capitalize text-bl font-weight-bold">Success</h5>
							<p>Education</p>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<p class="mt-4">Vivamus mattis ex massa. Morbi sed dui imperdiet, tinci dunt libero a, sagittis enim. Donec lobortis cursuser uti justo, at
						eleifend eros init ultricies sed. Vivamus efficit ur urna vitae tempus aliquam. Proin aliquet dictum est molestie maximus sapien leo cursus rhoncus.</p>
				</div>
				<div class="col-lg-1 col-sm-4 col-5 ser-img">
					<img src="images/s1.png" class="mt-4" alt="">
					<img src="images/s2.png" class="mt-4" alt="">
				</div>
				<div class="col-lg-1 col-sm-4 col-5 ser-img">
					<img src="images/s3.png" class="mt-4" alt="">
					<img src="images/s5.png" class="mt-4" alt="">
				</div>
				<div class="col-lg-5">
					<p class="mt-4"> Vivamus efficitur ur vitae tempus aliquam. Proin aliquet dictum est, molestie maximus sapien maximus a.
						Fuscer eleifend. convallis vitae enim eu egestas. Quisque placi rati enim nibh, vitae faucibus odio vestibulum pretium. Sed malesuada
						libero sed commodo varius. </p>
				</div>
			</div>
		</div>
	</section>
	
	<section class="services py-5" id="services">
		<div class="container">
			<h3 class="heading mb-5">Our Services</h3>
			<div class="row ml-sm-5">
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s1.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Quality Education</h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s2.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Experienced Staff</h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s3.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Ac Classrooms</h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s4.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Study Certificate</h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s5.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Study Materials </h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="our-services-wrapper mb-60">
						<div class="services-inner">
							<div class="our-services-img">
								<img src="images/s6.png" alt="">
							</div>
							<div class="our-services-text">
								<h4>Library Books</h4>
								<p>Proin varius pellentesque nunc tincidunt ante. Init id lacus</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="position-image">
				<img src="images/services.png" alt="" class="img-fluid">
			</div>
			
		</div>
	</section>

	<section class="other_services py-5" id="why">
		<div class="container py-lg-5 py-3">
			<h3 class="heading mb-sm-5 mb-4">Why Choose Us </h3>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="grid">
						<img src="images/choose1.jpg" alt="" class="img-fluid" />
						<div class="info p-4">
							<h4 class=""><img src="images/s1.png" class="img-fluid" alt=""> AC Class Rooms</h4>
							<p class="mt-3">Onec consequat sapien amet leo cur sus rhoncus. Nullam dui mi Donec at nunc enim. Proin at iaculis tellus...</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mt-md-0 mt-4">
					<div class="grid">
						<img src="images/choose2.jpg" alt="" class="img-fluid" />
						<div class="info p-4">
							<h4 class=""><img src="images/s3.png" class="img-fluid" alt=""> Quality Staff</h4>
							<p class="mt-3">Onec consequat sapien amet leo cur sus rhoncus. Nullam dui mi Donec at nunc enim. Proin at iaculis tellus...</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
					<div class="grid">
						<img src="images/choose3.jpg" alt="" class="img-fluid" />
						<div class="info p-4">
							<h4 class=""><img src="images/s5.png" class="img-fluid" alt=""> Spacious Library </h4>
							<p class="mt-3">Onec consequat sapien amet leo cur sus rhoncus. Nullam dui mi Donec at nunc enim. Proin at iaculis tellus...</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<?php include("include/footer.php"); ?>
</body>

</html>