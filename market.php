<?php
include 'connect.php';
if (!(isset($_SESSION['user']))) {
    echo "<script>window.location.assign('signin.php');</script>";
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Market Cars</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" style="background-color: #069df9;">
            <div class="custom-menu">
                <button style="background-color: #069df9;" type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="home.php" class="logo" style="text-align: center;"><img style="margin-left: 35%;margin-right: 65%;" src="images/logo.png" width="70" height="70" alt=""> <span style="color: white;"><?= $_SESSION['user']['name'] . " " . $_SESSION['user']['last_name'] ?></span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="home.php"><span class="fa fa-home mr-3"></span> Home</a>
                    </li>
                    <li>
                        <a href="mycars.php"><span class="fa fa-user mr-3"></span> My Cars</a>
                    </li>
                    <li>
                        <a href="control.html"><span class="fa fa-briefcase mr-3"></span> Car control</a>
                    </li>
                    <li class="active">
                        <a href="market.php"><span class="fa fa-sticky-note mr-3"></span> Cars market</a>
                    </li>
                    <li>
                        <a href="Maintenance.php"><span class="fa fa-suitcase mr-3"></span> Maintenance reservation</a>
                    </li>
                    <li>
                        <a href="laundromat.php"><span class="fa fa-cogs mr-3"></span> Book a laundromat</a>
                    </li>
                    <li>
                        <a href="parking.php"><span class="fa fa-paper-plane mr-3"></span> Book a parking spot</a>
                    </li>
                </ul>

                <div class="mb-5">
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <button class=" btn btn-outline-danger" style="width: 100%;" onclick="window.location.assign('logout.php')" type="button">Logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">Sidebar #05</h2>

        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>