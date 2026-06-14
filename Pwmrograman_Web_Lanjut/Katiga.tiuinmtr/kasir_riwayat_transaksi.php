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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
        }
        a{
            display: block;
            margin-bottom: 10px;
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
        .menu-item button:horizontal {
            margin-right: 10px;
        }
        .menu-item a::before {
            content: " ➕ ";
        }

        .menu button:hover {
            background: rgb(53, 209, 69);
            color: #f6f9ff;
        }
         table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>
<body>

<h2>Riwayat Transaksi</h2>
    <hr>
    <br>
    <br>
    <br>

<div class="menu">
<a href="kasir_transaksi.php">
Transaksi Baru
</a>
<a href="kasir_riwayat_transaksi.php">Refresh</a>
<a href="kasir_dashboard.php">Kembali</a>
</div>
</div>

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
<td> <a href="kasir_detail_transaksi.php?id=<?= $data['id_transaksi']; ?>">Lihat</a> </td>
<td>
<a href="kasir_cetak_struk.php?id=<?= $data['id_transaksi']; ?>">Cetak </a>
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