<?php

include 'koneksi.php';

$id = $_POST['id'];
$username = $_POST['username'];
$password = $_POST['password'];
$no_hp = $_POST['no_hp'];
$email = $_POST['email'];
$role = $_POST['role'];

mysqli_query($koneksi,
"UPDATE users SET
username='$username',
password='$password',
no_hp='$no_hp',
email='$email',
role='$role'
WHERE id='$id'
");

header("Location: admin_users.php");

?>