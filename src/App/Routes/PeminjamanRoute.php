<?php

use App\Services\PeminjamanService;

$peminjamanService = new PeminjamanService();

return function ($router) use ($peminjamanService)
{
    $router->addRoute('/peminjaman', function () use ($peminjamanService) {
        // Handle registration logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $peminjamanService->create($postData);
    }, 'POST');

    $router->addRoute('/all_peminjaman', function () use ($peminjamanService) {
        // Handle getting all users logic
        $peminjaman = $peminjamanService->getAll();
        header('Content-Type: application/json');
        return json_encode($peminjaman);
    }, 'GET');

    $router->addRoute('/peminjaman_pending', function () use ($peminjamanService) {
        // Handle getting all users logic
        $peminjaman_pending = $peminjamanService->getPendingPeminjaman();
        header('Content-Type: application/json');
        return json_encode($peminjaman_pending);
    }, 'GET');

    $router->addRoute('/peminjaman_anggota', function () use ($peminjamanService) {
        // Handle getting user by username logic
        $nomor_pengguna = $_GET['nomor_pengguna'] ?? null;

        $peminjaman_anggota = $peminjamanService->getPeminjamanByNomorPengguna($nomor_pengguna);
        header('Content-Type: application/json');
        return json_encode($peminjaman_anggota);
    }, 'GET');

    $router->addRoute('/peminjaman_setujui', function () use ($peminjamanService) {
        // Handle creating new peminjaman logic
        $nomor_peminjaman = $_GET['nomor_peminjaman'] ?? null;

        return $peminjamanService->setujuiPeminjaman($nomor_peminjaman);
    }, 'PUT');

    $router->addRoute('/peminjaman_tolak', function () use ($peminjamanService) {
        // Handle creating new peminjaman logic
        $nomor_peminjaman = $_GET['nomor_peminjaman'] ?? null;

        return $peminjamanService->tolakPeminjaman($nomor_peminjaman);
    }, 'PUT');
};