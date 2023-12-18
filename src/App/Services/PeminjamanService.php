<?php

namespace App\Services;

use App\Models\Peminjaman;
use App\Repositories\PeminjamanRepository;

class PeminjamanService
{
    private $peminjamanRepository;
    private $nomor_pengguna;

    public function __construct()
    {
        $this->peminjamanRepository = new PeminjamanRepository();
        
        if (isset($_COOKIE['nomor_pengguna'])) {
            $this->nomor_pengguna = intval($_COOKIE['nomor_pengguna']);

        } else {
            $this->nomor_pengguna = null;
        }
    }

    public function getAll()
    {
        var_dump($this->nomor_pengguna);
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
        $bunga = 0.125;
        // today
        $today = date('Y-m-d H:i:s');
        // 1 month from today
        $one_month_from_today = date('Y-m-d H:i:s', strtotime('+1 month'));
        $duration_in_month = (int) date_diff(date_create($today), date_create($one_month_from_today))->format('%m');
        $suku_bunga = $bunga * $data['jumlah_peminjaman'] * $duration_in_month;
        $total_bayar = $data['jumlah_peminjaman'] + $suku_bunga;

        // datetime now
        $tanggal_peminjaman = date('Y-m-d H:i:s');
        $jatuh_tempo = date('Y-m-d H:i:s', strtotime('+1 month'));

        // datetime to string
        $tanggal_peminjaman = date('Y-m-d H:i:s', strtotime($tanggal_peminjaman));
        $jatuh_tempo = date('Y-m-d H:i:s', strtotime($jatuh_tempo));

        $peminjaman = new Peminjaman(
            1,
            $this->nomor_pengguna,
            $tanggal_peminjaman,
            $jatuh_tempo,
            'menunggu persetujuan',
            $data['jumlah_peminjaman'],
            0.125,
            $total_bayar = intval($total_bayar)
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