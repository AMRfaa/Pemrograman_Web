<?php

session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'kasir') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

$transaksi = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT transaksi.*,
                                                users.username
                                                FROM transaksi
                                                JOIN users
                                                ON transaksi.id_kasir = users.id
                                                WHERE transaksi.id_transaksi='$id'"
    )
);
?>

<!DOCTYPE html>
<html>

<head>

    <title>Struk Transaksi</title>

    <style>
        body {
            font-family: Arial;
            width: 300px;
        }

        hr {
            border: 1px dashed black;
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
    <center>
        <h3>TOKO ROTI KATIGA</h3>
        Jl.dr soetomo no 123, Sandik
        <hr>
    </center>

    No Transaksi :
    <?= $transaksi['id_transaksi']; ?>
    <br>
    Kasir :
    <?= $transaksi['username']; ?>
    <br>
    Tanggal :
    <?= $transaksi['tanggal']; ?>
    <hr>
    <?php

    $detail = mysqli_query(
        $koneksi,
        "SELECT detail_transaksi.*, roti.nama_roti FROM detail_transaksi
           JOIN roti ON detail_transaksi.id_roti = roti.id_roti
           WHERE id_transaksi='$id'"
    );

    while ($d = mysqli_fetch_array($detail)) { ?>

        <?= $d['nama_roti']; ?>
        <br>
        <?= $d['jumlah']; ?>
        x
        <?= number_format($d['harga']); ?>
        =
        Rp <?= number_format($d['subtotal']); ?>
        <br><br>
    <?php } ?>

    <hr>
    Total :
    Rp <?= number_format($transaksi['total_harga']); ?>
    <br>
    Bayar :
    Rp <?= number_format($transaksi['bayar']); ?>
    <br>
    Kembalian :
    Rp <?= number_format($transaksi['kembalian']); ?>
    <hr>

    <center>
        Terima Kasih
    </center>

    <script>
        window.print();
    </script>

<br>
<br>
<div class="menu">
<a href="kasir_riwayat_transaksi.php"> < Kembali</a>
</div>
</body>

</html>