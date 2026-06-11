<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body{
            background: #d8e6ff;
            color: #01a8f8;
        }
        </style>
</head>
<body>
    <h2>Tambah User</h2>

<form action="simpan_user.php" method="POST">
Username
<br>
<input type="text" name="username">
<br><br>

Password
<br>
<input type="text" name="password">
<br><br>

No HP
<br>
<input type="text" name="no_hp">
<br><br>

Email
<br>
<input type="email" name="email">
<br><br>

Role
<br>
<select name="role">
<option value="admin">Admin</option>
<option value="kasir">Kasir</option>
</select>

<br><br>

<button type="submit">Simpan</button>

</form>
</body>
</html>