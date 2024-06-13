<?php
include 'connect.php';

if (isset($_POST['submit'])) {

	if ($_POST['password_confirm'] == $_POST['password']) {
		$sql = "UPDATE `user` SET `password`= MD5('" . $_POST['password_confirm'] . "')  WHERE `id`='" . $_GET['id'] . "'";
		$query = mysqli_query($con, $sql);
		if (!$query) {
			echo "Error: " . $sql . "<br>" . mysqli_error($con);
		} else {
			echo "<script>alert('Password changed Successfully');</script>";
			echo "<script>window.location.assign('signin.php');</script>";
		}
	} else {
		echo "<script>alert('Invalid Code');</script>";
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
	<title>Reset Password</title>
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

	<script src="js/login.js"></script>
	<footer class="text-center text-white" style="background-color: #45526e;width: 100%;">
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