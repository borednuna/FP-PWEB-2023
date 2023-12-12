<?php

namespace App\Models;

class LaporanAnggota
{
    public int $nomor_laporan;
    public int $nomor_pengguna;
    public int $nomor_laporan_keuangan_ketua;
    public string $tanggal_laporan;
    public string $bulan;
    public int $tahun;
    public int $jumlah_peminjaman;
    public int $jumlah_pengembalian;
    public int $sisa_pinjaman;

    public function __construct(
        int $nomor_laporan,
        int $nomor_pengguna,
        int $nomor_laporan_keuangan_ketua,
        string $tanggal_laporan,
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
