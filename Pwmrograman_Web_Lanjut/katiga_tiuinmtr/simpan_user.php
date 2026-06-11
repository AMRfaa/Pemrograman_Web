<?php

$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

$username = $_POST['username'];
$password = $_POST['password'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$role = $_POST['role'];

mysqli_query($koneksi,

"INSERT INTO users (username,password,no_hp,email,role)

VALUES

('$username',
 '$password',
 '$no_hp',
 '$email',
 '$role')

");

header("Location: users.php");

?>