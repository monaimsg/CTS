<?php
$con =  mysqli_connect("localhost", "root", "", "maroua");
if (mysqli_connect_errno()) {
    exit(0);
}
session_start();
