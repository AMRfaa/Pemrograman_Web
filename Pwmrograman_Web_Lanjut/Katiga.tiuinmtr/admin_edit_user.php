<?php

session_start();
include 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query($koneksi,
"SELECT * FROM users
WHERE id='$id'");

$d = mysqli_fetch_array($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            background: #081122;
            color: #01a8f8;
            margin: 10px;
        }
        h2 {
            color: #ffffff;
            padding-bottom: 10px;
            padding-top: 20px;
        }
        .menu button {
            background: #fbfcff;
            padding: 15px 20px;
            border-radius: 10px;
            border: 1px solid #01a8f8;
        }

        .menu-item a::before {
            content: " ➕ ";
        }

        .menu button:hover {
            background: rgb(53, 209, 69);
            color: #f6f9ff;
        }
        </style>
    </style>
</head>
<body>
    
<h2>Edit User</h2>
    <hr>
    <br>
    <br>
<form action="admin_update_user.php" method="POST">

<input type="hidden"
name="id"
value="<?= $d['id']; ?>">

Username
<br>
<input type="text"
name="username"
value="<?= $d['username']; ?>">

<br><br>

Password
<br>
<input type="text"
name="password"
value="<?= $d['password']; ?>">

<br><br>

No HP
<br>
<input type="text"
name="no_hp"
value="<?= $d['no_hp']; ?>">

<br><br>

Email
<br>
<input type="email"
name="email"
value="<?= $d['email']; ?>">

<br><br>

Role
<br>
<select name="role">

<option value="admin"
<?= $d['role']=="admin" ? "selected" : "" ?>>
Admin
</option>

<option value="kasir"
<?= $d['role']=="kasir" ? "selected" : "" ?>>
Kasir
</option>

</select>

<br><br>

<div class="menu">
    <button type="submit">Update</button>
    <a class="menu-item" href="admin_users.php">Kembali</a>
</div>
</form>
</body>
</html>