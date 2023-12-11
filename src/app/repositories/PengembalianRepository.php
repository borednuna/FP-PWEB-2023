<?php

namespace App\Repositories;

use App\Models\Pengembalian;
use App\Config\Config;

class PengembalianRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
    }

    public function getAll()
    {
        $query = "SELECT * FROM pengembalian";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['denda'],
                $row['total_bayar']
            );
        }
        return $pengembalian;
    }

    public function getPengembalianByNomorPengguna($id)
    {
        $query = "SELECT * FROM pengembalian WHERE nomor_pengguna = $id";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['denda'],
                $row['total_bayar']
            );
        }
        return $pengembalian;
    }

    public function getPendingPengembalian()
    {
        $query = "SELECT * FROM pengembalian WHERE status = 'menunggu persetujuan'";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['denda'],
                $row['total_bayar']
            );
        }
        return $pengembalian;
    }

    public function setujuiPengembalian($nomor_pengembalian)
    {
        $query = "UPDATE pengembalian SET status = 'disetujui' WHERE nomor_pengembalian = $nomor_pengembalian";
        mysqli_query($this->conn, $query);
    }

    public function tolakPengembalian($nomor_pengembalian)
    {
        $query = "UPDATE pengembalian SET status = 'ditolak' WHERE nomor_pengembalian = $nomor_pengembalian";
        mysqli_query($this->conn, $query);
    }

    public function tambahPengembalian($nomor_peminjaman, $tanggal_pengembalian, $jumlah_pengembalian, $denda, $total_bayar)
    {
        $query = "INSERT INTO pengembalian (nomor_peminjaman, tanggal_pengembalian, jumlah_pengembalian, denda, total_bayar) VALUES ($nomor_peminjaman, '$tanggal_pengembalian', $jumlah_pengembalian, $denda, $total_bayar)";
        mysqli_query($this->conn, $query);
    }

    public function insert($pengembalian)
    {
        $tanggal_pengembalian = date("Y-m-d");

        $query = "INSERT INTO pengembalian (nomor_peminjaman, tanggal_pengembalian, jumlah_pengembalian, denda, total_bayar) VALUES ($pengembalian->nomor_peminjaman, '$tanggal_pengembalian', $pengembalian->jumlah_pengembalian, $pengembalian->denda, $pengembalian->total_bayar)";
        mysqli_query($this->conn, $query);
    }
}