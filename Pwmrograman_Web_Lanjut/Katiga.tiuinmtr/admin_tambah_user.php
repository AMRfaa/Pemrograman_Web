<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
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
        h2 {
            color: #ffffff;
        }

        body {
            background: #081122;
            color: #01a8f8;
            margin: 10px;
        }
       h2 {
            color: #01a8f8;
            padding-bottom: 10px;
            padding-top: 20px;
        }
        .menu button {
            background: #fbfcff;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #01a8f8;
        }
        .menu-item button:horizontal {
            margin-right: 10px;
        }
        .menu-item a::before {
            content: " ➕ ";
        }

        .menu button:hover {
            background: rgb(53, 209, 69);
            color: #f6f9ff;
        }
        </style>
</head>
<body>
    <h2>Tambah User</h2>
    <hr>
    <br>
    <br>
    <br>

<form action="admin_simpan_user.php" method="POST">
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

<div class="menu">
    <button type="submit"> Simpan </button>
    <a class="menu-item" href="admin_users.php">Kembali</a>
</div>

</form>
</body>
</html>