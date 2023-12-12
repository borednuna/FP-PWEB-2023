<?php

namespace App\Models;

class Pengembalian
{
    public int $nomor_pengembalian;
    public int $nomor_peminjaman;
    public int $nomor_pengguna;
    public \DateTime $tanggal_pengembalian;
    public int $jumlah_pengembalian;
    public int $sisa_pengembalian;
    public string $status;
    public string $bukti_bayar;

    public function __construct(
        int $nomor_pengembalian,
        int $nomor_peminjaman,
        int $nomor_pengguna,
        \DateTime $tanggal_pengembalian,
        int $jumlah_pengembalian,
        int $sisa_pengembalian,
        string $bukti_bayar
    ) {
        $this->nomor_pengembalian = $nomor_pengembalian;
        $this->nomor_peminjaman = $nomor_peminjaman;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->tanggal_pengembalian = $tanggal_pengembalian;
        $this->jumlah_pengembalian = $jumlah_pengembalian;
        $this->status = "menunggu verifikasi";
        $this->sisa_pengembalian = $sisa_pengembalian;
        $this->bukti_bayar = $bukti_bayar;
    }
}