<?php

namespace App\Repositories;

use App\Models\LaporanKeuanganKetua;
use App\Config\Config;
use App\Repositories\BulanEnum;

class LaporanKeuanganKetuaRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
    }

    public function create(LaporanKeuanganKetua $laporanKeuanganKetua)
    {
        $query = "INSERT INTO laporan_keuangan_ketua (nomor_laporan_keuangan_ketua, nomor_pengguna, tanggal_laporan_keuangan_ketua, jumlah_laporan_keuangan_ketua, decimal_laporan_keuangan_ketua, total_laporan_keuangan_ketua) VALUES ('" . $laporanKeuanganKetua->getNomorLaporanKeuanganKetua() . "', '" . $laporanKeuanganKetua->getNomorPengguna() . "', '" . $laporanKeuanganKetua->getTanggalLaporanKeuanganKetua()->format("Y-m-d") . "', '" . $laporanKeuanganKetua->getJumlahLaporanKeuanganKetua() . "', '" . $laporanKeuanganKetua->getDecimalLaporanKeuanganKetua() . "', '" . $laporanKeuanganKetua->getTotalLaporanKeuanganKetua() . "')";
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
                $row['nomor_laporan_keuangan_ketua'],
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
        $query = "SELECT * FROM laporan_keuangan_ketua WHERE bulan = '" . $bulan . "' AND tahun = '" . $tahun . "'";
        $result = mysqli_query($this->conn, $query);
        $laporanKeuanganKetua = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $laporanKeuanganKetua[] = new LaporanKeuanganKetua(
                $row['nomor_laporan_keuangan_ketua'],
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