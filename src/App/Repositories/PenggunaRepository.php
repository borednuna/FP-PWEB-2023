<?php

namespace App\Repositories;

use App\Models\Pengguna;
use App\Config\Config;

class PenggunaRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect((new Config())->hostname, (new Config())->username, (new Config())->password, (new Config())->dbname);
    }

    public function getAll()
    {
        $query = "SELECT * FROM pengguna";
        $result = mysqli_query($this->conn, $query);
        $pengguna = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $pengguna[] = new Pengguna(
                $row['nomor_pengguna'],
                $row['nama'],
                $row['email'],
                $row['password'],
                $row['alamat'],
                $row['role']
            );
        }
        return $pengguna;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM pengguna WHERE nomor_pengguna = $id";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $pengguna = new Pengguna(
            $row['nomor_pengguna'],
            $row['nama'],
            $row['email'],
            $row['password'],
            $row['alamat'],
            $row['role']
        );
        return $pengguna;
    }

    public function getByUsername($username)
    {
        $query = "SELECT * FROM pengguna WHERE nama LIKE '%$username%'";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        $pengguna = new Pengguna(
            1,
            $row['nama'],
            $row['email'],
            $row['password'],
            $row['alamat'],
            $row['role']
        );
        return $pengguna;
    }

    public function registerPengguna($pengguna)
    {
        $tanggal_bergabung = date("Y-m-d");

        $query = "INSERT INTO pengguna (nama, email, password, alamat, role, tanggal_bergabung, updated_at) VALUES ('$pengguna->nama_pengguna', '$pengguna->email', '$pengguna->password', '$pengguna->alamat', '$pengguna->role', '$tanggal_bergabung', '2023-01-03 12:00:00')";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // public function update($pengguna)
    // {
    //     $query = "UPDATE pengguna SET nama = '$pengguna->nama', username = '$pengguna->username', password = '$pengguna->password', role = '$pengguna->role' WHERE id = $pengguna->id";
    //     $result = mysqli_query($this->conn, $query);
    //     return $result;
    // }

    // public function delete($id)
    // {
    //     $query = "DELETE FROM pengguna WHERE id = $id";
    //     $result = mysqli_query($this->conn, $query, $id);
    //     return $result;
    // }
}
