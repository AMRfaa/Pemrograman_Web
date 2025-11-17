USE db_pemesanan_hotel;

INSERT INTO pengguna (nama_pengguna, kata_sandi, nama_lengkap, peran)
VALUES
('admin1','admin123','Admin Satu','admin'),
('admin2','admin234','Admin Dua','admin'),
('petugas1','petugas123','Petugas Satu','petugas'),
('tamu1','tamu123','Tamu Contoh','tamu');

INSERT INTO kamar (nomor_kamar, jenis_kamar, kapasitas, harga_per_malam, status)
VALUES
('101','Standar',2,200000,'tersedia'),
('102','Standar',2,200000,'tersedia'),
('201','Deluxe',3,350000,'tersedia'),
('202','Deluxe',3,350000,'perbaikan'),
('301','Suite',4,600000,'tersedia');
