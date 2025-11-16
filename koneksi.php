<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "pemesanan_hotel";
$con =  mysqli_connect($server, $username, $password) or die("Koneksi gagal");
mysqli_select_db($con, $database) or die("Database tidak bisa dibuka");
?>
