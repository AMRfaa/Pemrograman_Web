<?php

session_start();
$hostname = "195.88.211.20";
$username = "tiuinmtr_katiga";
$password = "katiga12345#";
$database  = "tiuinmtr_katiga_1";

$koneksi = mysqli_connect($hostname, $username, $password, $database);


if(!$koneksi){
    die("Koneksi gagal");
}

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
            window.location='transaksi.php';
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
"Location:cetak_struk.php?id=$id_transaksi"
);

?>