<?php

namespace App\Repositories;

use App\Models\Peminjaman;
use App\Config\Config;

class PeminjamanRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
    }

    public function getAll()
    {
        $query = "SELECT * FROM peminjaman";
        $result = mysqli_query($this->conn, $query);
        $peminjaman = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $peminjaman[] = new Peminjaman(
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_peminjaman'],
                $row['jatuh_tempo'],
                $row['jumlah_peminjaman'],
                $row['bunga'],
                $row['total_bayar']
            );
        }
        return $peminjaman;
    }

    public function getPendingPeminjaman()
    {
        $query = "SELECT * FROM peminjaman WHERE status = 'menunggu persetujuan'";
        $result = mysqli_query($this->conn, $query);
        $peminjaman = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $peminjaman[] = new Peminjaman(
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_peminjaman'],
                $row['jatuh_tempo'],
                $row['jumlah_peminjaman'],
                $row['bunga'],
                $row['total_bayar']
            );
        }
        return $peminjaman;
    }

    public function getPeminjamanByNomorPengguna($id)
    {
        $query = "SELECT * FROM peminjaman WHERE nomor_pengguna = $id";
        $result = mysqli_query($this->conn, $query);
        $peminjaman = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $peminjaman[] = new Peminjaman(
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_peminjaman'],
                $row['jatuh_tempo'],
                $row['jumlah_peminjaman'],
                $row['bunga'],
                $row['total_bayar']
            );
        }
        return $peminjaman;
    }

    public function getByBulanTahun($bulan, $tahun)
    {
        $query = "SELECT * FROM peminjaman WHERE bulan = '" . $bulan . "' AND tahun = '" . $tahun . "'";
        $result = mysqli_query($this->conn, $query);
        $peminjaman = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $peminjaman[] = new Peminjaman(
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_peminjaman'],
                $row['jatuh_tempo'],
                $row['jumlah_peminjaman'],
                $row['bunga'],
                $row['total_bayar']
            );
        }
        return $peminjaman;
    }

    public function setujuiPeminjaman($nomor_peminjaman)
    {
        $query = "UPDATE peminjaman SET status = 'disetujui' WHERE nomor_peminjaman = $nomor_peminjaman";
        mysqli_query($this->conn, $query);
    }

    public function tolakPeminjaman($nomor_peminjaman)
    {
        $query = "UPDATE peminjaman SET status = 'ditolak' WHERE nomor_peminjaman = $nomor_peminjaman";
        mysqli_query($this->conn, $query);
    }

    public function pinjamanLunas($nomor_peminjaman)
    {
        $query = "UPDATE peminjaman SET status = 'lunas' WHERE nomor_peminjaman = $nomor_peminjaman";
        mysqli_query($this->conn, $query);
    }

    public function insertPeminjaman($nomor_pengguna, $jatuh_tempo, $jumlah_peminjaman, $bunga, $total_bayar)
    {
        $tanggal_peminjaman = date('Y-m-d');

        $query = "INSERT INTO peminjaman (nomor_pengguna, tanggal_peminjaman, jatuh_tempo, jumlah_peminjaman, bunga, total_bayar) VALUES ('$nomor_pengguna', '$tanggal_peminjaman', '$jatuh_tempo', '$jumlah_peminjaman', '$bunga', '$total_bayar')";
        mysqli_query($this->conn, $query);
    }
}