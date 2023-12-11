<?php

namespace App\Repositories;

use App\Models\LaporanKeuanganKetua;
use App\Config\Config;
use App\Repositories\BulanEnum;

class LaporanKeuanganKetuaRepository
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

    public function create(LaporanKeuanganKetua $laporanKeuanganKetua)
    {
        $tanggal_laporan = (string) $laporanKeuanganKetua->tanggal_laporan;
        $query = "INSERT INTO laporan_keuangan_ketua(
            nomor_pengguna,
            bulan,
            tahun,
            tanggal_laporan,
            jumlah_peminjaman,
            jumlah_pengembalian
        ) VALUES (
            $this->nomor_pengguna,
            $laporanKeuanganKetua->bulan,
            $laporanKeuanganKetua->tahun,
            $tanggal_laporan,
            $laporanKeuanganKetua->jumlah_peminjaman,
            $laporanKeuanganKetua->jumlah_pengembalian
        )";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function getAll()
    {
        $query = "SELECT * FROM laporan_keuangan_ketua";
        $result = mysqli_query($this->conn, $query);
        $laporanKeuanganKetua = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporanKeuanganKetua[] = new LaporanKeuanganKetua(
                $row['nomor_laporan'],
                $row['bulan'],
                $row['tahun'],
                $row['tanggal_laporan'],
                $row['jumlah_peminjaman'],
                $row['jumlah_pengembalian']
            );
        }
        return $laporanKeuanganKetua;
    }

    public function getByBulanTahun($bulan, $tahun)
    {
        $query = "SELECT * FROM laporan_keuangan_ketua WHERE bulan = $bulan AND tahun = $tahun";
        $result = mysqli_query($this->conn, $query);
        $laporanKeuanganKetua = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporanKeuanganKetua[] = new LaporanKeuanganKetua(
                $row['nomor_laporan'],
                $row['bulan'],
                $row['tahun'],
                $row['tanggal_laporan'],
                $row['jumlah_peminjaman'],
                $row['jumlah_pengembalian']
            );
        }
        return $laporanKeuanganKetua;
    }
}