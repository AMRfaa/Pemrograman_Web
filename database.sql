CREATE DATABASE IF NOT EXISTS kasir_toko_roti;
USE kasir_toko_roti;

CREATE TABLE IF NOT EXISTS users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  no_hp VARCHAR(15) NOT NULL,
  email VARCHAR(50) NOT NULL,
  role ENUM('admin', 'kasir') DEFAULT 'kasir'
);

INSERT INTO users (username, password, no_hp, email, role) VALUES 
('ghaisan', '123', '08123456789', 'admin1@tokoroti.com', 'admin'),
('imas', '123', '08987654321', 'kasir1@tokoroti.com', 'kasir');

CREATE TABLE IF NOT EXISTS roti (
  id_roti INT(11) AUTO_INCREMENT PRIMARY KEY,
  nama_roti VARCHAR(100) NOT NULL,
  harga INT(11) NOT NULL,
  stok INT(11) NOT NULL
);

INSERT INTO roti (nama_roti, harga, stok) VALUES 
('Roti Coklat', 5000, 50), 
('Roti Keju Susu', 6000, 30),
('Roti Pisang Coklat', 4500, 40),
('Roti Abon Sapi', 7000, 25),
('Donat Gula', 3000, 60);
