<?php
include 'connect.php';
if (!(isset($_SESSION['user']))) {
    echo "<script>window.location.assign('signin.php');</script>";
}

use thiagoalessio\TesseractOCR\TesseractOCR;

require 'vendor/autoload.php';

function getmatriqulefromimage($path)
{


    require 'vendor/autoload.php';
    try {
        $fileRead = (new TesseractOCR($path))
            ->setLanguage('eng')
            ->run();
        $text = "";
        echo "<script>alert('$fileRead');</script>";
        $chars = str_split($fileRead);

        foreach ($chars as $char) {

            if (is_numeric($char)) {
                $text .= $char;
                if (strlen($text) == 10) {
                    return $text;
                }
            }
        }
        return $text;
    } catch (Exception $e) {

        echo $e->getMessage();
        return null;
    }
}


if (isset($_POST['submit'])) {
    $path1 = 'uploads/' . date('YmdHms') . "1" . ".jpg";
    move_uploaded_file($_FILES["file"]["tmp_name"], $path1);
    //$matr = getmatriqulefromimage($path1);
    // echo "<script>alert('$matr');</script>";
    // if ($matr == str_replace(' ', '', trim(strval($_POST['matriqule'])))) {
    $sql = "INSERT INTO `car`(`marque`, `name`, `matriqule`, `user`) VALUES ('" . $_POST['marque'] . "','" . $_POST['name'] . "','" . $_POST['matriqule'] . "','" . $_SESSION['user']['id'] . "')";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    } else {
        echo "<script>alert('Add Successfully');</script>";
        echo "<script>window.location.assign('mycars.php');</script>";
    }
    // }
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>My Cars</title>
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
                    <li class="active">
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
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4" style="text-align: center;">My Cars</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">marque</th>
                        <th scope="col">Name</th>
                        <th scope="col">matriqule</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `car` WHERE `user` =  " . $_SESSION['user']['id'] . "";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        die("Erreur de requête");
                    } else {
                        $index = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo '<th scope="row">' . $index . '</th>';
                            echo '<td>' . $row['marque'] . '</td>';
                            echo '<td>' . $row['name'] . '</td>';
                            echo '<td>' . $row['matriqule'] . '</td>';
                            echo '<td>    <button type="button" onclick="deletecar(' . $row['id'] . ')" class="btn btn-danger">X</button></td>';
                            echo '</tr>';
                            $index = $index + 1;
                        }
                    }

                    ?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="wrapper">
        <button id="triggerButton" class="triggerButton" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">hhhhhhhhhhh</button>
        <label for="triggerButton" style="width: 50px;height: 50px;background-color: #069df9;">
            <h1 style="color: white;text-align: center;">+</h1>
        </label>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Cars</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3 row">
                                <label for="marque" class="col-sm-2 col-form-label">marque</label>
                                <div class="col-sm-10">
                                    <input required type="text" style="border: solid 1px;" class="form-control" name="marque" id="marque">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input required type="text" style="border: solid 1px;" class="form-control" name="name" id="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="matriqule" class="col-sm-2 col-form-label">matriqule</label>
                                <div class="col-sm-10">
                                    <input required type="text" name="matriqule" style="border: solid 1px;" class="form-control" id="matriqule">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">matriqule picture</label>
                                <div class="col-sm-10">
                                    <input required type="file" style="border: solid 1px;" class="form-control" name="file" id="inputPassword" accept="image/x-png,image/gif,image/jpeg">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function deletecar(id) {
            if (confirm("are you Deleted this car ?") == true) {
                var url = 'deletecar.php';
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Content-Type': 'text/plain'
                        },
                        body: JSON.stringify({
                            idd: id,
                        }),
                    })
                    .then(response => {

                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const contentType = response.headers.get('content-type');
                        if (contentType && contentType.includes('application/json')) {
                            return response.json();
                        } else {
                            return response.text();
                        }
                    })
                    .then(data => {
                        window.location.assign('mycars.php');
                    })
                    .catch(error => {
                        console.error('There was a problem with the POST request:', error);
                    });
            }

        }
    </script>
</body>

</html>