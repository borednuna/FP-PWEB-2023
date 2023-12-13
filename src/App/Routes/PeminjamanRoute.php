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

    $router->addRoute('/peminjaman', function () use ($peminjamanService) {
        // Handle getting all users logic
        return $peminjamanService->getAll();
    }, 'GET');

    $router->addRoute('/peminjaman_pending', function () use ($peminjamanService) {
        // Handle getting all users logic
        return $peminjamanService->getPendingPeminjaman();
    }, 'GET');

    $router->addRoute('/peminjaman_anggota/{nomor_pengguna}', function ($nomor_pengguna) use ($peminjamanService) {
        // Handle getting user by username logic
        return $peminjamanService->getPeminjamanByNomorPengguna($nomor_pengguna);
    }, 'GET');

    $router->addRoute('/peminjaman/', function () use ($peminjamanService) {
        // Handle creating new peminjaman logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $peminjamanService->create($postData);
    }, 'POST');

    $router->addRoute('/peminjaman_setujui/{nomor_peminjaman}', function ($nomor_peminjaman) use ($peminjamanService) {
        // Handle creating new peminjaman logic
        return $peminjamanService->setujuiPeminjaman($nomor_peminjaman);
    }, 'POST');

    $router->addRoute('/peminjaman_tolak/{nomor_peminjaman}', function ($nomor_peminjaman) use ($peminjamanService) {
        // Handle creating new peminjaman logic
        return $peminjamanService->tolakPeminjaman($nomor_peminjaman);
    }, 'POST');
};