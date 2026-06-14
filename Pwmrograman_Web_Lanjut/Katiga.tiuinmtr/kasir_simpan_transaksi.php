<?php

session_start();
include 'koneksi.php';

$total = $_POST['total'];
$bayar = $_POST['bayar'];
$kembalian = $bayar - $total;

mysqli_query($koneksi,

"INSERT INTO transaksi
(id_kasir,total_harga,bayar,kembalian)

VALUES

(
'".$_SESSION['id']."',
'$total',
'$bayar',
'$kembalian'
)"

);

$id_transaksi = mysqli_insert_id($koneksi);

foreach($_SESSION['cart'] as $item){

    $cek_roti = mysqli_fetch_assoc(
        mysqli_query(
            $koneksi,
            "SELECT stok FROM roti
             WHERE id_roti='".$item['id_roti']."'"
        )
    );

    $stok = $cek_roti['stok'];
    if($item['jumlah'] > $stok){
        echo "
        <script>
            alert('Stok ".$item['nama_roti']." tidak cukup');
            window.location='kasir_transaksi.php';
        </script>
        ";
        exit;
    }

    $subtotal =
    $item['harga'] *
    $item['jumlah'];

    mysqli_query($koneksi,

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
    '".$item['id_roti']."',
    '".$item['jumlah']."',
    '".$item['harga']."',
    '$subtotal'
    )"

    );
    

    mysqli_query($koneksi,
    "UPDATE roti SET
    stok = stok - ".$item['jumlah']."
    WHERE id_roti='".$item['id_roti']."'"
    );
}

unset($_SESSION['cart']);

header(
"Location: kasir_cetak_struk.php?id=$id_transaksi"
);

?>