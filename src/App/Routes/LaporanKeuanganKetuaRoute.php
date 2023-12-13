<?php

use App\Services\LaporanKeuanganKetuaService;

$laporan_anggota_service = new LaporanKeuanganKetuaService();

return function ($router) use ($laporan_anggota_service)
{
    $router->addRoute('/laporan_keuangan_ketua', function () use ($laporan_anggota_service) {
        // Handle registration logic
        $postData = json_decode(file_get_contents("php://input"), true);
        return $laporan_anggota_service->insert($postData);
    }, 'POST');

    $router->addRoute('/laporan_keuangan_ketua', function () use ($laporan_anggota_service) {
        // Handle getting all users logic
        return $laporan_anggota_service->getAll();
    }, 'GET');

    $router->addRoute('/laporan_bulan_tahun/{bulan}/{tahun}', function ($bulan, $tahun) use ($laporan_anggota_service) {
        // Handle getting user by username logic
        return $laporan_anggota_service->getByBulanTahun($bulan, $tahun);
    }, 'GET');
};