<?php

use App\Services\PengembalianService;

$pengembalianService = new PengembalianService();

return function ($router) use ($pengembalianService)
{
    $router->addRoute('/pengembalian', function () use ($pengembalianService) {
        $postData = $_POST;
        
        // Check if a file was uploaded
        if (isset($_FILES['bukti_bayar']) && $_FILES['bukti_bayar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['bukti_bayar']['name']);
    
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $uploadFile)) {
                // File upload successful, store the URL in the $postData
                $postData['bukti_bayar'] = $uploadFile;
            } else {
                // File upload failed
                return "File upload failed.";
            }
        }
    
        return $pengembalianService->create($postData);
    }, 'POST');    

    $router->addRoute('/all_pengembalian', function () use ($pengembalianService) {
        // Handle getting all users logic
        header('Content-Type: application/json');
        $pengembalian = json_encode($pengembalianService->getAll());
        return $pengembalian;
    }, 'GET');

    $router->addRoute('/pengembalian_anggota', function () use ($pengembalianService) {
        // Handle getting user by username logic
        $nomor_pengguna = $_GET['nomor_pengguna'];

        header('Content-Type: application/json');
        $pengembalian = json_encode($pengembalianService->getByNomorPengguna($nomor_pengguna));
        return $pengembalian;
    }, 'GET');

    $router->addRoute('/pengembalian_pending', function () use ($pengembalianService) {
        // Handle getting all users logic
        header('Content-Type: application/json');
        $pengembalian = json_encode($pengembalianService->getPendingPengembalian());
        return $pengembalian;
    }, 'GET');

    $router->addRoute('/pengembalian_pending_pengguna', function () use ($pengembalianService) {
        // Handle getting all users logic
        $nomor_pengguna = $_GET['nomor_pengguna'];

        header('Content-Type: application/json');
        $pengembalian = json_encode($pengembalianService->getPendingPengembalianByNomorPengguna($nomor_pengguna));
        return $pengembalian;
    }, 'GET');

    $router->addRoute('/pengembalian_terima', function () use ($pengembalianService) {
        // Handle creating new peminjaman logic
        $nomor_pengembalian = $_GET['nomor_pengembalian'];

        return $pengembalianService->terimaPengembalian($nomor_pengembalian);
    }, 'PUT');

    $router->addRoute('/pengembalian_tolak', function () use ($pengembalianService) {
        // Handle creating new peminjaman logic
        $nomor_pengembalian = $_GET['nomor_pengembalian'];

        return $pengembalianService->tolakPengembalian($nomor_pengembalian);
    }, 'PUT');
};