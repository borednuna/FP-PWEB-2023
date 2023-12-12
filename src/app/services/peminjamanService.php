<?php

namespace App\Services;

use App\Models\Peminjaman;
use App\Repositories\PeminjamanRepository;

class PeminjamanService
{
    private $peminjamanRepository;

    public function __construct()
    {
        $this->peminjamanRepository = new PeminjamanRepository();
    }

    public function getAll()
    {
        $result = $this->peminjamanRepository->getAll();
        return $result;
    }

    public function getPendingPeminjaman()
    {
        $result = $this->peminjamanRepository->getPendingPeminjaman();
        return $result;
    }

    public function getPeminjamanByNomorPengguna($id)
    {
        $result = $this->peminjamanRepository->getPeminjamanByNomorPengguna($id);
        return $result;
    }

    public function create($data)
    {
        $duration_in_month = (strtotime($data['jatuh_tempo']) - strtotime($data['tanggal_peminjaman'])) / (60 * 60 * 24 * 30);
        $suku_bunga = $data['bunga'] * $data['jumlah_peminjaman'] * $duration_in_month;
        $total_bayar = $data['jumlah_peminjaman'] + $suku_bunga;

        $peminjaman = new Peminjaman(
            $data['nomor_peminjaman'],
            $data['nomor_pengguna'],
            $data['tanggal_peminjaman'],
            $data['jatuh_tempo'],
            $data['jumlah_peminjaman'],
            $data['bunga'],
            $total_bayar
        );
        $result = $this->peminjamanRepository->insertPeminjaman($peminjaman);
        return $result;
    }

    public function setujuiPeminjaman($nomor_peminjaman)
    {
        $result = $this->peminjamanRepository->updatePeminjamanStatus($nomor_peminjaman, 'disetujui');
        return $result;
    }

    public function tolakPeminjaman($nomor_peminjaman)
    {
        $result = $this->peminjamanRepository->updatePeminjamanStatus($nomor_peminjaman, 'ditolak');
        return $result;
    }

    public function lunasPeminjaman($nomor_peminjaman)
    {
        $result = $this->peminjamanRepository->updatePeminjamanStatus($nomor_peminjaman, 'lunas');
        return $result;
    }
}