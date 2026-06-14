<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    
    <style>
        
        body{
            background: #081122;
            color: #01a8f8;
        }
                h2 {
            color: #ffffff;
            padding-bottom: 10px;
            padding-top: 20px;
        }


        h3 {
            height: 40px;
            width: fit-content;
            padding: 10px;
            background: #31d953;
            color: #081122;
            border-radius: 5px;

            }
            a{
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #01a8f8;
        }

        menu{           
            Display: flex;
            flex-direction: column;}
    </style>
</head>

<body>

    <h2>Laporan Penjualan</h2>
    <hr>
    <br>
    <br>
    <br>
    <?php
    $total = mysqli_fetch_assoc(
        mysqli_query(
            $koneksi,
            "SELECT SUM(total_harga) 
             AS pendapatan
             FROM transaksi"
        )
    );
    ?>

    <div class="menu">
        <h3 >
            Total Pendapatan :
            Rp <?= number_format($total['pendapatan']); ?>
        </h3>
        <br>
        <a class="menu-item" href="admin_dashboard.php">Kembali</a>
</div>

    <table id="laporan" border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kasir</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
            </tr>
        </thead>

        <tbody>
            <?php

            $no = 1;
            $query = mysqli_query(
                $koneksi,
                "SELECT transaksi.*,
                users.username
                FROM transaksi
                JOIN users
                ON transaksi.id_kasir = users.id
                ORDER BY transaksi.id_transaksi DESC"
            );

            while ($data = mysqli_fetch_array($query)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['tanggal']; ?></td>
                    <td><?= $data['username']; ?></td>
                    <td>Rp <?= number_format($data['total_harga']); ?></td>
                    <td>Rp <?= number_format($data['bayar']); ?></td>
                    <td>Rp <?= number_format($data['kembalian']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="assets/jquery-3.7.0.min.js"></script>
    <script src="assets/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#laporan').DataTable();

        });
    </script>

</body>

</html>