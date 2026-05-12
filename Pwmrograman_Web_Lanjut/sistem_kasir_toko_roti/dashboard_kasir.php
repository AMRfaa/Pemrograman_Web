<?php
session_start();
include "database.php";

if(!isset($_SESSION["is_login"])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Kasir Roti</title>
    
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/jquery.dataTables.min.css">
    <script src="../assets/jquery-3.7.0.min.js"></script>
    <script src="../assets/jquery.dataTables.min.js"></script>

    <style>
        body { font-family: Arial; }
        .container { width: 80%; margin: auto; padding: 20px; }
        /* CSS Tabel kita hapus sebagian karena sudah digantikan oleh DataTables */
        table { width: 100%; margin-top: 20px; }
        .logout-btn { color: red; text-decoration: none; float: right; font-weight: bold; }
    </style>
</head>
<body>
    <header style="background: #333; color: white; padding: 15px;">
        <div style="width: 80%; margin: auto;">
            <span style="font-size: 20px;">Toko Roti - Kasir: <?= $_SESSION["username"] ?></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <h3>Menu Kasir</h3>

        <table id="tabelRoti" class="display"> <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Roti</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi Kasir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = $db->query("SELECT * FROM roti");
                $no = 1;
                while($data = $query->fetch_assoc()){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td class="nama-roti"><?= $data['nama_roti']; ?></td>
                    <td class="harga-roti" data-id="<?= $data['id_roti']; ?>" data-harga="<?= $data['harga']; ?>">Rp <?= number_format($data['harga'],0,',','.'); ?></td>
                    <td><?= $data['stok']; ?></td>
                    <td>
                        <input type="number" class="jumlah-beli" placeholder="Jml" min="1" max="<?= $data['stok']; ?>" style="width: 60px;">
                        <button onclick="hitung(this)">Tambah</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right; font-size: 24px; font-weight: bold;">
            Total Bayar: <span id="totalBayar" style="color: green;">Rp 0</span>
        </div>
        <div style="margin-top: 15px; text-align: right;">
            <label style="font-size: 18px;">Uang Pembeli: Rp </label>
            <input type="number" id="uangBayar" placeholder="0" style="padding: 10px; font-size: 16px; width: 150px;">
            <button onclick="prosesBayar()" style="padding: 10px 20px; font-size: 16px; background: blue; color: white; border: none; cursor: pointer;">BAYAR</button>
        </div>
        <div style="margin-top: 10px; text-align: right; font-size: 20px; font-weight: bold;">
            Kembalian: <span id="kembalian" style="color: red;">Rp 0</span>
        </div>
    </div>

    <script>
        // 1. AKTIFKAN DATATABLES DI SINI
        $(document).ready(function() {
            $('#tabelRoti').DataTable();
        });

// Buat keranjang untuk menyimpan data roti yang dibeli
        let total = 0;
        let keranjang = []; 

        function hitung(btn) {
            let row = btn.closest('tr');
            let idRoti = row.querySelector('.harga-roti').getAttribute('data-id'); // Ambil ID Roti
            let harga = row.querySelector('.harga-roti').getAttribute('data-harga');
            let jumlah = row.querySelector('.jumlah-beli').value;

            if(jumlah > 0) {
                total += (harga * jumlah);
                
                // Masukkan ID roti dan jumlahnya ke dalam memori keranjang
                keranjang.push({ id: idRoti, qty: jumlah });

                document.getElementById('totalBayar').innerText = 'Rp ' + total.toLocaleString('id-ID');
                row.querySelector('.jumlah-beli').value = ''; 
            } else {
                alert("Masukkan jumlah!");
            }
        }

        function prosesBayar() {
            let uangPembeli = document.getElementById('uangBayar').value;
            
            if (total === 0) {
                alert("Belum ada roti yang dipilih!");
                return; 
            }
            if (uangPembeli === "" || parseInt(uangPembeli) < total) {
                alert("Maaf, uang pembeli kurang!");
            } else {
                let kembalian = parseInt(uangPembeli) - total;
                
                // MENGIRIM PESAN KE PHP DENGAN JQUERY AJAX
                $.ajax({
                    url: 'update_stok.php',   // File PHP yang akan mengurangi stok
                    type: 'POST',
                    data: { data_beli: keranjang }, // Kirim isi keranjang
                    success: function(respon) {
                        // Jika sukses di database, munculkan alert
                        alert("Pembayaran Sukses!\nTotal: Rp " + total + "\nUang: Rp " + uangPembeli + "\nKembali: Rp " + kembalian);
                        
                        // Refresh halaman otomatis agar tabel stok terupdate di layar
                        location.reload();
                    }
                });
            }
        }
    </script>

    <?php include "layout/footer.html"?>
</body>
</html>