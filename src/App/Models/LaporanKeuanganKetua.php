<?php

namespace App\Models;

class LaporanKeuanganKetua
{
    public int $nomor_laporan;
    public string $bulan;
    public int $tahun;
    public string $tanggal_laporan;
    public int $jumlah_peminjaman;
    public int $jumlah_pengembalian;

    public function __construct(
        int $nomor_laporan,
        string $bulan,
        int $tahun,
        string $tanggal_laporan,
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