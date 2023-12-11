<?php

namespace App\Models;

class Pengembalian
{
    private int $nomor_pengembalian;
    private int $nomor_peminjaman;
    private int $nomor_pengguna;
    private \DateTime $tanggal_pengembalian;
    private int $jumlah_pengembalian;
    private string $status;
    private string $bukti_bayar;

    public function __construct(
        int $nomor_pengembalian,
        int $nomor_peminjaman,
        int $nomor_pengguna,
        \DateTime $tanggal_pengembalian,
        int $jumlah_pengembalian,
        string $bukti_bayar
    ) {
        $this->nomor_pengembalian = $nomor_pengembalian;
        $this->nomor_peminjaman = $nomor_peminjaman;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->tanggal_pengembalian = $tanggal_pengembalian;
        $this->jumlah_pengembalian = $jumlah_pengembalian;
        $this->status = "menunggu verifikasi";
        $this->bukti_bayar = $bukti_bayar;
    }
}