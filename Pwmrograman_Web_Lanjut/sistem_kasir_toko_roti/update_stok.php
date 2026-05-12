<?php
include "database.php";

// Jika ada data keranjang yang dikirim dari JavaScript
if(isset($_POST['data_beli'])) {
    $keranjang = $_POST['data_beli'];

    // Lakukan perulangan untuk setiap roti yang dibeli
    foreach($keranjang as $item) {
        $id_roti = $item['id'];
        $jumlah_beli = $item['qty'];

        // Kurangi stok di database
        // Logikanya: stok = stok_sekarang - jumlah_yang_dibeli
        $db->query("UPDATE roti SET stok = stok - $jumlah_beli WHERE id_roti = '$id_roti'");
    }

    echo "Sukses Mengurangi Stok";
}
?>