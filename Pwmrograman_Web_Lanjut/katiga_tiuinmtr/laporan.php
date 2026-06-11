<?php
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal");
}

// if (!isset($_SESSION['id'])) {
//     header("Location: login.php");
//     exit;
// }

// if ($_SESSION['role'] != 'admin') {
//     header("Location: login.php");
//     exit;
// }

?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="../assets/jquery.dataTables.min.css">
    <style>
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

    <h2>Laporan Penjualan</h2>

    <?php
    $total = mysqli_fetch_assoc(
        mysqli_query(
            $koneksi,
            "SELECT SUM(total_harga) AS pendapatan
FROM transaksi"
        )
    );
    ?>

    <h3>
        Total Pendapatan :
        Rp <?= number_format($total['pendapatan']); ?>
    </h3>

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

    <script src="../assets/jquery-3.7.0.min.js"></script>
    <script src="../assets/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#laporan').DataTable();

        });
    </script>

</body>

</html>