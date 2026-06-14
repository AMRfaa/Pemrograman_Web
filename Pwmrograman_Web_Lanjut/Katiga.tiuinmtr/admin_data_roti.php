<?php
session_start();

include 'koneksi.php';

if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Roti</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    <style>
        body{
            background: #081122;
            color: #01a8f8;
            margin: 10px;

        }
        h2 {
            color: #01a8f8;
            padding-bottom: 10px;
            padding-top: 20px;
        }
        ul{
            list-style-type: none;
            padding: 0;
        }

        a{
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: #01a8f8;
        }
        .menu-item a::before {
            content: " ➕ "; 
        }

    </style>
</head>

<body>
    <h2>Data Roti</h2>
    <hr>
    <br>
    <br>
    <br>
    
    <ul class="menu">
        <li><a href="admin_dashboard.php">Kembali</a></li>
        <li class="menu-item"><a href="admin_tambah_roti.php">Tambah Roti</a></li>

    </ul>

    <br><br>

    <table id="tabelroti" border="1" cellpadding="10">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Roti</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;
            $data = mysqli_query( $koneksi, "SELECT * FROM roti" );
            while ($d = mysqli_fetch_array($data)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $d['nama_roti']; ?></td>
                    <td><?= $d['harga']; ?></td>
                    <td><?= $d['stok']; ?></td>
                    <td>
                        <a href="admin_edit_roti.php?id=<?= $d['id_roti']; ?>">Edit</a>
                        <a href="admin_hapus_roti.php?id=<?= $d['id_roti']; ?>"onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script src="assets/jquery-3.7.0.min.js"></script>
    <script src="assets/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#tabelroti').DataTable();

        });
    </script>
</body>

</html>