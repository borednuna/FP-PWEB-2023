<?php

use App\Services\PengembalianService;

$pengembalianService = new PengembalianService();

return function ($router) use ($pengembalianService)
{
    $router->addRoute('/pengembalian', function () use ($pengembalianService) {
        // Handle registration logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $pengembalianService->create($postData);
    }, 'POST');

    $router->addRoute('/pengembalian', function () use ($pengembalianService) {
        // Handle getting all users logic
        return $pengembalianService->getAll();
    }, 'GET');

    $router->addRoute('/pengembalian_anggota/{nomor_pengguna}', function ($nomor_pengguna) use ($pengembalianService) {
        // Handle getting user by username logic
        return $pengembalianService->getByNomorPengguna($nomor_pengguna);
    }, 'GET');

    $router->addRoute('/pengembalian_pending', function () use ($pengembalianService) {
        // Handle getting all users logic
        return $pengembalianService->getPendingPengembalian();
    }, 'GET');

    $router->addRoute('/pengembalian_pending/{nomor_pengguna}', function ($nomor_pengguna) use ($pengembalianService) {
        // Handle getting all users logic
        return $pengembalianService->getPendingPengembalianByNomorPengguna($nomor_pengguna);
    }, 'GET');

    $router->addRoute('/pengembalian_terima/{nomor_pengembalian}', function ($nomor_pengembalian) use ($pengembalianService) {
        // Handle creating new peminjaman logic
        return $pengembalianService->terimaPengembalian($nomor_pengembalian);
    }, 'PUT');

    $router->addRoute('/pengembalian_tolak/{nomor_pengembalian}', function ($nomor_pengembalian) use ($pengembalianService) {
        // Handle creating new peminjaman logic
        return $pengembalianService->tolakPengembalian($nomor_pengembalian);
    }, 'PUT');
};