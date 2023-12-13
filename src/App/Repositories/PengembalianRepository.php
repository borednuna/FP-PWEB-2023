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
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
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
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
            );
        }
        return $pengembalian;
    }

    public function getByBulanTahun($datetime)
    {
        $month = $datetime->format('m');
        $year = $datetime->format('Y');

        $query = "SELECT * FROM pengembalian WHERE MONTH(tanggal_pengembalian) = $month AND YEAR(tanggal_pengembalian) = $year";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
            );
        }
        return $pengembalian;
    }

    public function getPengembalianById($id)
    {
        $query = "SELECT * FROM pengembalian WHERE nomor_pengembalian = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $pengembalian = new Pengembalian(
            $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
        );
        return $pengembalian;
    }

    public function getAllPengembalianByNomorPeminjaman($id)
    {
        $query = "SELECT * FROM pengembalian WHERE nomor_peminjaman = $id";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
            );
        }
        return $pengembalian;
    }

    public function getPendingPengembalian()
    {
        $query = "SELECT * FROM pengembalian WHERE status = 'menunggu verifikasi'";
        $result = mysqli_query($this->conn, $query);
        $pengembalian = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengembalian[] = new Pengembalian(
                $row['nomor_pengembalian'],
                $row['nomor_peminjaman'],
                $row['nomor_pengguna'],
                $row['tanggal_pengembalian'],
                $row['jumlah_pengembalian'],
                $row['status'],
                $row['sisa_pinjaman'],
                $row['bukti_bayar']
            );
        }
        return $pengembalian;
    }

    public function updatePengembalianStatus($nomor_pengembalian, $status)
    {
        $query = "UPDATE pengembalian SET status = '$status' WHERE nomor_pengembalian = $nomor_pengembalian";
        mysqli_query($this->conn, $query);
    }

    public function insert($pengembalian)
    {
        $query = "INSERT INTO pengembalian (
            nomor_peminjaman,
            nomor_pengguna,
            tanggal_pengembalian,
            jumlah_pengembalian,
            status,
            sisa_pinjaman,
            bukti_bayar,
            updated_at
        ) VALUES (
            $pengembalian->nomor_peminjaman,
            $pengembalian->nomor_pengguna,
            '$pengembalian->tanggal_pengembalian',
            $pengembalian->jumlah_pengembalian,
            '$pengembalian->status',
            $pengembalian->sisa_pinjaman,
            '$pengembalian->bukti_bayar',
            '2023-01-03 12:00:00'
        )";
        mysqli_query($this->conn, $query);
    }
}