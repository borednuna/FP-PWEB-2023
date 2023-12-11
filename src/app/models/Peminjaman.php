<?php

namespace App\Models;

class Peminjaman
{
    private int $nomor_peminjaman;
    private int $nomor_pengguna;
    private \DateTime $tanggal_peminjaman;
    private \DateTime $jatuh_tempo;
    private string $status;
    private int $jumlah_peminjaman;
    private float $decimal;
    private int $total_bayar;

    public function __construct(
        int $nomor_peminjaman,
        int $nomor_pengguna,
        \DateTime $tanggal_peminjaman,
        \DateTime $jatuh_tempo,
        int $jumlah_peminjaman,
        float $decimal,
        int $total_bayar
    ) {
        $this->nomor_peminjaman = $nomor_peminjaman;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->tanggal_peminjaman = $tanggal_peminjaman;
        $this->jatuh_tempo = $jatuh_tempo;
        $this->status = "menunggu persetujuan";
        $this->jumlah_peminjaman = $jumlah_peminjaman;
        $this->decimal = $decimal;
        $this->total_bayar = $total_bayar;
    }
}