<?php
session_start();
include "database.php";

if(!isset($_SESSION["is_login"]) || $_SESSION["role"] != "admin") {
    header("location: login.php");
    exit();
}

if(isset($_POST['tambah_roti'])){
    $nama = $_POST['nama_roti'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $insert = $db->query("INSERT INTO roti (nama_roti, harga, stok) VALUES ('$nama', '$harga', '$stok')");
    
    if($insert){
        echo "<script>alert('Roti baru berhasil ditambahkan!');</script>";
    } else {
        echo "<script>alert('Gagal menambah roti!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/jquery.dataTables.min.css">
    <script src="../assets/jquery-3.7.0.min.js"></script>
    <script src="../assets/jquery.dataTables.min.js"></script>

    <style>
        body { font-family: Arial; background: #e3f2fd; }
        .container { width: 80%; margin: auto; padding: 20px; background: white; margin-top: 20px; border-radius: 8px;}
        input { padding: 10px; margin: 5px; }
    </style>
</head>
<body>
    <header style="background: #1565C0; color: white; padding: 15px;">
        <div style="width: 80%; margin: auto;">
            <span style="font-size: 20px;">DASHBOARD ADMIN - Halo Bos <?= $_SESSION["username"] ?>!</span>
            <a href="logout.php" style="color: white; float: right; font-weight: bold; background: red; padding: 5px 10px; text-decoration: none; border-radius: 5px;">Logout</a>
        </div>
    </header>

    <div class="container">
        <h3>Tambah Menu Roti Baru</h3>
        <form method="POST">
            <input type="text" name="nama_roti" placeholder="Nama Roti" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="number" name="stok" placeholder="Jumlah Stok" required>
            <button type="submit" name="tambah_roti" style="padding: 10px; background: #4CAF50; color: white; border: none; cursor:pointer;">Simpan Roti</button>
        </form>

        <hr style="margin-top: 20px;">

        <h3>Daftar Stok Roti Saat Ini</h3>
        
        <table id="tabelStok" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Roti</th>
                    <th>Harga</th>
                    <th>Stok Tersedia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $db->query("SELECT * FROM roti ORDER BY id_roti DESC");
                while($data = $query->fetch_assoc()){
                ?>
                <tr>
                    <td><?= $data['id_roti']; ?></td>
                    <td><?= $data['nama_roti']; ?></td>
                    <td>Rp <?= number_format($data['harga'],0,',','.'); ?></td>
                    <td><?= $data['stok']; ?> Pcs</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        // AKTIFKAN DATATABLES DI PANEL ADMIN
        $(document).ready(function() {
            $('#tabelStok').DataTable();
        });
    </script>

    <?php include "layout/footer.html"?>
</body>
</html>
