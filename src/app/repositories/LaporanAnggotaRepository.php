<?php

namespace App\Repositories;

use App\Models\LaporanAnggota;
use App\Config\Config;

class LaporanAnggotaRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
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

    public function insert($laporan_anggota)
    {
        $tanggal_laporan = $laporan_anggota->tanggal_laporan->format('Y-m-d');

        $query = "INSERT INTO laporan_anggota VALUES (
            $laporan_anggota->nomor_laporan,
            $laporan_anggota->nomor_pengguna,
            $laporan_anggota->nomor_laporan_keuangan_ketua,
            $laporan_anggota->bulan,
            $laporan_anggota->tahun,
            $tanggal_laporan,
            $laporan_anggota->jumlah_peminjaman,
            $laporan_anggota->jumlah_pengembalian,
            $laporan_anggota->sisa_pinjaman
        )";
        mysqli_query($this->conn, $query);
    }
}