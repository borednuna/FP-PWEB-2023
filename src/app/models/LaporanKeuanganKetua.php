<?php

namespace App\Models;

class LaporanKeuanganKetua
{
    private int $nomor_laporan;
    private string $bulan;
    private int $tahun;
    private \DateTime $tanggal_laporan;
    private int $jumlah_peminjaman;
    private int $jumlah_pengembalian;

    public function __construct(
        int $nomor_laporan,
        string $bulan,
        int $tahun,
        \DateTime $tanggal_laporan,
        int $jumlah_peminjaman,
        int $jumlah_pengembalian
    ) {
        $this->nomor_laporan = $nomor_laporan;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->tanggal_laporan = $tanggal_laporan;
        $this->jumlah_peminjaman = $jumlah_peminjaman;
        $this->jumlah_pengembalian = $jumlah_pengembalian;
    }
}