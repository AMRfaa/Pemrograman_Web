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
    <title>Dashboard Admin</title>
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
            color: #081122;
            font-weight: bold;}
    </style>
</head>
<body>
<h1>Dashboard Admin</h1>
    <hr>
    <br>
<div class="menu">

    <a href="admin_data_roti.php">
        🍞 Data Roti</a>
    
    <a href="admin_users.php">
    👤 Data Kasir</a>
    
    
    <a href="admin_laporan.php">
        📊 Laporan</a>
        

    <a href="logout.php">
        🚪 Logout</a>

</div>