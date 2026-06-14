<?php

include 'koneksi.php';

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

header("Location: admin_users.php");

?>