<?php

namespace App\Repositories;

use App\Models\LaporanAnggota;
use App\Config\Config;

class LaporanAnggotaRepository
{
    private $conn;
    private $nomor_pengguna;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);

        if (isset($_SESSION['nomor_pengguna'])) {
            $this->nomor_pengguna = $_SESSION['nomor_pengguna'];
        }
    }

    public function getAll()
    {
        $query = "SELECT * FROM laporan_anggota";
        $result = mysqli_query($this->conn, $query);
        $laporan_anggota = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporan_anggota[] = new LaporanAnggota(
                $row['nomor_laporan'],
                $row['nomor_pengguna'],
                $row['nomor_laporan_keuangan_ketua'],
                $row['bulan'],
                $row['tahun'],
                $row['tanggal_laporan'],
                $row['jumlah_peminjaman'],
                $row['jumlah_pengembalian'],
                $row['sisa_pinjaman']
            );
        }
        return $laporan_anggota;
    }

    public function getLaporanAnggotaByNomorPengguna($id)
    {
        $query = "SELECT * FROM laporan_anggota WHERE nomor_pengguna = $id";
        $result = mysqli_query($this->conn, $query);
        $laporan_anggota = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporan_anggota[] = new LaporanAnggota(
                $row['nomor_laporan'],
                $row['nomor_pengguna'],
                $row['nomor_laporan_keuangan_ketua'],
                $row['bulan'],
                $row['tahun'],
                $row['tanggal_laporan'],
                $row['jumlah_peminjaman'],
                $row['jumlah_pengembalian'],
                $row['sisa_pinjaman']
            );
        }
        return $laporan_anggota;
    }

    public function getLaporanAnggotaByBulanTahun($datetime)
    {
        $month = $datetime->format('m');
        $year = $datetime->format('Y');

        $query = "SELECT * FROM laporan_anggota WHERE bulan = $month AND tahun = $year AND nomor_pengguna = $this->nomor_pengguna";
        $result = mysqli_query($this->conn, $query);
        $laporan_anggota = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporan_anggota[] = new LaporanAnggota(
                $row['nomor_laporan'],
                $row['nomor_pengguna'],
                $row['nomor_laporan_keuangan_ketua'],
                $row['bulan'],
                $row['tahun'],
                $row['tanggal_laporan'],
                $row['jumlah_peminjaman'],
                $row['jumlah_pengembalian'],
                $row['sisa_pinjaman']
            );
        }
        return $laporan_anggota;
    }

    public function createLaporanAnggota($laporan_anggota)
    {
        $query = "INSERT INTO laporan_anggota(
            nomor_pengguna,
            nomor_laporan_keuangan_ketua,
            bulan,
            tahun,
            tanggal_laporan,
            jumlah_peminjaman,
            jumlah_pengembalian,
            sisa_pinjaman
        ) VALUES (
            $laporan_anggota->nomor_pengguna,
            $laporan_anggota->nomor_laporan_keuangan_ketua,
            $laporan_anggota->bulan,
            $laporan_anggota->tahun,
            $laporan_anggota->tanggal_laporan,
            $laporan_anggota->jumlah_peminjaman,
            $laporan_anggota->jumlah_pengembalian,
            $laporan_anggota->sisa_pinjaman
        )";
        mysqli_query($this->conn, $query);
    }
}