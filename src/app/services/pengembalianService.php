<?php

namespace App\Services;

use App\Models\Pengembalian;
use App\Repositories\PengembalianRepository;
use App\Repositories\PeminjamanRepository;

class pengembalianService
{
    private $pengembalianRepository;

    public function __construct()
    {
        $this->pengembalianRepository = new PengembalianRepository();
    }

    public function getAll()
    {
        $result = $this->pengembalianRepository->getAll();
        return $result;
    }

    public function getByNomorPengguna($id)
    {
        $result = $this->pengembalianRepository->getPengembalianByNomorPengguna($id);
        return $result;
    }

    public function create($data)
    {
        // get peminjaman
        $peminjamanRepository = new PeminjamanRepository();
        $peminjaman = $peminjamanRepository->getPeminjamanById($data['nomor_peminjaman']);

        // get all pengembalian for peminjaman
        $allPengembalianForPeminjaman = $this->pengembalianRepository->getAllPengembalianByNomorPeminjaman($data['nomor_peminjaman']);

        // sum up all jumlah_pengembalian
        $totalPengembalian = 0;
        foreach ($allPengembalianForPeminjaman as $pengembalian) {
            $totalPengembalian += $pengembalian->jumlah_pengembalian;
        }

        $pengembalian = new Pengembalian(
            $data['nomor_pengembalian'],
            $data['nomor_peminjaman'],
            $data['nomor_pengguna'],
            $data['tanggal_pengembalian'],
            $data['jumlah_pengembalian'],
            $peminjaman->jumlah_peminjaman - $totalPengembalian,
            $data['bukti_bayar']
        );
        $this->pengembalianRepository->insert($pengembalian);

        // update peminjaman status if fully returned
        if ($peminjaman->jumlah_peminjaman == $totalPengembalian) {
            $peminjamanRepository->updatePeminjamanStatus($peminjaman->nomor_peminjaman, 'lunas');
        }
        
        return;
    }
    
    public function getPendingPengembalian()
    {
        $result = $this->pengembalianRepository->getPendingPengembalian();
        return $result;
    }

    public function terimaPengembalian($id)
    {
        $this->pengembalianRepository->updatePengembalianStatus($id, 'disetujui');

        // check if peminjaman is fully returned
        $pengembalian = $this->pengembalianRepository->getPengembalianById($id);

        $peminjamanRepository = new PeminjamanRepository();
        $peminjaman = $peminjamanRepository->getPeminjamanById($pengembalian->nomor_peminjaman);

        $allPengembalianForPeminjaman = $this->pengembalianRepository->getAllPengembalianByNomorPeminjaman($pengembalian->nomor_peminjaman);
        
        // sum up all jumlah_pengembalian
        $totalPengembalian = 0;
        foreach ($allPengembalianForPeminjaman as $pengembalian) {
            $totalPengembalian += $pengembalian->jumlah_pengembalian;
        }

        // update peminjaman status
        if ($totalPengembalian == $peminjaman->jumlah_peminjaman) {
            $peminjamanRepository->updatePeminjamanStatus($peminjaman->nomor_peminjaman, 'lunas');
        } else {

        }

        return;
    }

    public function tolakPengembalian($id)
    {
        $this->pengembalianRepository->updatePengembalianStatus($id, 'ditolak');
        return;
    }

    // public function update($id, $data)
    // {
    //     $pengembalian = new Pengembalian(
    //         $data['nomor_pengembalian'],
    //         $data['nomor_peminjaman'],
    //         $data['tanggal_pengembalian'],
    //         $data['jumlah_pengembalian'],
    //         $data['denda'],
    //         $data['total_bayar']
    //     );
    //     $result = $this->pengembalianRepository->update($id, $pengembalian);
    //     return $result;
    // }

    // public function delete($id)
    // {
    //     $result = $this->pengembalianRepository->delete($id);
    //     return $result;
    // }
}