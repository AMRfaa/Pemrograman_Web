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
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'kasir'){
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$transaksi = mysqli_fetch_assoc(

mysqli_query(
$koneksi,
"SELECT transaksi.*, users.username 
FROM transaksi JOIN users
ON transaksi.id_kasir = users.id
WHERE transaksi.id_transaksi='$id'"
)
);
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
            background: #eff4ff;
            color: #01a8f8;
        }
        table{
            background: #0d1b34;
            color: #01a8f8;
        }
        a{
            display: block;
            margin-top: 20px;
            color: #01a8f8;
        }
    </style>
</head>
<body>
    
<h2>Detail Transaksi</h2>

<p>
No Transaksi :
<?= $transaksi['id_transaksi']; ?>
</p>

<p>
Kasir :
<?= $transaksi['username']; ?>
</p>

<p>
Tanggal :
<?= $transaksi['tanggal']; ?>
</p>

<table border="1" cellpadding="10">

<tr>
    <th>Nama Roti</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
</tr>

<?php

$detail = mysqli_query(

$koneksi,

"SELECT detail_transaksi.*,
roti.nama_roti FROM detail_transaksi JOIN roti 
ON detail_transaksi.id_roti = roti.id_roti
WHERE id_transaksi='$id'"
);

while($d = mysqli_fetch_array($detail)){
?>

<tr>
<td><?= $d['nama_roti']; ?></td>
<td>Rp <?= number_format($d['harga']); ?></td>
<td><?= $d['jumlah']; ?></td>
<td>Rp <?= number_format($d['subtotal']); ?></td>
</tr>
<?php } ?>

</table>
<br>

<b>Total :</b>
Rp <?= number_format($transaksi['total_harga']); ?>

<br><br>

<b>Bayar :</b>
Rp <?= number_format($transaksi['bayar']); ?>

<br><br>

<b>Kembalian :</b>
Rp <?= number_format($transaksi['kembalian']); ?>

<br><br>

<a href="riwayat.php">
Kembali
</a>
</body>
</html>