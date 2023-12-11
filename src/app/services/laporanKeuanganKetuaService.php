<?php

namespace App\Services;

use App\Repositories\LaporanKeuanganKetuaRepository;
use App\Repositories\BulanEnum;
use App\Repositories\PeminjamanRepository;
use App\Repositories\PengembalianRepository;

use App\Models\LaporanKeuanganKetua;

class LaporanKeuanganKetuaService
{
    private $laporanKeuanganKetuaRepository;

    public function __construct()
    {
        $this->laporanKeuanganKetuaRepository = new LaporanKeuanganKetuaRepository();
    }

    public function insert($data)
    {
        $current_date = \DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        $bulan = (int) date('m');
        $year = (int) date('Y');
        $bulan_str = BulanEnum::getBulan($bulan);

        // get all peminjaman by bulan and tahun
        $peminjamanRepository = new PeminjamanRepository();
        $peminjaman = $peminjamanRepository->getByBulanTahun($current_date);

        // sum up all jumlah_peminjaman
        $jumlah_peminjaman = 0;
        foreach ($peminjaman as $p) {
            $jumlah_peminjaman += $p->jumlah_peminjaman;
        }

        // get all pengembalian by bulan and tahun
        $pengembalianRepository = new PengembalianRepository();
        $pengembalian = $pengembalianRepository->getByBulanTahun($current_date);

        // sum up all jumlah_pengembalian
        $jumlah_pengembalian = 0;
        foreach ($pengembalian as $p) {
            $jumlah_pengembalian += $p->jumlah_pengembalian;
        }
        
        $laporanKeuanganKetua = new LaporanKeuanganKetua(
            0,
            $bulan_str,
            $year,
            $current_date,
            $jumlah_peminjaman,
            $jumlah_pengembalian
        );
        $result = $this->laporanKeuanganKetuaRepository->create($laporanKeuanganKetua);
        return $result;
    }

    public function getAll()
    {
        $result = $this->laporanKeuanganKetuaRepository->getAll();
        return $result;
    }

    public function getByBulanTahun($bulan, $tahun)
    {
        $result = $this->laporanKeuanganKetuaRepository->getByBulanTahun($bulan, $tahun);
        return $result;
    }
}