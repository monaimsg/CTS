<?php
include 'connect.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\SMTP.php';


function sendmail($email, $Subject, $message)
{
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'saggaiabdo@gmail.com';
	$mail->Password = 'tswd hhnk uuho sttv';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	$mail->Port = 587;
	$mail->setFrom('saggaiabdo@gmail.com', 'MyCars');
	$mail->addAddress($email);
	$mail->isHTML(true);
	$mail->addReplyTo('saggaiabdo@gmail.com', 'message repaly');
	$mail->Subject = $Subject;
	$mail->Body = $message;
	$mail->AltBody = $message;
	$mail->send();
}
if (isset($_POST['submit'])) {
	$id = "";
	$sql = "SELECT * FROM `user` WHERE `email` LIKE '" . $_POST['email'] . "'";
	$query = mysqli_query($con, $sql);
	if (!$query) {
		echo "Error: " . $sql . "<br>" . mysqli_error($con);
	} else {
		$b = false;
		while ($row = mysqli_fetch_array($query)) {
			$b = true;
			$id = strval($row['id']);
		}
	}
	if ($id == "") {
		echo "<script>alert('Email not found')</script>";
	} else {
		$msg = "For reset your password go to :<br>"
			. $_SERVER['SERVER_NAME'] . "/reset.php?id=" . $id;
		sendmail($_POST['email'], "Password recovery", $msg);
		echo "<script>alert('A password reset request has been sent to your email');</script>";
		echo "<script>window.location.assign('signin.php');</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Forgot password</title>
	<link rel="icon" type="image/png" href="images/logo.png">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<nav dir="rtl" class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #9DB0E2;">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.html"> <img width="80" height="80" src="images/logo.png" alt=""> </a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse " id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" style="font-size: 20px;" aria-current="page" href="index.html#first">Home</a>
					</li>


					<li class="nav-item">
						<a class="nav-link" style="font-size: 20px;" href="index.html#secandary">Our advantages</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="font-size: 20px;" href="weare.html" dir="ltr">who are we ?</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="font-size: 20px;" href="privacy.html">privacy policy</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="font-size: 20px;" href="contactus.php">Connect with us</a>
					</li>
				</ul>
				<form class="d-flex">
					<button class="btn btn-outline-light" style="margin: 5px;padding: auto;" type="button" onclick="window.location.assign('signup.php')">sign up</button>
					<button class="btn btn-outline-light" style="margin: 5px;padding: auto;" type="button" onclick="window.location.assign('signin.php')">sign in</button>
				</form>
			</div>
		</div>
	</nav>
	<section class="h-100" style="margin-top: 250px;">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">Forgot Password</h1>
							<form method="حخسف" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>

								</div>

								<div class="d-flex align-items-center">
									<button name="submit" type="submit" class="btn btn-primary ms-auto">
										Password recovery
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">

						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<script src="js/login.js"></script>
	<footer class="text-center text-white" style="background-color: #45526e;width: 100%;margin-top: 163px;">
		<div class="container p-4 pb-0">

			<section class="p-3 pt-0">
				<div class="row d-flex align-items-center">
					<div>
						<div class="p-3">
							© All rights reserved to:
							<a class="text-white" href="https://djouhaina.com/" style="text-decoration: none !important;">Mycars Foundation</a>
						</div>
					</div>

				</div>
			</section>
		</div>
	</footer>
</body>

</html>