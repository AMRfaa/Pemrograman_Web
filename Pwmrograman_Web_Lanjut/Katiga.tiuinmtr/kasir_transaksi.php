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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
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

        a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #01a8f8;
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
    </style>
</head>

<body>

    <h2>Transaksi</h2>
    <hr>
    <br>
    <br>
    <br>
    <form action="kasir_tambah_keranjang.php" method="POST">
        <select name="id_roti">
            <?php

            $data = mysqli_query(
                $koneksi,
                "SELECT * FROM roti"
            );

            while ($d = mysqli_fetch_array($data)) { ?>
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

        <div class="menu">
            <button type="submit">Tambah</button>
            <a href="kasir_transaksi.php">Refresh</a>
            <a href="kasir_dashboard.php">Kembali</a>

        </div>


        <br><br>
        <br><br>
        <br><br>
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

        if (isset($_SESSION['cart'])) {

            foreach ($_SESSION['cart'] as $index => $item) {
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
                        <a href="kasir_hapus_keranjang.php?id=<?= $index ?>"
                            onclick="return confirm('Hapus item ini?')">
                            Hapus</a>
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

    <form action="kasir_simpan_transaksi.php"
        method="POST">

        <input type="hidden"
            name="total"
            id="total"
            value="<?= $total ?>">

        <br><br>
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

        <div class="menu">
            <button type="submit">
                Simpan Transaksi
            </button>
            <a href="kasir_riwayat_transaksi.php">Riwayat Transaksi</a>

        </div>
    </form>

    <script src="assets/jquery-3.7.0.min.js"></script>
    <script>
        $("#bayar").keyup(function() {

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