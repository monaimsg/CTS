<?php

include 'connect.php';
$json = file_get_contents('php://input');
$data = json_decode($json, true);
$sql = "UPDATE `resarve_parking` SET `statue`='" . $data['stat'] . "' WHERE `id`='" . $data['idd'] . "'";
$query = mysqli_query($con, $sql);
if (!$query) {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}
