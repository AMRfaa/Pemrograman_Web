CREATE DATABASE IF NOT EXISTS pemesanan_hotel;
USE pemesanan_hotel;

-- Tabel pengguna (admin / petugas / tamu)
CREATE TABLE IF NOT EXISTS pengguna (
  id_pengguna INT AUTO_INCREMENT PRIMARY KEY,
  nama_pengguna VARCHAR(50) NOT NULL UNIQUE,
  kata_sandi VARCHAR(255) NOT NULL,
  nama_lengkap VARCHAR(100) NOT NULL,
  peran ENUM('admin','petugas','tamu') DEFAULT 'tamu'
);

-- Tabel jenis_kamar
CREATE TABLE IF NOT EXISTS jenis_kamar (
  id_jenis INT AUTO_INCREMENT PRIMARY KEY,
  nama_jenis VARCHAR(50) NOT NULL,
  kapasitas INT NOT NULL,
  harga_per_malam DECIMAL(12,2) NOT NULL,
  deskripsi TEXT
);

-- Tabel kamar
CREATE TABLE IF NOT EXISTS kamar (
  id_kamar INT AUTO_INCREMENT PRIMARY KEY,
  nomor_kamar VARCHAR(20) NOT NULL UNIQUE,
  id_jenis INT NOT NULL,
  status ENUM('tersedia','terisi','perbaikan') DEFAULT 'tersedia',
  FOREIGN KEY (id_jenis) REFERENCES jenis_kamar(id_jenis) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabel pemesanan
CREATE TABLE IF NOT EXISTS pemesanan (
  id_pemesanan INT AUTO_INCREMENT PRIMARY KEY,
  id_pengguna INT NOT NULL,    -- user yang membuat pemesanan (bisa admin/petugas/tamu)
  id_kamar INT NOT NULL,
  nama_tamu VARCHAR(100) NOT NULL,
  tanggal_masuk DATE NOT NULL,
  tanggal_keluar DATE NOT NULL,
  total_harga DECIMAL(14,2) NOT NULL,
  status ENUM('dipesan','checkin','batal','selesai') DEFAULT 'dipesan',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_kamar) REFERENCES kamar(id_kamar) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Tabel pembayaran (opsional sederhana)
CREATE TABLE IF NOT EXISTS pembayaran (
  id_pembayaran INT AUTO_INCREMENT PRIMARY KEY,
  id_pemesanan INT NOT NULL,
  jumlah_bayar DECIMAL(14,2) NOT NULL,
  metode VARCHAR(50),
  tanggal_bayar DATETIME DEFAULT CURRENT_TIMESTAMP,
  status ENUM('tertunda','lunas','gagal') DEFAULT 'tertunda',
  FOREIGN KEY (id_pemesanan) REFERENCES pemesanan(id_pemesanan) ON DELETE CASCADE ON UPDATE CASCADE
);
