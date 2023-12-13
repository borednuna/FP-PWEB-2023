<?php

use App\Services\LaporanAnggotaService;

$laporan_anggota_service = new LaporanAnggotaService();

return function ($router) use ($laporan_anggota_service)
{
    $router->addRoute('/laporan_anggota', function () use ($laporan_anggota_service) {
        // Handle registration logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $laporan_anggota_service->create($postData);
    }, 'POST');

    $router->addRoute('/laporan_anggota', function () use ($laporan_anggota_service) {
        // Handle getting all users logic
        return $laporan_anggota_service->getAll();
    }, 'GET');

    $router->addRoute('/laporan_anggota/{nomor_pengguna}', function ($nomor_pengguna) use ($laporan_anggota_service) {
        // Handle getting user by username logic
        return $laporan_anggota_service->getByNomorPengguna($nomor_pengguna);
    }, 'GET');

    $router->addRoute('\/laporan_anggota/', function () use ($laporan_anggota_service) {
        // Handle creating new peminjaman logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $laporan_anggota_service->create($postData);
    }, 'POST');
};