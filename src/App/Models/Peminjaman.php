<?php

namespace App\Models;

class Peminjaman
{
    public int $nomor_peminjaman;
    public int $nomor_pengguna;
    public string $tanggal_peminjaman;
    public string $jatuh_tempo;
    public string $status;
    public int $jumlah_peminjaman;
    public float $bunga;
    public int $total_bayar;

    public function __construct(
        int $nomor_peminjaman,
        int $nomor_pengguna,
        string $tanggal_peminjaman,
        string $jatuh_tempo,
        string $status,
        int $jumlah_peminjaman,
        float $bunga,
        int $total_bayar
    ) {
        $this->nomor_peminjaman = $nomor_peminjaman;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->tanggal_peminjaman = $tanggal_peminjaman;
        $this->jatuh_tempo = $jatuh_tempo;
        $this->status = $status;
        $this->jumlah_peminjaman = $jumlah_peminjaman;
        $this->bunga = 0.125;
        $this->total_bayar = $total_bayar;
    }
}