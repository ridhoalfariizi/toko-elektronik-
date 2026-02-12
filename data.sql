-- ============================================
-- Database: db_toko_elektronik
-- ============================================

CREATE DATABASE IF NOT EXISTS `db_toko_elektronik`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `db_toko_elektronik`;

-- ============================================
-- Tabel: produk
-- ============================================

CREATE TABLE IF NOT EXISTS `produk` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `thumbnail` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Nama file gambar yang di-upload',
    `kategori` VARCHAR(100) NOT NULL,
    `produk` VARCHAR(150) NOT NULL,
    `harga` INT NOT NULL,
    `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Data Awal (thumbnail NULL karena belum ada file upload)
-- ============================================

INSERT INTO `produk` (`thumbnail`, `kategori`, `produk`, `harga`) VALUES
(NULL, 'Iphone', 'Iphone 13 Pro', 12000000),
(NULL, 'Android', 'Samsung Z Flip', 20000000),
(NULL, 'Android', 'Xiaomi Redmi Note 11 Pro', 3200000);
