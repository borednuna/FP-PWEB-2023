<?php

namespace App\Services;

use App\Models\LaporanAnggota;
use App\Repositories\LaporanAnggotaRepository;
use App\Repositories\PeminjamanRepository;
use App\Repositories\PengembalianRepository;

use App\Repositories\BulanEnum;
use DateTime;

class LaporanAnggotaService
{
    private $laporanAnggotaRepository;

    public function __construct()
    {
        $this->laporanAnggotaRepository = new LaporanAnggotaRepository();
    }

    public function getAll()
    {
        $result = $this->laporanAnggotaRepository->getAll();
        return $result;
    }

    public function getByNomorPengguna($id)
    {
        $result = $this->laporanAnggotaRepository->getLaporanAnggotaByNomorPengguna($id);
        return $result;
    }

    public function create($data)
    {
        $tanggal_laporan = new DateTime();

        // get all peminjaman by bulan and tahun
        $peminjamanRepository = new PeminjamanRepository();
        $peminjaman = $peminjamanRepository->getByBulanTahun($tanggal_laporan);

        // sum all peminjaman
        $jumlah_peminjaman = 0;
        foreach ($peminjaman as $p) {
            $jumlah_peminjaman += $p->jumlah_peminjaman;
        }

        // get all pengembalian by bulan and tahun
        $pengembalianRepository = new PengembalianRepository();
        $pengembalian = $pengembalianRepository->getByBulanTahun($tanggal_laporan);

        // sum all pengembalian
        $jumlah_pengembalian = 0;
        foreach ($pengembalian as $p) {
            $jumlah_pengembalian += $p->jumlah_pengembalian;
        }

        $bulan_str = BulanEnum::getBulan($tanggal_laporan->format('m'));
        $tahun = $tanggal_laporan->format('Y');

        $laporanAnggota = new LaporanAnggota(
            $data['nomor_laporan'],
            $data['nomor_pengguna'],
            -1,
            $tanggal_laporan,
            $bulan_str,
            $tahun,
            $jumlah_peminjaman,
            $jumlah_pengembalian,
            $jumlah_peminjaman - $jumlah_pengembalian
        );
        $this->laporanAnggotaRepository->insert($laporanAnggota);
    }

    // public function update($data)
    // {
    //     $laporanAnggota = new LaporanAnggota(
    //         $data['nomor_laporan'],
    //         $data['nomor_pengguna'],
    //         $data['tanggal_laporan'],
    //         $data['keterangan'],
    //         $data['bukti_laporan']
    //     );
    //     $this->laporanAnggotaRepository->update($laporanAnggota);
    // }

    // public function delete($id)
    // {
    //     $this->laporanAnggotaRepository->delete($id);
    // }
}