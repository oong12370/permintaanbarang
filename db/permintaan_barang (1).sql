-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Jan 2019 pada 20.45
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `permintaan_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_barang`
--

CREATE TABLE IF NOT EXISTS `jenis_barang` (
  `id_jenis` varchar(50) NOT NULL,
  `jenis_brg` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis`, `jenis_brg`) VALUES
('1', 'Kabel Fiber Optik'),
('2', 'Kabel UTP'),
('3', 'Roset');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemakaian`
--

CREATE TABLE IF NOT EXISTS `pemakaian` (
  `id_pemakaian` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kode_brg` varchar(5) NOT NULL,
  `projek` varchar(100) NOT NULL,
  `nik` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_pakai` date NOT NULL,
  PRIMARY KEY (`id_pemakaian`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `pemakaian`
--

INSERT INTO `pemakaian` (`id_pemakaian`, `id_user`, `kode_brg`, `projek`, `nik`, `qty`, `tgl_pakai`) VALUES
(6, 3, 'BR001', 'projek1', 678587, 1, '2019-01-21'),
(7, 3, 'BR001', 'projek2', 678587, 1, '2019-01-28'),
(8, 3, 'BR001', 'projek1', 776878, 7, '2019-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran_barang`
--

CREATE TABLE IF NOT EXISTS `pengeluaran_barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permintaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `pengeluaran_barang`
--

INSERT INTO `pengeluaran_barang` (`id`, `id_permintaan`, `id_user`, `kode_brg`, `jumlah`, `tgl_keluar`) VALUES
(16, 16, 3, 'BR001', 2, '2019-01-21'),
(17, 18, 3, 'BR005', 1, '2019-01-21'),
(18, 19, 3, 'BR007', 1, '2019-01-21'),
(19, 34, 3, 'BR003', 2, '2019-01-28'),
(20, 30, 3, 'BR005', 4, '2019-01-28'),
(21, 33, 3, 'BR007', 2, '2019-01-28'),
(22, 35, 3, 'BR005', 1, '2019-01-28'),
(23, 32, 3, 'BR004', 1, '2019-01-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan`
--

CREATE TABLE IF NOT EXISTS `permintaan` (
  `id_permintaan` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kode_brg` varchar(5) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `nik` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_permintaan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data untuk tabel `permintaan`
--

INSERT INTO `permintaan` (`id_permintaan`, `id_user`, `kode_brg`, `id_jenis`, `jumlah`, `tgl_permintaan`, `nik`, `status`) VALUES
(16, 3, 'BR001', 1, 1, '2019-01-21', 678587, 1),
(18, 3, 'BR005', 2, 1, '2019-01-21', 678587, 1),
(17, 3, 'BR007', 3, 2, '2019-01-21', 776878, 2),
(19, 3, 'BR007', 3, 1, '2019-01-21', 776878, 1),
(34, 3, 'BR003', 1, 2, '2019-01-28', 678587, 1),
(33, 3, 'BR007', 3, 2, '2019-01-28', 678587, 1),
(32, 3, 'BR004', 1, 1, '2019-01-28', 2147483647, 1),
(31, 3, 'BR006', 2, 2, '2019-01-28', 678587, 2),
(30, 3, 'BR005', 2, 4, '2019-01-28', 678587, 1),
(35, 3, 'BR005', 2, 1, '2019-01-28', 678587, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sementara`
--

CREATE TABLE IF NOT EXISTS `sementara` (
  `id_sementara` int(100) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `kode_brg` varchar(5) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `nik` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_sementara`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stokbarang`
--

CREATE TABLE IF NOT EXISTS `stokbarang` (
  `kode_brg` varchar(5) NOT NULL,
  `id_jenis` int(2) NOT NULL,
  `nama_brg` varchar(30) NOT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  PRIMARY KEY (`kode_brg`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stokbarang`
--

INSERT INTO `stokbarang` (`kode_brg`, `id_jenis`, `nama_brg`, `satuan`, `stok`, `tgl_masuk`) VALUES
('BR001', 1, 'PRECONECTOR 50', 'Pcs', 299, '2019-01-09'),
('BR002', 1, 'PRECONECTOR 75', 'Pcs', 200, '2019-01-11'),
('BR003', 1, 'PRECONECTOR 100', 'Pcs', 98, '2019-01-16'),
('BR004', 1, 'PRECONECTOR 150', 'Pcs', 121, '2019-01-20'),
('BR005', 2, 'KABEL UTP CAT 6', 'Meter', 199, '2019-01-21'),
('BR006', 2, 'DROPCORE', 'Meter', 90, '2019-01-21'),
('BR007', 3, 'ROSET ', 'Pcs', 158, '2019-01-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `teknisi`
--

CREATE TABLE IF NOT EXISTS `teknisi` (
  `nik` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `mitra` varchar(50) NOT NULL,
  `tim` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teknisi`
--

INSERT INTO `teknisi` (`nik`, `nama`, `mitra`, `tim`) VALUES
(678587, 'yuda aja', 'PT.YZN', '2'),
(776878, 'Eri', 'PT.YZN', '2'),
(2147483647, 'OONG JULIA FIRNANADA', 'PT.YZN', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('leader','admin_gudang','asisten_manajer') NOT NULL,
  `manajer` varchar(50) NOT NULL,
  `asmen` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `manajer`, `asmen`) VALUES
(1, 'Admin_gudang', '827ccb0eea8a706c4c34a16891f84e7b', 'admin_gudang', 'M. Azharuddin, S.T', 'Merry Ariyanda, A.Md'),
(2, 'Asmen', '827ccb0eea8a706c4c34a16891f84e7b', 'asisten_manajer', 'M. Azharuddin, S.T', 'Irwan Saputra, A.Md'),
(3, 'Untung', '827ccb0eea8a706c4c34a16891f84e7b', 'leader', 'Nuzul Fitrie, S.H', 'Muhammad Ridwan, A.Md');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
