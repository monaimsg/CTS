<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $sql = "INSERT INTO `contactus`(`name`, `email`, `subject`, `message`) VALUES ('" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['subject'] . "','" . $_POST['message'] . "')";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    } else {
        echo "<script>alert('Message Sent Successfully');</script>";
        echo "<script>window.location.assign('index.html');</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo.png">


    <title>Contact us</title>
</head>

<body style="background-color: #e8edf0;">
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

    <div class="container" style="margin-top: 100px;">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters mb-5">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4" style="width: 50%;">
                                <h3 class="mb-4" style="text-align: center;">For your problems or inquiries
                                    Contact us</h3>

                                <form method="post" id="contactForm" class="contactForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group" style="text-align: left;">
                                                <label class="label" for="name">full name</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="the name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group" style="text-align: left;">
                                                <label class="label" for="email">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" style="text-align: left;">
                                                <label class="label" for="subject">Subject</label>
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group" style="text-align: left;">
                                                <label class="label" for="#">the message</label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="the message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" name="submit" value="Send message" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch">

                            <div id="map" style="margin: 20px;">




                                <div class="google-maps">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3385.5128819006495!2d5.268071000000009!3d31.946980000000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x125d68e1fb436a23%3A0xdfd4ad21a6377b20!2z2KzYp9mF2LnYqSDZgtin2LXYr9mKINmF2LHYqNin2K0gMg!5e0!3m2!1sar!2sus!4v1710162022893!5m2!1sar!2sus" style="border:0;width: 50%;height: 555px;width: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section></section>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>the address:</span> new Pole - Ouargla - Algeria</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>phone number:</span> <a href="tel://1234567920" style="text-decoration: none !important;">(+213) XXXXXXXXX</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email:</span> <a href="mailto:cartechcts@gmail.com" style="text-decoration: none !important;">cartechcts@gmail.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-facebook"></span>
                                </div>
                                <div class="text">
                                    <p><span>Facebook : </span> <a href="https://www.facebook.com/" style="text-decoration: none !important;" target="_blank">MY Car</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="" style="all: unset;position: relative;
      bottom: 0px;
      width: 100%;
    ">
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
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>


</body>

</html>