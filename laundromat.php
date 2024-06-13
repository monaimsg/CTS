<?php
include 'connect.php';
$search = "";
if (isset($_POST['sear'])) {
    $search = $_POST['search'];
}

if (!(isset($_SESSION['user']))) {
    echo "<script>window.location.assign('signin.php');</script>";
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Laundromats</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">

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
                    <li>
                        <a href="market.php"><span class="fa fa-sticky-note mr-3"></span> Cars market</a>
                    </li>
                    <li>
                        <a href="Maintenance.php"><span class="fa fa-suitcase mr-3"></span> Maintenance reservation</a>
                    </li>
                    <li class="active">
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
            <button type="button" class="btn btn-primary" onclick="window.location.assign('resarve_laund.php')">My reservations</button>

            <h2 class="mb-4" style="text-align: center;">Parkings</h2>

            <div style="width: 80%; text-align: center;">
                <form method="post" class="d-flex">
                    <input style="border: solid 1px;" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" name="sear" type="submit">Search</button>
                </form>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Reserve</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM `laundromat` WHERE `name` LIKE '%" . $search . "%'";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        die("Erreur de requête");
                    } else {
                        $index = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo '<th scope="row">' . $index . '</th>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>' . $row['phone'] . '</td>';
                            echo '<td>
                         
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' . $index . '">
  Reserve
</button>

<div class="modal fade" id="exampleModal' . $index . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $index . '" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel' . $index . '">Reserve the car park</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3 row">
                                <label for="date" class="col-sm-2 col-form-label">The date</label>
                                <div class="col-sm-10">
                                    <input required type="date" name="date" style="border: solid 1px;" class="form-control" id="date">
                                </div>
                            </div>
        <div class="mb-3 row">
                                <label for="matriqule" class="col-sm-2 col-form-label">At Time</label>
                                <div class="col-sm-10">
                                    <input required type="time" name="start" style="border: solid 1px;" class="form-control" id="matriqule">
                                </div>
                            </div>
      
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="ok" value="' . $row['id'] . '" class="btn btn-primary">Save</button>
      </div>
    </div>
    </form>
  </div>
</div>
                            </td>';
                            echo '</tr>';
                            $index = $index + 1;
                        }
                    }


                    if (isset($_POST['ok'])) {
                        $id = $_POST['ok'];
                        $start = $_POST['start'];
                        $sql = "INSERT INTO `laundromat_reserve`( `user`, `laundromat`, `time`,`date`) VALUES ('" . $_SESSION['user']['id'] . "','$id','$start','" . $_POST['date'] . "')";
                        $result = mysqli_query($con, $sql);
                        if (!$result) {
                            echo "Error: " . $sql . "<br>" . mysqli_error($con);
                        } else {
                            echo "<script>alert('Reserved successfully');</script>";
                            echo "<script>window.location.assign('resarve_laund.php');</script>";

                        }
                    }

                    ?>


                </tbody>
            </table>

        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>