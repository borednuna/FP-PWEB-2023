<?php

use App\Services\LaporanAnggotaService;

$laporan_anggota_service = new LaporanAnggotaService();

return function ($router) use ($laporan_anggota_service)
{
    $router->addRoute('/laporan_anggota', function () use ($laporan_anggota_service) {
        // Handle registration logic
        return $laporan = json_encode($laporan_anggota_service->create());
    }, 'POST');

    $router->addRoute('/all_laporan_anggota', function () use ($laporan_anggota_service) {
        // Handle getting all users logic
        header('Content-Type: application/json');
        $laporan = json_encode($laporan_anggota_service->getAll());
        return $laporan;
    }, 'GET');

    $router->addRoute('/laporan_nomor_anggota', function () use ($laporan_anggota_service) {
        // Handle getting user by username logic
        $nomor_pengguna = $_GET['nomor_pengguna'];
        header('Content-Type: application/json');
        $laporan = json_encode($laporan_anggota_service->getByNomorPengguna($nomor_pengguna));
        return $laporan;
    }, 'GET');
};