<?php

use App\Services\LaporanKeuanganKetuaService;

$laporan_anggota_service = new LaporanKeuanganKetuaService();

return function ($router) use ($laporan_anggota_service)
{
    $router->addRoute('/laporan_keuangan_ketua', function () use ($laporan_anggota_service) {
        // Handle registration logic
        return $laporan_anggota_service->insert();
    }, 'POST');

    $router->addRoute('/all_laporan_keuangan_ketua', function () use ($laporan_anggota_service) {
        // Handle getting all users logic
        header('Content-Type: application/json');
        $laporan = $laporan_anggota_service->getAll();
        return json_encode($laporan);
    }, 'GET');

    $router->addRoute('/laporan_ketua_bulan_tahun', function () use ($laporan_anggota_service) {
        // Handle getting user by username logic
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];

        header('Content-Type: application/json');
        $laporan = $laporan_anggota_service->getByBulanTahun($bulan, $tahun);
        return json_encode($laporan);
    }, 'GET');
};