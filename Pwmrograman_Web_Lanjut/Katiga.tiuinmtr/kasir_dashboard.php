<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'kasir'){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
        }
        .menu a{
            display: inline-block;
            background: #ffffff;
            color: #081122;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        h1 {
            color: #01a8f8;
            padding-bottom: 10px;
            padding-top: 20px;
        }
        .menu a:hover{
            background: #01a8f8;
            color: #f8faff;
            font-weight: bold;
            padding: 10px;

         }
    </style>
</head>
<body>
    
<h1>Dashboard Kasir</h1>
    <hr>
    <br>

<div class="menu">

    <a href="kasir_transaksi.php">
        🛒 Transaksi
    </a>

    <a href="kasir_riwayat_transaksi.php">
        📋 Riwayat
    </a>

    <a href="logout.php">
        🚪 Logout
    </a>

</div>
</body>
</html>