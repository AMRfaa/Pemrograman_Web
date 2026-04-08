<!DOCTYPE html>
<html>
    <head>
        <title>TUGAS2</title>
        <link rel="stylesheet" href="jquery.dataTables.min.css"></link>
        <script src="jquery-3.7.0.min.js"></script> 
        <script src="jquery.dataTables.min.js"></script>
    </head>
    <body>
<?php

// KONEKSI KE DATABASE
$server = "localhost";
$username = "root";
$password = "";
$database = "data_mahasiswa";
$con =  mysqli_connect($server, $username, $password) or die("Koneksi gagal");
mysqli_select_db($con, $database) or die("Database tidak bisa dibuka");

// INSERT DATA
if (isset($_POST['tambah'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];

    mysqli_query($con, "INSERT INTO tbdata VALUES ('$nim','$nama','$prodi','$alamat')");
}

// DELETE DATA
if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    mysqli_query($con, "DELETE FROM tbdata WHERE nim='$nim'");
}

// GET DATA UNTUK EDIT
$editData = null;
if (isset($_GET['edit'])) {
    $nim = $_GET['edit'];
    $editData = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tbdata WHERE nim='$nim'"));
}

// UPDATE DATA
if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "UPDATE tbdata SET nama='$nama', prodi='$prodi', alamat='$alamat' WHERE nim='$nim'");
    header("Location: index.php");
}
?>
        <!-- FORM TAMBAH / EDIT -->
        <h3><?= $editData ? "EDIT DATA" : "TAMBAH DATA" ?></h3>
        
        <table cellpadding="10">
        <form method="POST">
            <tr>
                <th>Nim :</th> 
                <td><input type="text" name="nim" value="<?= $editData['nim'] ?? '' ?>" <?= $editData ? "readonly" : "" ?>></td>
                <th>Prodi :</th>
                <td><input type="text" name="nama" value="<?= $editData['nama'] ?? '' ?>"></td>
                <th>Nama :</th>
                <td><input type="text" name="prodi" value="<?= $editData['prodi'] ?? '' ?>"></td>
                <th>alamat :</th>
                <td><input type="text" name="alamat" value="<?= $editData['alamat'] ?? '' ?>"></td>
            </tr>

<?php if ($editData): ?>
    <button name="update">UPDATE</button>
<?php else: ?>
    <button name="tambah">TAMBAH</button>

<?php endif; ?>

        </form>
        </table>

        <hr>

        <!-- TABLE DATA -->
        <h3>DATA MANUSIA</h3>
        <table border="1" cellpadding="2" id="table1">
        <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Alamat</th>
            <th>Cobain</th>
        </tr>
        </thead>

<?php
$mahasiswa = mysqli_query($con, "SELECT * FROM tbdata");
while ($m = mysqli_fetch_assoc($mahasiswa)):
?>
        <tr>
            <td><?= $m['nim'] ?></td>
            <td><?= $m['nama'] ?></td>
            <td><?= $m['prodi'] ?></td>
            <td><?= $m['alamat'] ?></td>
            <td>
                <a href="?edit=<?= $m['nim'] ?>">Edit</a>
                |
                <a href="?hapus=<?= $m['nim'] ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
        <script>
            $(document).ready(function () {
                $('#table1').DataTable();
            });
        </script>
    </body>
</html>
