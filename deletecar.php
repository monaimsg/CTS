<?php
include 'connect.php';
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$sql = "DELETE FROM `car` WHERE `id` = " . $data['idd'] . "";
$query = mysqli_query($con, $sql);
if (!$query) {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
