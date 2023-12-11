<?php

namespace App\Models;

class Pengguna
{
    private int $nomor_pengguna;
    private string $nama_pengguna;
    private string $email;
    private string $password;
    private string $alamat;
    private string $role;
    private \DateTime $tanggal_bergabung;

    public function __construct(
        int $nomor_pengguna,
        string $nama_pengguna,
        string $email,
        string $password,
        string $alamat,
        string $role,
        \DateTime $tanggal_bergabung
    ) {
        $this->nomor_pengguna = $nomor_pengguna;
        $this->nama_pengguna = $nama_pengguna;
        $this->email = $email;
        $this->password = $password;
        $this->alamat = $alamat;
        $this->role = $role;
        $this->tanggal_bergabung = $tanggal_bergabung;
    }
}