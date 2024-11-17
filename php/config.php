<?php
$con = mysqli_connect("localhost", "root", "root1234", "cloud_gaming");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
