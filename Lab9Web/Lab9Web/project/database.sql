CREATE DATABASE IF NOT EXISTS db_latihan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_latihan;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (nama, email) VALUES
('Rina Putri', 'rina@example.com'),
('Budi Santoso', 'budi@example.com'),
('Sari Wulandari', 'sari@example.com');
