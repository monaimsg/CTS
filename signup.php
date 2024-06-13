<?php
include 'connect.php';




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\SMTP.php';


function incrementalHash($len = 5)
{
    $charset = "0123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789";
    $base = strlen($charset);
    $result = '';

    $now = explode(' ', microtime())[1];
    while ($now >= $base) {
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
    }
    return substr($result, -5);
}

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

    $ss = "SELECT COUNT(*) AS `total` FROM  `user` WHERE `email` LIKE '" . $_POST['email'] . "'";
    $result = mysqli_query($con, $ss);
    $row = mysqli_fetch_assoc($result);
    if ($row['total'] > 0) {
        echo "<script>alert('email is exsite !!');window.location.href='signup.php';</script>";
        exit(0);
    }
    $ss = "SELECT COUNT(*) AS `total` FROM  `user` WHERE `username` LIKE '" . $_POST['username'] . "'";
    $result = mysqli_query($con, $ss);
    $row = mysqli_fetch_assoc($result);
    if ($row['total'] > 0) {
        echo "<script>alert('username is exsite !!');window.location.href='signup.php';</script>";
        exit(0);
    }
    $path1 = "";
    $path2 = "";
    if ($_POST['radio'] == 1) {
        $path1 = 'uploads/' . date('YmdHms') . "1" . ".jpg";
        move_uploaded_file($_FILES["file1"]["tmp_name"], $path1);

        $path2 = 'uploads/' . date('YmdHms') . "2" . ".jpg";
        move_uploaded_file($_FILES["file2"]["tmp_name"], $path2);
    }
    if ($_POST['radio'] == 2) {
        $path1 = 'uploads/' . date('YmdHms') . "1" . ".jpg";
        move_uploaded_file($_FILES["file3"]["tmp_name"], $path1);

        $path2 = 'uploads/' . date('YmdHms') . "2" . ".jpg";
        move_uploaded_file($_FILES["file4"]["tmp_name"], $path2);
    }
    if ($_POST['radio'] == 3) {
        $path1 = 'uploads/' . date('YmdHms') . "1" . ".jpg";
        move_uploaded_file($_FILES["file5"]["tmp_name"], $path1);
    }
    $sql = "";
    $ran = incrementalHash();
    if ($path2 == "") {
        $sql = "INSERT INTO `user`( `name`, `last_name`, `birthday`, `gender`, `Address`, `phone`, `username`, `email`, `password`, `bio`, `type_id_card`, `front`,`statut`,`type_user`) VALUES ('" . $_POST['name'] . "','" . $_POST['last'] . "','" . $_POST['date'] . "','" . $_POST['gander'] . "','" . $_POST['add'] . "','" . $_POST['phone'] . "','" . $_POST['username'] . "','" . $_POST['email'] . "',MD5('" . $_POST['password'] . "'),'" . $_POST['bio'] . "','" . $_POST['radio'] . "','" . $path1 . "','$ran','" . $_POST['type'] . "')";
    } else {
        $sql = "INSERT INTO `user`( `name`, `last_name`, `birthday`, `gender`, `Address`, `phone`, `username`, `email`, `password`, `bio`, `type_id_card`, `front`, `back`,`statut`,`type_user`) VALUES ('" . $_POST['name'] . "','" . $_POST['last'] . "','" . $_POST['date'] . "','" . $_POST['gander'] . "','" . $_POST['add'] . "','" . $_POST['phone'] . "','" . $_POST['username'] . "','" . $_POST['email'] . "',MD5('" . $_POST['password'] . "'),'" . $_POST['bio'] . "','" . $_POST['radio'] . "','" . $path1 . "','" . $path2 . "','$ran','" . $_POST['type'] . "')";
    }

    $query = mysqli_query($con, $sql);
    if (!$query) {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    } else {
        $id = mysqli_insert_id($con);
        $ssq = "";
        if ($_POST['type'] == 1) {
            $ssq = "INSERT INTO `maintenance`(`name`, `location`, `user`, `phone`) VALUES ('" . $_POST['namep'] . "','" . $_POST['addp'] . "','$id','" . $_POST['telp'] . "')";
        } elseif ($_POST['type'] == 2) {
            $ssq = "INSERT INTO `laundromat`(`name`, `location`, `user`, `phone`) VALUES ('" . $_POST['namep'] . "','" . $_POST['addp'] . "','$id','" . $_POST['telp'] . "')";
        } elseif ($_POST['type'] == 3) {
            $ssq = "INSERT INTO `parking`(`name`, `location`, `user`, `phone`) VALUES ('" . $_POST['namep'] . "','" . $_POST['addp'] . "','$id','" . $_POST['telp'] . "')";
        }
        $query2 = mysqli_query($con, $ssq);
        if (!$query2) {
            echo "Error: " . $ssq . "<br>" . mysqli_error($con);
        } else {
            $msg = "Your code confermation is : " . $ran . "";
            sendmail($_POST['email'], "Confirm registration", $msg);
            echo "<script>alert('You are registered');</script>";
            echo "<script>window.location.assign('signin.php');</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign UP</title>
    <link rel="icon" type="image/png" href="images/logo.png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Stepper Styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">

</head>
<style>
    .button {
        position: relative;
        margin: 0;
        padding-left: 14px;
        padding-right: 14px;
        padding-top: 2.8px;
        padding-bottom: 2.8px;
        background: #0d5287;
        color: white;
        font-size: 14px;
    }

    .button::after {
        content: '';
        position: absolute;
        top: 0;
        width: 0;
        height: 0;
    }

    .button:hover {
        background-color: #0585e8;
    }

    /* Arrow Buttons */
    /* ------------- */
    .next::after,
    .prev::after {
        border-style: solid;
    }

    /* Next Button */
    /* ----------- */
    .next::after {
        right: -22px;
        border-width: 11px;

        border-color: transparent transparent transparent #0d5287;
    }

    .next:hover::after {
        border-left-color: #0585e8;
    }

    .prev::after {
        left: -22px;
        border-color: transparent #0d5287 transparent transparent;
        border-width: 11px;
    }

    .prev:hover::after {
        border-right-color: #0585e8;
    }
</style>

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


    <main style="margin-top: 100px;">
        <!-- Start Stepper HTML -->
        <div class="container">
            <div class="accordion" id="accordionExample">
                <div class="steps">
                    <progress id="progress" value=0 max=100></progress>
                    <div class="step-item">
                        <button class="step-button text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            1
                        </button>
                        <div class="step-title">
                            First Step
                        </div>
                    </div>
                    <div class="step-item">
                        <button class="step-button text-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2
                        </button>
                        <div class="step-title">
                            Second Step
                        </div>
                    </div>
                    <div class="step-item">
                        <button class="step-button text-center collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3
                        </button>
                        <div class="step-title">
                            Third Step
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div id="headingOne">
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">First Step</h5>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">First Name</label>
                                    <input id="email" name="name" type="text" class="form-control" style="border: solid;border-radius: 45px;" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email1">Last Name</label>
                                    <input id="email1" type="text" class="form-control" style="border: solid;border-radius: 45px;" name="last" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email2">Birthday</label>
                                    <input id="email2" type="date" class="form-control" style="border: solid;border-radius: 45px;" name="date" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="emailf">Gander</label>
                                    <select style="border: solid;border-radius: 45px;" class="form-control" name="gander" id="emailf">
                                        <option value="" selected disabled>Select Gander</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="emaill">Address</label>
                                    <input id="emaill" type="text" class="form-control" style="border: solid;border-radius: 45px;" name="add" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="phone">Phone</label>
                                    <input id="phone" type="tel" class="form-control" style="border: solid;border-radius: 45px;" name="phone" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="type">Client type</label>

                                    <select onchange="change(this)" class="form-control" style="border: solid;border-radius: 45px;" name="type" id="type" required>
                                        <option selected disabled>Select type</option>
                                        <option value="0">Services requester</option>
                                        <option value="1">Maintenance workshop owner</option>
                                        <option value="2">Laundromat owner</option>
                                        <option value="3">Parking lot owner</option>

                                    </select>
                                </div>
                                <div id="suit">
                                </div>



                                <div class="d-flex align-items-center step-item">
                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class=" step-button btn btn-primary ms-auto button next" style="border-radius: 0%;width: 100px;height: 23px;background-color: #0d5287;">
                                        next
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div id="headingTwo">

                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="card-body">

                                <h5 class="card-title" style="text-align: center;">Secand Step</h5>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="username">Username</label>
                                    <input id="username" type="text" class="form-control" style="border: solid;border-radius: 45px;" name="username" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="emailv">email</label>
                                    <input id="emailv" type="email" class="form-control" style="border: solid;border-radius: 45px;" name="email" value="" required autofocus>

                                </div>
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="pass">Password</label>
                                    <input id="pass" type="password" class="form-control" style="border: solid;border-radius: 45px;" name="password" value="" required autofocus>

                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="bio">Bio</label>
                                    <textarea id="bio" class="form-control" style="border: solid;border-radius: 45px;" name="bio" rows="5" required autofocus></textarea>


                                </div>



                                <div class="d-flex align-items-center step-item">
                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class=" step-button btn btn-primary ms-auto button prev" style="border-radius: 0%;width: 100px;height: 23px;background-color: #0d5287;">
                                        back
                                    </button>

                                    <button type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class=" step-button btn btn-primary ms-auto button next" style="border-radius: 0%;width: 100px;height: 23px;background-color: #0d5287;">
                                        next
                                    </button>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="headingThree">

                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="card-body">
                                <h5 class="card-title" style="text-align: center;">Last Step</h5>
                                <div class="mb-3">
                                    <input type="radio" name="radio" id="r1" onclick="disibleddiv(this)" value="1">
                                    <label class="mb-2 text-muted" for="emaill">ID card</label>
                                    <div>
                                        <div style="margin-left: 20px;">
                                            <label class="mb-2 text-muted" for="emaill">The front</label>
                                            <input disabled id="cart1" class="form-control" type="file1" name="file1" required autofocus>
                                        </div>
                                        <div style="margin-left: 20px;">
                                            <label class="mb-2 text-muted" for="emaill">Back side</label>
                                            <input disabled id="cart2" class="form-control" type="file1" name="file2" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="radio" name="radio" id="r2" onclick="disibleddiv(this)" value="2">
                                    <label class="mb-2 text-muted" for="emaill">driving license</label>
                                    <div>
                                        <div style="margin-left: 20px;">
                                            <label class="mb-2 text-muted" for="emaill">The front</label>
                                            <input disabled id="pirmi1" class="form-control" type="file" name="file3" accept="image/x-png,image/gif,image/jpeg" required autofocus>
                                        </div>
                                        <div style="margin-left: 20px;">
                                            <label class="mb-2 text-muted" for="emaill">Back side</label>
                                            <input disabled id="pirmi2" class="form-control" type="file" name="file4" accept="image/x-png,image/gif,image/jpeg" required autofocus>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="radio" name="radio" id="r3" onclick="disibleddiv(this)" value="3">
                                    <label class="mb-2 text-muted" for="emaill">passport</label>
                                    <div>
                                        <div style="margin-left: 20px;">
                                            <label class="mb-2 text-muted" for="emaill">Information page</label>
                                            <input disabled id="paspor" class="form-control" type="file" id="file" name="file5" accept="image/x-png,image/gif,image/jpeg" required autofocus>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary ms-auto">
                                    sign up
                                </button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </main>










    <footer class="text-center text-white" style="background-color: #45526e;width: 100%;margin-top: 100px;">
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
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        function disibleddiv(myRadio) {
            var cart1 = document.getElementById('cart1');
            var cart2 = document.getElementById('cart2');
            var pirmi1 = document.getElementById('pirmi1');
            var pirmi2 = document.getElementById('pirmi2');
            var paspor = document.getElementById('paspor');
            pirmi1.disabled = false;
            pirmi2.disabled = false;
            cart1.disabled = false;
            cart2.disabled = false;
            paspor.disabled = false;



            pirmi1.required = true;
            pirmi2.required = true;
            cart1.required = true;
            cart2.required = true;
            paspor.required = true;

            if (myRadio.value == "1") {
                pirmi1.disabled = true;
                pirmi2.disabled = true;
                paspor.disabled = true;

                pirmi1.required = false;
                pirmi2.required = false;
                paspor.required = false;
            }
            if (myRadio.value == "2") {
                cart1.disabled = true;
                cart2.disabled = true;
                paspor.disabled = true;

                cart1.required = false;
                cart2.required = false;
                paspor.required = false;
            }
            if (myRadio.value == "3") {
                pirmi1.disabled = true;
                pirmi2.disabled = true;
                cart1.disabled = true;
                cart2.disabled = true;


                pirmi1.required = false;
                pirmi2.required = false;
                cart1.required = false;
                cart2.required = false;
            }

        }

        function change(sel) {
            console.log(sel);
            var suit = document.getElementById('suit');
            if (sel == 0) {
                suit.innerHTML = "";
            } else {
                suit.innerHTML = '<div class="mb-3"> <label class = "mb-2 text-muted"for = "namep" > Name of workplace </label> <input id = "namep" type = "text" class = "form-control" style = "border: solid;border-radius: 45px;" name = "namep" value = "" required autofocus ></div> <div class = "mb-3" ><label class = "mb-2 text-muted" for = "addp" > Address of workplace </label> <input id = "addp" type = "text" class = "form-control" style = "border: solid;border-radius: 45px;" name = "addp" value = "" required autofocus ></div> <div class = "mb-3" ><label class = "mb-2 text-muted" for = "telp" > Phone of workplace </label> <input id = "telp" type = "tel" class = "form-control" style = "border: solid;border-radius: 45px;" name = "telp" value = "" required autofocus ></div>';
            }

        }

        const stepButtons = document.querySelectorAll('.step-button');
        const progress = document.querySelector('#progress');

        Array.from(stepButtons).forEach((button, index) => {
            button.addEventListener('click', () => {
                console.log(index);
                var t = index;
                if (index == 3) t = 1;
                if (index == 5) t = 2;
                if (index == 4) t = 0;
                progress.setAttribute('value', t * 100 / (2));

                stepButtons.forEach((item, secindex) => {
                    if (index == 3) index = 1;
                    if (index == 5) index = 2;
                    if (index == 4) index = 0;
                    if (index > secindex) {
                        item.classList.add('done');
                    }
                    if (index < secindex) {
                        item.classList.remove('done');
                    }
                })
            })
        })
    </script>
    <script src="js/login.js"></script>

</body>

</html>