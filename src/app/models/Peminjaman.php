<?php

namespace App\Models;

class Peminjaman
{
    public int $nomor_peminjaman;
    public int $nomor_pengguna;
    public \DateTime $tanggal_peminjaman;
    public \DateTime $jatuh_tempo;
    public string $status;
    public int $jumlah_peminjaman;
    public float $bunga;
    public int $total_bayar;

    public function __construct(
        int $nomor_peminjaman,
        int $nomor_pengguna,
        \DateTime $tanggal_peminjaman,
        \DateTime $jatuh_tempo,
        int $jumlah_peminjaman,
        int $total_bayar
    ) {
        $this->nomor_peminjaman = $nomor_peminjaman;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->tanggal_peminjaman = $tanggal_peminjaman;
        $this->jatuh_tempo = $jatuh_tempo;
        $this->status = "menunggu persetujuan";
        $this->jumlah_peminjaman = $jumlah_peminjaman;
        $this->bunga = 0.125;
        $this->total_bayar = $total_bayar;
    }
}