<?php

session_start();
include 'koneksi.php';

$id_roti = $_POST['id_roti'];
$jumlah = $_POST['jumlah'];
$bayar = $_POST['bayar'];

$data_roti = mysqli_query(
    $koneksi,
    "SELECT * FROM roti WHERE id_roti='$id_roti'"
);

$roti = mysqli_fetch_assoc($data_roti);

$harga = $roti['harga'];
$stok  = $roti['stok'];

$total = $harga * $jumlah;

if ($jumlah > $stok) {

    echo "
    <script>
        alert('Stok tidak mencukupi');
        window.location='kasir_transaksi.php';
    </script>
    ";
    exit;
}

if ($bayar < $total) {

    echo "
    <script>
        alert('Uang pembayaran kurang');
        window.location='kasir_transaksi.php';
    </script>
    ";
    exit;
}

$kembalian = $bayar - $total;

mysqli_query(
    $koneksi,
    "INSERT INTO transaksi
(id_kasir,total_harga,bayar,kembalian)
VALUES
(
'" . $_SESSION['id'] . "',
'$total',
'$bayar',
'$kembalian'
)"
);

$id_transaksi = mysqli_insert_id($koneksi);

mysqli_query(
    $koneksi,
    "INSERT INTO detail_transaksi
(
id_transaksi,
id_roti,
jumlah,
harga,
subtotal
)
VALUES
(
'$id_transaksi',
'$id_roti',
'$jumlah',
'$harga',
'$total'
)"
);

$stok_baru = $stok - $jumlah;

mysqli_query(
    $koneksi,
    "UPDATE roti
SET stok='$stok_baru'
WHERE id_roti='$id_roti'"
);

echo "
<h2>Transaksi Berhasil</h2>

Total : Rp " . number_format($total) . "<br><br>

Bayar : Rp " . number_format($bayar) . "<br><br>

Kembalian : Rp " . number_format($kembalian) . "<br><br>

<a href='kasir_cetak_struk.php?id=$id_transaksi'>
Cetak Struk
</a>

<br><br>

<a href='kasir_transaksi.php'>
Transaksi Baru
</a>
";
