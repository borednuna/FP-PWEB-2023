<?php

namespace App\Models;

class LaporanAnggota
{
    private int $nomor_laporan;
    private int $nomor_pengguna;
    private int $nomor_laporan_keuangan_ketua;
    private \DateTime $tanggal_laporan;
    private string $bulan;
    private int $tahun;
    private int $jumlah_peminjaman;
    private int $jumlah_pengembalian;
    private int $sisa_pinjaman;

    public function __construct(
        int $nomor_laporan,
        int $nomor_pengguna,
        int $nomor_laporan_keuangan_ketua,
        \DateTime $tanggal_laporan,
        string $bulan,
        int $tahun,
        int $jumlah_peminjaman,
        int $jumlah_pengembalian,
        int $sisa_pinjaman
    ) {
        $this->nomor_laporan = $nomor_laporan;
        $this->nomor_pengguna = $nomor_pengguna;
        $this->nomor_laporan_keuangan_ketua = $nomor_laporan_keuangan_ketua;
        $this->tanggal_laporan = $tanggal_laporan;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->jumlah_peminjaman = $jumlah_peminjaman;
        $this->jumlah_pengembalian = $jumlah_pengembalian;
        $this->sisa_pinjaman = $sisa_pinjaman;
    }
}
