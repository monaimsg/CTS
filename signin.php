<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $sql = "SELECT * FROM `user` WHERE ((`email` LIKE '" . $_POST['email'] . "' OR `password` LIKE '" . $_POST['email'] . "') AND `password`  LIKE MD5('" . $_POST['password'] . "'))";
    $query = mysqli_query($con, $sql);
    if (!$query) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    } else {
        $b = false;
        while ($row = mysqli_fetch_array($query)) {
            $b = true;
            $_SESSION['user'] = $row;
        }
        if ($b) {
            if ($_SESSION['user']['statut'] == 0) {
                echo "<script>alert('Suspended Account');</script>";
            } elseif ($_SESSION['user']['statut'] == 1) {
                if ($_SESSION['user']['type_user'] == 0) {
                    header('Location: home.php');
                } elseif ($_SESSION['user']['type_user'] == 1) {
                    $sqs = "SELECT * FROM `maintenance` WHERE `user` = " . $_SESSION['user']['id'] . "";
                    $q = mysqli_query($con, $sqs);
                    while ($rr = mysqli_fetch_array($q)) {
                        $_SESSION['data'] = $rr;
                    }
                    header('Location: home_maintenance.php');
                } elseif ($_SESSION['user']['type_user'] == 2) {
                    $sqs = "SELECT * FROM `laundromat` WHERE `user` = " . $_SESSION['user']['id'] . "";
                    $q = mysqli_query($con, $sqs);
                    while ($rr = mysqli_fetch_array($q)) {
                        $_SESSION['data'] = $rr;
                    }
                    header('Location: home_laundromat.php');
                } elseif ($_SESSION['user']['type_user'] == 3) {
                    $sqs = "SELECT * FROM `parking` WHERE `user` = " . $_SESSION['user']['id'] . "";
                    $q = mysqli_query($con, $sqs);
                    while ($rr = mysqli_fetch_array($q)) {
                        $_SESSION['data'] = $rr;
                    }
                    header('Location: home_parking.php');
                }
            } else {
                header('Location: confermationemail.php');
            }
        } else {
            echo "Invalid Email or Password";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Muhamad Nauval Azhar">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Sign In</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <link href="css/bootstrap.min.css" rel="stylesheet">
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
    <section class="h-100" style="margin-top: 200px;">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">

                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                            <form method="post" class="needs-validation">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="" required autofocus>

                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                        <a href="forgot.php" class="float-end">
                                            Forgot Password?
                                        </a>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>

                                <div class="d-flex align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                        <label for="remember" class="form-check-label">Remember Me</label>
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-primary ms-auto">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Don't have an account? <a href="signup.php" class="text-dark">Create One</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <footer class="text-center text-white" style="background-color: #45526e;width: 100%;margin-top: 203px;">
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