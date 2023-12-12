<?php

namespace App\Services;

use App\Models\Pengguna;
use App\Repositories\PenggunaRepository;

class PenggunaService
{
    private $penggunaRepository;

    public function __construct()
    {
        $this->penggunaRepository = new PenggunaRepository();
    }

    public function getAll()
    {
        $result = $this->penggunaRepository->getAll();
        return $result;
    }

    public function getById($id)
    {
        $result = $this->penggunaRepository->getById($id);
        return $result;
    }

    public function getByUsername($username)
    {
        $result = $this->penggunaRepository->getByUsername($username);
        return $result;
    }

    public function create($data)
    {
        $pengguna = new Pengguna(
            0,
            $data['nama'],
            $data['email'],
            $data['password'],
            $data['alamat'],
            $data['role'],
            $data['tanggal_bergabung']
        );
        $result = $this->penggunaRepository->registerPengguna($pengguna);
        return $result;
    }

    // public function update($id, $data)
    // {
    //     $pengguna = new Pengguna(
    //         $data['nomor_pengguna'],
    //         $data['nama'],
    //         $data['email'],
    //         $data['password'],
    //         $data['alamat'],
    //         $data['role'],
    //         $data['tanggal_bergabung']
    //     );
    //     $result = $this->penggunaRepository->update($id, $pengguna);
    //     return $result;
    // }

    // public function delete($id)
    // {
    //     $result = $this->penggunaRepository->delete($id);
    //     return $result;
    // }
}