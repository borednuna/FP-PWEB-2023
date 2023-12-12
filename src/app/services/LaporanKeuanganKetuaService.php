<?php

namespace App\Services;

use App\Repositories\LaporanKeuanganKetuaRepository;
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
        $laporanKeuanganKetua = new LaporanKeuanganKetua(
            $data['nomor_laporan'],
            $data['bulan'],
            $data['tahun'],
            $data['tanggal_laporan'],
            $data['jumlah_peminjaman'],
            $data['jumlah_pengembalian']
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