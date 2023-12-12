<?php

namespace App\Repositories;

use App\Models\LaporanAnggota;
use App\Config\Config;

use App\Repositories\BulanEnum;

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
                $row['nomor_laporan_keuangan_ketua'] == null ? 1 : $row['nomor_laporan_keuangan_ketua'],
                $row['bulan'],
                $row['tahun'],
                intval($row['tanggal_laporan']),
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
            $tahun = intval($row['tahun']);
            $laporan_anggota[] = new LaporanAnggota(
                $row['nomor_laporan'],
                $row['nomor_pengguna'],
                $row['nomor_laporan_keuangan_ketua'] == null ? 1 : $row['nomor_laporan_keuangan_ketua'],
                $row['tanggal_laporan'],
                $row['bulan'],
                $tahun,
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
        
        // get month string
        $month_string = BulanEnum::getBulan($month);
        $year_int = intval($year);

        $query = "SELECT * FROM laporan_anggota WHERE bulan = '$month_string' AND tahun = $year_int AND nomor_pengguna = $this->nomor_pengguna";
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
        $query = "INSERT INTO laporan_anggota (
            nomor_pengguna,
            nomor_laporan_keuangan_ketua,
            bulan,
            tahun,
            tanggal_laporan,
            jumlah_peminjaman,
            jumlah_pengembalian,
            sisa_pinjaman,
            updated_at
        ) VALUES (
            $laporan_anggota->nomor_pengguna,
            null,
            '$laporan_anggota->bulan',
            $laporan_anggota->tahun,
            '$laporan_anggota->tanggal_laporan',
            $laporan_anggota->jumlah_peminjaman,
            $laporan_anggota->jumlah_pengembalian,
            $laporan_anggota->sisa_pinjaman,
            '2023-01-03 12:00:00'
        )";

        mysqli_query($this->conn, $query);
    }
}