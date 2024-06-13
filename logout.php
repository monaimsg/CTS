<?php
include 'connect.php';
$_SESSION = array();
session_destroy();
echo '<script>window.location.assign("index.html");</script>';
