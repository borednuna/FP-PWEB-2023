-- Enumerate for role
-- CREATE TYPE role_pengguna AS ENUM ('sekretaris', 'anggota', 'ketua');

-- Enumerate for peminjaman status
-- CREATE TYPE peminjaman_status AS ENUM ('menunggu persetujuan', 'disetujui', 'ditolak', 'lunas');

-- Enumerate for pengembalian status
-- CREATE TYPE pengembalian_status AS ENUM ('menunggu verifikasi', 'disetujui', 'ditolak');

-- Enumerate for bulan
-- CREATE TYPE bulan AS ENUM ('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember');

-- Table pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `nomor_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `role` ENUM ('sekretaris', 'anggota', 'ketua'),
  `tanggal_bergabung` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`nomor_pengguna`),
  UNIQUE KEY `email` (`email`)
);

-- Table peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `nomor_peminjaman` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_pengguna` int(11) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `jatuh_tempo` datetime NOT NULL,
  `status` ENUM ('menunggu persetujuan', 'disetujui', 'ditolak', 'lunas'),
  `jumlah_peminjaman` int(11) NOT NULL,
  `bunga` decimal(10,2) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`nomor_peminjaman`),
  FOREIGN KEY (`nomor_pengguna`) REFERENCES `pengguna` (`nomor_pengguna`)
);

-- Table pengembalian
CREATE TABLE IF NOT EXISTS `pengembalian` (
  `nomor_pengembalian` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_peminjaman` int(11) NOT NULL,
  `nomor_pengguna` int(11) NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `jumlah_pengembalian` int(11) NOT NULL,
  `status` ENUM ('menunggu verifikasi', 'disetujui', 'ditolak'),
  `bukti_bayar` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`nomor_pengembalian`),
  FOREIGN KEY (`nomor_peminjaman`) REFERENCES `peminjaman` (`nomor_peminjaman`),
  FOREIGN KEY (`nomor_pengguna`) REFERENCES `pengguna` (`nomor_pengguna`)
);

-- Table laporan anggota
CREATE TABLE IF NOT EXISTS `laporan_anggota` (
  `nomor_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_pengguna` int(11) NOT NULL,
  `bulan` ENUM ('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'),
  `tahun` int(11) NOT NULL,
  `tanggal_laporan` datetime NOT NULL,
  `jumlah_peminjaman` int(11) NOT NULL,
  `jumlah_pengembalian` int(11) NOT NULL,
  `sisa_pinjaman` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`nomor_laporan`),
  FOREIGN KEY (`nomor_pengguna`) REFERENCES `pengguna` (`nomor_pengguna`)
);

-- Table laporan keuangan ketua
CREATE TABLE IF NOT EXISTS `laporan_keuangan_ketua` (
  `nomor_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `bulan` ENUM ('januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'),
  `tahun` int(11) NOT NULL,
  `tanggal_laporan` datetime NOT NULL,
  `jumlah_peminjaman` int(11) NOT NULL,
  `jumlah_pengembalian` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`nomor_laporan`)
);
