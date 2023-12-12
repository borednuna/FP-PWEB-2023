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

    public function getPeminjamanById($id)
    {
        $query = "SELECT * FROM peminjaman WHERE nomor_peminjaman = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $peminjaman = new Peminjaman(
            $row['nomor_peminjaman'],
            $row['nomor_pengguna'],
            $row['tanggal_peminjaman'],
            $row['jatuh_tempo'],
            $row['jumlah_peminjaman'],
            $row['bunga'],
            $row['total_bayar']
        );
        return $peminjaman;
    }

    public function getByBulanTahun($datetime)
    {
        $bulan = $datetime->format('m');
        $tahun = $datetime->format('Y');
        $query = "SELECT * FROM peminjaman WHERE MONTH(tanggal_peminjaman) = $bulan AND YEAR(tanggal_peminjaman) = $tahun";
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

    public function updatePeminjamanStatus($nomor_peminjaman, $status)
    {
        $query = "UPDATE peminjaman SET status = '$status' WHERE nomor_peminjaman = $nomor_peminjaman";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    public function insertPeminjaman(Peminjaman $peminjaman)
    {
        // convert tanggal peminjaman to string
        $tanggal_peminjaman = $peminjaman->tanggal_peminjaman->format('Y-m-d');

        // convert jatuh tempo to string
        $jatuh_tempo = $peminjaman->jatuh_tempo->format('Y-m-d');

        $query = "INSERT INTO peminjaman (nomor_pengguna, tanggal_peminjaman, jatuh_tempo, jumlah_peminjaman, bunga, total_bayar, status) VALUES ('$peminjaman->nomor_pengguna', '$tanggal_peminjaman', '$jatuh_tempo', '$peminjaman->jumlah_peminjaman', '$peminjaman->bunga', '$peminjaman->total_bayar', '$peminjaman->status')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }
}