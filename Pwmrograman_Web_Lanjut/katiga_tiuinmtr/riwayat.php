<?php
session_start();
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";
$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

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
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    style>
        body{
            background: #081122;
            color: #01a8f8;
        }
        a{
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Riwayat Transaksi</h2>

<a href="dashboard.php">
Kembali
</a>

<br><br>

<table id="tabelRiwayat" border="1" cellpadding="10">

<thead>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Bayar</th>
    <th>Kembalian</th>
    <th>Detail</th>
    <th>Struk</th>
    <th>Kasir</th>
</tr>
</thead>

<tbody>

<?php

$no = 1;

$query = mysqli_query($koneksi,
"SELECT transaksi.*, users.username
FROM transaksi
JOIN users
ON transaksi.id_kasir = users.id
ORDER BY id_transaksi DESC");

while($data = mysqli_fetch_array($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['tanggal']; ?></td>

<td>Rp <?= number_format($data['total_harga']); ?></td>

<td>Rp <?= number_format($data['bayar']); ?></td>

<td>Rp <?= number_format($data['kembalian']); ?></td>
<td> <a href="detail_transaksi.php?id=<?= $data['id_transaksi']; ?>">Lihat</a> </td>
<td>

<a href="cetak_struk.php?id=<?= $data['id_transaksi']; ?>">

Cetak

</a>

</td>
<td><?= $data['username']; ?></td>


</tr>

<?php } ?>

</tbody>

</table>

<script src="assets/jquery-3.7.0.min.js"></script>
<script src="assets/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function(){

    $('#tabelRiwayat').DataTable();

});

</script>

</body>
</html>