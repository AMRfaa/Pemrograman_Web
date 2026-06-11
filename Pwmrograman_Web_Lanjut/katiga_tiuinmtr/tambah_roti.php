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
    <title>Tambah Roti</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h2>Tambah Roti</h2>

<form action="simpan_roti.php" method="POST">

Nama Roti
<br>
<input type="text" name="nama_roti">
<br><br>

Harga
<br>

<input type="number" name="harga">

<br><br>

Stok
<br>

<input type="number" name="stok">

<br><br>

<button type="submit">
Simpan
</button>

</form>
</body>
</html>