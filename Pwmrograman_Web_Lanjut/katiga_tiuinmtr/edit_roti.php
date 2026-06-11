<?php

$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
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
        body{
            background: #d8e6ff;
            color: #;
        }
        </style>
</head>
<body>
    
<h2>Edit Roti</h2>

<form action="update_roti.php" method="POST">

<input type="hidden"
name="id_roti"
value="<?= $d['id_roti']; ?>">

Nama Roti
<br>

<input type="text"
name="nama_roti"
value="<?= $d['nama_roti']; ?>">

<br><br>

Harga
<br>

<input type="number"
name="harga"
value="<?= $d['harga']; ?>">

<br><br>

Stok
<br>

<input type="number"
name="stok"
value="<?= $d['stok']; ?>">

<br><br>

<button type="submit">
Update
</button>

</form>
</body>
</html>