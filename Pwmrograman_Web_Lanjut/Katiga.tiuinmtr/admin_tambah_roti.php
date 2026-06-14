<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
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
    <h2>Tambah Roti</h2>
    <hr>
    <br>
    <br>
    <br>

    <form action="admin_simpan_roti.php" method="POST">

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

        <div class="menu">
            <button type="submit"> Simpan </button>
            <a class="menu-item" href="admin_data_roti.php">Kembali</a>
        </div>
    </form>
</body>

</html>