<?php

namespace App\Models;

class Pengguna
{
    public int $nomor_pengguna;
    public string $nama_pengguna;
    public string $email;
    public string $password;
    public string $alamat;
    public string $role;
    public \DateTime $tanggal_bergabung;

    public function __construct(
        int $nomor_pengguna,
        string $nama_pengguna,
        string $email,
        string $password,
        string $alamat,
        string $role,
    ) {
        $this->nomor_pengguna = $nomor_pengguna;
        $this->nama_pengguna = $nama_pengguna;
        $this->email = $email;
        $this->password = $password;
        $this->alamat = $alamat;
        $this->role = $role;
        $this->tanggal_bergabung = new \DateTime();
    }
}