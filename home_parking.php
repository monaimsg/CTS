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
                <h1><a href="#" class="logo" style="text-align: center;"><img style="margin-left: 35%;margin-right: 65%;" src="images/logo.png" width="70" height="70" alt=""> <span style="color: white;"><?= $_SESSION['user']['name'] . " " . $_SESSION['user']['last_name'] ?></span></a></h1>
                <ul class="list-unstyled components mb-5">

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

            <h2 class="mb-4" style="text-align: center;"><?= $_SESSION['data']['name'] ?></h2>

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
                        <th scope="col">Time</th>
                        <th scope="col">Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Statut</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM `resarve_parking` WHERE `parking` =" . $_SESSION['data']['id'] . "";
                    $result = mysqli_query($con, $sql);
                    $last_date = "";
                    $index = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        if ($last_date != $row['date']) {
                            echo '<tr><td colspan="7" class="table-active" style="text-align: center;background-color: #069df9;color:white;">' . $row['date'] . '</td></tr>';
                        }
                        $sql2 = "SELECT * FROM `maroua`.`user` WHERE `id` = " . $row['user'] . "";
                        $result2 = mysqli_query($con, $sql2);
                        $row2 = mysqli_fetch_array($result2);
                        if (str_contains($row2['name'], $search) == false || str_contains($row2['last_name'], $search) == false) {
                            continue;
                        }
                        echo '<tr>';
                        echo '<th scope="row">' . $index . '</th>';
                        echo '<td>
                         
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal' . $index . '" style="border: none;">
  ' . $row2['name'] . ' ' . $row2['last_name'] . '
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
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['name'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id="name">
                                </div>
                            </div>
                                  <div class="mb-3 row">
                                <label for="lname" class="col-sm-2 col-form-label">Last name</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['last_name'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id="lname">
                                </div>
                            </div>
                                  <div class="mb-3 row">
                                <label for="bname" class="col-sm-2 col-form-label">Birthday</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['birthday'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id="bname">
                                </div>
                            </div>
                                  <div class="mb-3 row">
                                <label for="gname" class="col-sm-2 col-form-label">Gander</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['gender'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id="gname">
                                </div>
                            </div>
                                  <div class="mb-3 row">
                                <label for="aname" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['Address'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id="aname">
                                </div>
                            </div>
                                  <div class="mb-3 row">
                                <label for="pname" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input value="' . $row2['phone'] . '" required readonly type="text" name="text" style="border: solid 1px;" class="form-control" id=pname">
                                </div>
                            </div>
       
      
      

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
                            </td>';
                        echo '<td>From ' . $row['start'] . ' to ' . $row['end'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td><pre>' . $row['description'] . '<pre></td>';
                        if ($row['statue'] == 0) {
                            echo '<td><select onchange="change(' . $row['id'] . ')" class="form-select" name="sel" id="sel">
            <option selected disibled>Select statut</option>
            <option value="1">acceptable</option>
            <option value="2">unacceptable</option>

        </select></td>';
                        } elseif ($row['statue'] == 1) {
                            echo '<td><select onchange="change(' . $row['id'] . ')" class="form-select" name="sel" id="sel">
            <option selected value="1">acceptable</option>
            <option value="2">unacceptable</option>

        </select></td>';
                        } elseif ($row['statue'] == 2) {
                            echo '<td><select onchange="change(' . $row['id'] . ')" class="form-select"  name="sel" id="sel">
            <option  value="1">acceptable</option>
            <option selected value="2">unacceptable</option>

        </select></td>';
                        }

                        echo '</tr>';
                        $index = $index + 1;
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
    <script>
        function change(id) {
            var statut = document.getElementById("sel").value;


            var url = 'updatepark.php';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Content-Type': 'text/plain'
                    },
                    body: JSON.stringify({
                        idd: id,
                        stat: statut,
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
                .then(data => {})
                .catch(error => {
                    console.error('There was a problem with the POST request:', error);
                });
        }
    </script>

</body>

</html>