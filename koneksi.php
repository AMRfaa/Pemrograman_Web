<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "pemesanan_hotel";

$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
