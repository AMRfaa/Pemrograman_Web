# Pemesanan Hotel - Template Praktikum

## Langkah pasang di WAMP 
1. Copy folder proyek ke `C:\wamp64\www\pemesanan_hotel`
2. Jalankan WAMP (ikon hijau)
3. Buka `http://localhost/phpmyadmin`
4. Import `create_tables.sql` (SQL) → Go
5. Import `seed_data.sql` → Go
6. Buka `http://localhost/pemesanan_hotel/login.php`
   - contoh akun: admin1 / admin123 ; admin2 / admin234

## Pembagian tugas 
- Jul: `kamar_list.php`, `kamar_tambah.php`, `kamar_edit.php`, `kamar_hapus.php`
- Najhan: `login.php`, `proses_login.php`, `home.php`
- Marlin: `pemesanan_list.php`, `pemesanan_detail.php`
- Risma: `pemesanan_form.php` (UI)
- Nafa: `proses_pemesanan.php`, `update_status_kamar.php`, `koneksi.php`

## Catatan penting
- Setiap orang kerja di **branch sendiri** dan **push** ke GitHub.
- Jangan ubah nama tabel & kolom tanpa koordinasi.
- Validasi double-booking sudah disediakan di `proses_pemesanan.php`.
- Password di seed disimpan plain untuk praktikum. Untuk produksi, gunakan password_hash().

## Cara tes singkat
1. Login sebagai admin1/admin123
2. Tambah kamar (Jul)
3. Buat pemesanan (Risma → Nafa)
4. Cek daftar pemesanan (Marlin)
5. Hapus pemesanan → cek status kamar kembali tersedia

