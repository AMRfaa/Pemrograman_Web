<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if(!$koneksi){
    die("Koneksi gagal");
}
?>
