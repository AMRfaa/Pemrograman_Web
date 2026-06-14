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

"SELECT * FROM roti
WHERE id_roti='$id'");

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
</head>
<body>
    
<h2>Edit Roti</h2>
    <hr>
    <br>
    <br>

<form action="admin_update_roti.php" method="POST">

<input type="hidden" name="id_roti" value="<?= $d['id_roti']; ?>">

Nama Roti
<br>
<input type="text" name="nama_roti" value="<?= $d['nama_roti']; ?>">
<br><br>

Harga
<br>
<input type="number" name="harga" value="<?= $d['harga']; ?>">
<br><br>

Stok
<br>
<input type="number"
name="stok"
value="<?= $d['stok']; ?>">

<br><br>
<div class="menu">
    <button type="submit"> Update </button>
    <a class="menu-item" href="admin_users.php">Kembali</a>
</div>

</form>
</body>
</html>