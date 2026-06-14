<?php
session_start();
include 'koneksi.php';

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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
            margin: 10px;
            color: #01a8f8;

        }
        h2 {
            color: #fcfeff;
            padding-bottom: 10px;
            padding-top: 20px;
        }

        .menu a{
            display: inline-block;
            color: #01a8f8;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .menu a:hover{
            background: #01a8f8;
            color: #f8faff;
            font-weight: bold;
            height: 40px;

         }
        .menu button {
            background: #fbfcff;
            padding: 15px 15px;
            height: 50px;
            border-radius: 10px;
            border: 1px solid #01a8f8;

        }
        .menu button::before {
            content: " ➕ ";
        }

        .menu button:hover {
            background: rgb(53, 209, 69);
            color: #f6f9ff;
        }

        .info_kasir{
            list-style-type: none;
            padding: 0;
            font-size: 18px;
        }
        .info_kasir th {
            text-align: left;
            padding-right: 20px;
            width: 150px;
        }
    </style>
</head>
    

<h2>Detail Transaksi</h2>
<hr>
    <br>
    <br>
    <br>

    <div class="info_kasir">
    <table border="1" cellpadding="10">
    <tr>
        <th>No Transaksi</th>
        <td><?= $transaksi['id_transaksi']; ?></td>
    </tr>
    <tr>
        <th>Kasir</th>
        <td><?= $transaksi['username']; ?></td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td><?= $transaksi['tanggal']; ?></td>
    </tr>
    </table>
    </div>

<br><br>

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
<br>

<div class="info_kasir">
<table border="1" cellpadding="10">
<tr>
    <th>Total Harga</th>
    <td>Rp <?= number_format($transaksi['total_harga']); ?></td>
</tr>
<tr>
    <th>Bayar</th>
    <td>Rp <?= number_format($transaksi['bayar']); ?></td>
</tr>
<tr>
    <th>Kembalian</th>
    <td>Rp <?= number_format($transaksi['kembalian']); ?></td>
</tr>
</table>
</div>

<br><br>

<div class="menu">
    <a href="kasir_riwayat_transaksi.php">
        Kembali
    </a>
</div>
</body>
</html>