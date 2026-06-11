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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body{
            background: #d8e6ff;
            color: #01a8f8;
        }
    </style>
</head>
<body>
    
<h2>Transaksi Penjualan</h2>
<form action="tambah_keranjang.php" method="POST">

<select name="id_roti">

<?php

$data = mysqli_query($koneksi,
"SELECT * FROM roti");

while($d = mysqli_fetch_array($data)){?>
<option value="<?= $d['id_roti']; ?>">
<?= $d['nama_roti']; ?>
(Rp <?= number_format($d['harga']); ?>)
</option>
<?php } ?>
</select>

<input type="number"
name="jumlah"
placeholder="Jumlah"
required>

<button type="submit">
Tambah
</button>

</form>
<h3>Keranjang</h3>
<table border="1" cellpadding="10">

<tr>
    <th>No</th>
    <th>Nama Roti</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php

$no = 1;
$total = 0;

if(isset($_SESSION['cart'])){

foreach($_SESSION['cart'] as $index => $item){
$subtotal =
$item['harga'] * $item['jumlah'];

$total += $subtotal;

?>

<tr>

<td><?= $no++; ?></td>
<td><?= $item['nama_roti']; ?></td>
<td><?= number_format($item['harga']); ?></td>
<td><?= $item['jumlah']; ?></td>
<td><?= number_format($subtotal); ?></td>

<td>
    <a href="hapus_cart.php?id=<?= $index ?>"
       onclick="return confirm('Hapus item ini?')">
       Hapus
    </a>
</td>

</tr>
<?php

}
}
?>

<tr>

<td colspan="4">
<b>Total</b>
</td>

<td>
<b> Rp <?= number_format($total); ?> </b>
</td>
</tr>
</table>

<form action="simpan_transaksi.php"
method="POST">

<input type="hidden"
name="total"
id="total"
value="<?= $total ?>">

Bayar
<input type="number"
name="bayar"
id="bayar"
required>

<br><br>

Kembalian
<input type="number"
id="kembalian"
readonly>

<br><br>

<button type="submit">
Simpan Transaksi
</button>
</form>

<script src="assets/jquery-3.7.0.min.js"></script>
<script>
$("#bayar").keyup(function(){

    let total =
    Number($("#total").val());

    let bayar =
    Number($("#bayar").val());

    let kembali =
    bayar - total;

    $("#kembalian").val(kembali);

});

</script>
</body>
</html>